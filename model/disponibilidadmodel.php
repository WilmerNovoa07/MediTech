<?php
// model/disponibilidadmodel.php

class DisponibilidadModel {
    private $db;

    // Constructor: establece la conexión a la base de datos
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=trabajo_grado', "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones para errores de PDO
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Método para obtener las fechas disponibles de un doctor
    public function getAvailableDates($coddoc) {
        try {
            // Obtener los días de trabajo del doctor desde la tabla horario
            $query = "SELECT DISTINCT dia FROM horario WHERE coddoc = :coddoc AND estado = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':coddoc', $coddoc, PDO::PARAM_INT);
            $stmt->execute();
            $diasTrabajo = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Depuración: Mostrar los días de trabajo obtenidos
            error_log("Días de trabajo para coddoc=$coddoc: " . print_r($diasTrabajo, true));

            // Si no hay días de trabajo, retornar un array vacío
            if (empty($diasTrabajo)) {
                error_log("No se encontraron días de trabajo para coddoc=$coddoc.");
                return [];
            }

            // Generar fechas disponibles para las próximas 4 semanas
            $fechasDisponibles = $this->generarFechasDisponibles($diasTrabajo);

            // Depuración: Mostrar las fechas disponibles generadas
            error_log("Fechas disponibles para coddoc=$coddoc: " . print_r($fechasDisponibles, true));

            return $fechasDisponibles;
        } catch (PDOException $e) {
            // En caso de error, devolver un array vacío
            error_log("Error en getAvailableDates: " . $e->getMessage());
            return [];
        }
    }

    // Método para generar fechas disponibles basadas en los días de trabajo
    private function generarFechasDisponibles($diasTrabajo) {
        $fechasDisponibles = [];
        $diasSemana = [
            'Lunes' => 1, 'Martes' => 2, 'Miércoles' => 3,
            'Jueves' => 4, 'Viernes' => 5, 'Sábado' => 6, 'Domingo' => 7
        ];
    
        // Convertir días de trabajo a números para comparación
        $diasTrabajoNumeros = array_map(fn($dia) => $diasSemana[$dia], $diasTrabajo);
    
        $fechaInicio = new DateTime();
        $fechaFin = (new DateTime())->modify('+28 days');
    
        // Iterar desde fechaInicio hasta fechaFin
        while ($fechaInicio <= $fechaFin) {
            if (in_array($fechaInicio->format('N'), $diasTrabajoNumeros)) {
                $fechasDisponibles[] = $fechaInicio->format('Y-m-d');
            }
            $fechaInicio->modify('+1 day');
        }
    
        return $fechasDisponibles;
    }
    
    public function generarDisponibilidadPorDia($coddoc, $diasTrabajo, $horarioInicio, $horarioFin) {
        try {
            foreach ($diasTrabajo as $dia) {
                $horaActual = new DateTime($horarioInicio);
    
                while ($horaActual->format('H:i:s') <= $horarioFin) {
                    $hora = $horaActual->format('H:i:s');
    
                    // Insertar en la tabla `disponibilidad`
                    $query = "INSERT INTO disponibilidad (coddoc, dia, hora, disponible)
                              VALUES (:coddoc, :dia, :hora, 1)";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([
                        ':coddoc' => $coddoc,
                        ':dia' => $dia,
                        ':hora' => $hora
                    ]);
    
                    $horaActual->modify('+1 hour'); // Incrementar por una hora
                }
            }
    
            error_log("Disponibilidad generada para coddoc=$coddoc.");
        } catch (PDOException $e) {
            error_log("Error al generar disponibilidad: " . $e->getMessage());
        }
    }

    public function getDoctorSchedule($coddoc) {
        try {
            $query = "SELECT hora_inicio, hora_fin FROM horario WHERE coddoc = :coddoc AND estado = 1 LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':coddoc', $coddoc, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getDoctorSchedule: " . $e->getMessage());
            return null;
        }
    }
    
    
    public function checkAvailability($coddoc, $fecha, $hora) {
        try {
            // Primero verificar si hay cita existente
            $query = "SELECT 1 FROM appointment 
                     WHERE coddoc = :coddoc 
                     AND dates = :fecha 
                     AND hour = :hora 
                     AND estado = '0'"; // estado '0' = cita activa
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':coddoc' => $coddoc,
                ':fecha' => $fecha,
                ':hora' => $hora
            ]);
            
            if ($stmt->fetch()) {
                return false; // Ya existe una cita a esta hora
            }
    
            // Verificar si está dentro del horario laboral
            $diaSemana = date('l', strtotime($fecha)); // Obtener día de la semana (en inglés)
            
            // Convertir a formato español para coincidir con tu base de datos
            $diasTraduccion = [
                'Monday' => 'Lunes',
                'Tuesday' => 'Martes',
                'Wednesday' => 'Miércoles',
                'Thursday' => 'Jueves',
                'Friday' => 'Viernes',
                'Saturday' => 'Sábado',
                'Sunday' => 'Domingo'
            ];
            $diaEspañol = $diasTraduccion[$diaSemana];
            
            // Consultar horario del doctor para ese día
            $query = "SELECT hora_inicio, hora_fin FROM horario 
                     WHERE coddoc = :coddoc 
                     AND dia = :dia 
                     AND estado = '1'";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':coddoc' => $coddoc,
                ':dia' => $diaEspañol
            ]);
            
            $horario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$horario) {
                return false; // El doctor no trabaja este día
            }
            
            // Verificar que la hora esté dentro del horario laboral
            $horaSeleccionada = strtotime($hora);
            $horaInicio = strtotime($horario['hora_inicio']);
            $horaFin = strtotime($horario['hora_fin']);
            
            return ($horaSeleccionada >= $horaInicio && $horaSeleccionada <= $horaFin);
            
        } catch (PDOException $e) {
            error_log("Error en checkAvailability: " . $e->getMessage());
            return false;
        }
    }
    public function insertAppointment($coddoc, $fecha, $hora, $codpaci, $codespe) {
        try {
            $query = "INSERT INTO appointment 
                     (dates, hour, codpaci, coddoc, codespe, estado, fecha_create) 
                     VALUES (:fecha, :hora, :codpaci, :coddoc, :codespe, '0', NOW())";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':codpaci', $codpaci, PDO::PARAM_INT);
            $stmt->bindParam(':coddoc', $coddoc, PDO::PARAM_INT);
            $stmt->bindParam(':codespe', $codespe, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al insertar cita: " . $e->getMessage());
            return false;
        }
    }
    public function getDoctorName($coddoc) {
        try {
            $query = "SELECT CONCAT(nomdoc, ' ', apedoc) AS nombre_completo 
                     FROM doctor WHERE coddoc = :coddoc";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':coddoc', $coddoc, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['nombre_completo'] : 'Doctor no encontrado';
        } catch (PDOException $e) {
            error_log("Error al obtener nombre del doctor: " . $e->getMessage());
            return 'Doctor';
        }
    }
}
?>