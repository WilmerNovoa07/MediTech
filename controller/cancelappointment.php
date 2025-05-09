<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../model/modelappointment.php';

session_start();

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'error' => 'No autenticado']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['codcit']) || !is_numeric($input['codcit'])) {
    echo json_encode(['success' => false, 'error' => 'ID de cita inválido']);
    exit;
}

try {
    $model = new Modelo();
    $codcit = (int)$input['codcit'];
    $pacienteId = $_SESSION['id'];

    // 1. Primero verificar que la cita pertenece al paciente
    $sqlVerificacion = "SELECT codcit FROM appointment 
                       WHERE codcit = ? AND codpaci = ?";
    $stmtVerificacion = $model->db->prepare($sqlVerificacion);
    $stmtVerificacion->execute([$codcit, $pacienteId]);

    if ($stmtVerificacion->rowCount() === 0) {
        echo json_encode([
            'success' => false,
            'error' => 'Cita no encontrada o no pertenece al usuario'
        ]);
        exit;
    }

    // 2. Eliminar permanentemente la cita
    $sqlEliminar = "DELETE FROM appointment WHERE codcit = ?";
    $stmtEliminar = $model->db->prepare($sqlEliminar);
    $stmtEliminar->execute([$codcit]);

    // 3. Registrar en bitácora
    $sqlAudit = "INSERT INTO audit_log 
                (table_name, record_id, action, user_name, nombre_afectado, changed_at)
                VALUES (?, ?, ?, ?, ?, NOW())";
    $stmtAudit = $model->db->prepare($sqlAudit);
    $stmtAudit->execute([
        'appointment',
        $codcit,
        '3', // 3 = Eliminar
        $_SESSION['nombrep'] ?? 'Usuario desconocido',
        'Cita médica eliminada'
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Cita eliminada permanentemente'
    ]);

} catch (PDOException $e) {
    error_log("PDO Error [{$e->getCode()}] in cancelappointment.php: {$e->getMessage()}");
    echo json_encode([
        'success' => false,
        'error' => 'Error de base de datos',
        'code' => $e->getCode(),
        'message' => $e->getMessage()
    ]);
} catch (Exception $e) {
    error_log("Error in cancelappointment.php: {$e->getMessage()}");
    echo json_encode([
        'success' => false,
        'error' => 'Error del servidor',
        'message' => $e->getMessage()
    ]);
}
?>