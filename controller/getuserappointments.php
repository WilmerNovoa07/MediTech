<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../model/modelappointment.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'read_and_close'  => true,
    ]);
}

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'error' => 'Sesión no iniciada']);
    exit;
}

try {
    $model = new Modelo();
    
    // Query corregida con los nombres exactos de tus tablas
   // Cambia la consulta SQL para incluir citas agendadas por administradores
    // Modifica tu consulta SQL así:
    $sql = "SELECT 
    a.codcit AS id,
    DATE_FORMAT(a.dates, '%d/%m/%Y') AS fecha,
    DATE_FORMAT(a.hour, '%H:%i') AS hora,
    s.nombrees AS especialidad,
    CONCAT(d.nomdoc, ' ', d.apedoc) AS doctor,
    a.estado
    FROM appointment a
    INNER JOIN specialty s ON a.codespe = s.codespe
    INNER JOIN doctor d ON a.coddoc = d.coddoc
    WHERE a.codpaci = :user_id
    AND a.estado = '0'"; // Buscamos citas con estado '0'

    $stmt = $model->db->prepare($sql);
    $stmt->execute([':user_id' => $_SESSION['id']]);
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'count' => count($resultados),
        'data' => $resultados
    ]);

} catch (PDOException $e) {
    error_log("PDO Error [".$e->getCode()."]: ".$e->getMessage());
    
    echo json_encode([
        'success' => false,
        'error' => 'Error de base de datos',
        'code' => $e->getCode(),
        'message' => $e->getMessage()
    ]);
    
} catch (Exception $e) {
    error_log("General Error: ".$e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Error del servidor'
    ]);
}

exit;
?>