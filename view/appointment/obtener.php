<?php
session_start();
include_once('../config/dbconect.php');

if(isset($_POST['editar'])){
    $database = new Connection();
    $db = $database->open();
    
    try {
        // 1. Obtener datos básicos
        $codcit = $_GET['id'];
        $dates = $_POST['dates'];
        $hour = $_POST['hour'];

        // 2. Obtener doctor y especialidad de la cita
        $sql_cita = "SELECT coddoc, codespe FROM appointment WHERE codcit = :codcit";
        $stmt_cita = $db->prepare($sql_cita);
        $stmt_cita->execute([':codcit' => $codcit]);
        $cita = $stmt_cita->fetch(PDO::FETCH_ASSOC);
        
        if(!$cita) throw new Exception("Cita no encontrada");
        
        $coddoc = $cita['coddoc'];
        $codespe = $cita['codespe'];

        // 3. Convertir fecha a día de la semana (en español)
        $dayOfWeekEnglish = date('l', strtotime($dates));
        $daysMap = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        ];
        $dia_semana = $daysMap[$dayOfWeekEnglish] ?? $dayOfWeekEnglish;

        // 4. Verificar disponibilidad del doctor (Mismo método que en saveappointment)
        $sql_horario = "
            SELECT h.* 
            FROM horario h
            WHERE h.coddoc = :coddoc 
            AND h.dia = :dia_semana
            
        ";
        
        $stmt_horario = $db->prepare($sql_horario);
        $stmt_horario->execute([
            ':coddoc' => $coddoc,
            ':dia_semana' => $dia_semana
        ]);
        
        $horario = $stmt_horario->fetch(PDO::FETCH_ASSOC);

        if(!$horario) {
            throw new Exception("El doctor no trabaja este día");
        }

        // 5. Validar hora contra el horario laboral
        $hora_seleccionada = strtotime($hour);
        $hora_inicio = strtotime($horario['hora_inicio']);
        $hora_fin = strtotime($horario['hora_fin']);
        
        if($hora_seleccionada < $hora_inicio || $hora_seleccionada > $hora_fin) {
            throw new Exception("Horario fuera del rango laboral, el horario laboral es ({$horario['hora_inicio']} - {$horario['hora_fin']})");
        }

        // 6. Verificar colisión con otras citas (excluyendo esta)
        $sql_colision = "
            SELECT COUNT(*) AS total 
            FROM appointment 
            WHERE coddoc = :coddoc 
            AND dates = :dates 
            AND hour = :hour 
            AND codcit != :codcit
        ";
        
        $stmt_colision = $db->prepare($sql_colision);
        $stmt_colision->execute([
            ':coddoc' => $coddoc,
            ':dates' => $dates,
            ':hour' => $hour,
            ':codcit' => $codcit
        ]);
        
        if($stmt_colision->fetchColumn() > 0) {
            // Obtener horarios disponibles
            $sql_disponibles = "
                SELECT DISTINCT hour 
                FROM appointment 
                WHERE coddoc = :coddoc 
                AND dates = :dates 
                AND hour BETWEEN :hora_inicio AND :hora_fin
                ORDER BY hour
            ";
            
            $stmt_disponibles = $db->prepare($sql_disponibles);
            $stmt_disponibles->execute([
                ':coddoc' => $coddoc,
                ':dates' => $dates,
                ':hora_inicio' => $horario['hora_inicio'],
                ':hora_fin' => $horario['hora_fin']
            ]);
            
            $horarios_disponibles = $stmt_disponibles->fetchAll(PDO::FETCH_COLUMN);
            
            $mensaje = "Horario ocupado. Disponibles: " . implode(", ", $horarios_disponibles);
            throw new Exception($mensaje);
        }

        // 7. Actualizar si pasa todas las validaciones
        $sql_update = "
            UPDATE appointment 
            SET dates = :dates, 
                hour = :hour 
            WHERE codcit = :codcit
        ";
        
        $stmt_update = $db->prepare($sql_update);
        $stmt_update->execute([
            ':dates' => $dates,
            ':hour' => $hour,
            ':codcit' => $codcit
        ]);

        $_SESSION['swal'] = [
            'icon' => 'success',
            'title' => '¡Actualizado!',
            'text' => 'Cita modificada exitosamente'
        ];

    } catch(PDOException $e) {
        $_SESSION['swal'] = [
            'icon' => 'error',
            'title' => 'Error BD',
            'text' => $e->getMessage()
        ];
    } catch(Exception $e) {
        $_SESSION['swal'] = [
            'icon' => 'warning',
            'title' => 'Validación',
            'text' => $e->getMessage()
        ];
    }

    $database->close();
    header('Location: ../../folder/appointment.php');
    exit();
}