<?php
class Modelo {
    private $db;

    public function __construct() {
        // Conexión a la base de datos
        $this->db = new PDO("mysql:host=localhost;dbname=trabajo_grado", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function mostrar($tabla, $condicion) {
        try {
            // Construimos la consulta
            $sql = "SELECT * FROM $tabla WHERE $condicion";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos como un arreglo asociativo
        } catch (PDOException $e) {
            echo "Error al mostrar los datos: " . $e->getMessage();
            return []; // Retorna un arreglo vacío en caso de error
        }
    }
    

    public function verificarHorario($coddoc, $dia, $hora_inicio, $hora_fin) {
        try {
            // Verificar si existe un horario que cause conflicto
            $sql = "SELECT * FROM horario WHERE coddoc = :coddoc AND dia = :dia AND 
                    ((hora_inicio < :hora_fin AND hora_fin > :hora_inicio))";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':coddoc' => $coddoc,
                ':dia' => $dia,
                ':hora_inicio' => $hora_inicio,
                ':hora_fin' => $hora_fin,
            ]);

            return $stmt->rowCount() > 0; // Retorna true si existe conflicto
        } catch (PDOException $e) {
            echo "Error al verificar el horario: " . $e->getMessage();
            return true; // Retornar true en caso de error para evitar inserciones conflictivas
        }
    }
    public function mostrarHorarios() {
        try {
            // Consulta con JOIN para obtener el nombre del doctor y detalles del horario
            $sql = "SELECT horario.codhor, horario.dia, horario.hora_inicio, horario.hora_fin, horario.fecha_creacion, doctor.nomdoc 
                    FROM horario 
                    INNER JOIN doctor ON horario.coddoc = doctor.coddoc";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna los datos como un arreglo asociativo
        } catch (PDOException $e) {
            echo "Error al mostrar los horarios: " . $e->getMessage();
            return []; // Retorna un arreglo vacío en caso de error
        }
    }
    
    public function insertarHorario($coddoc, $dia, $hora_inicio, $hora_fin, $estado) {
        try {
            $sql = "INSERT INTO horario (coddoc, dia, hora_inicio, hora_fin, estado) 
                    VALUES (:coddoc, :dia, :hora_inicio, :hora_fin, :estado)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':coddoc' => $coddoc,
                ':dia' => $dia,
                ':hora_inicio' => $hora_inicio,
                ':hora_fin' => $hora_fin,
                ':estado' => $estado,
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error al insertar el horario: " . $e->getMessage();
            return false;
        }
    }
}




 ?>
