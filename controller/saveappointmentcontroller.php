<?php
session_start();
// Limpiar buffer completamente antes de cualquier salida
while (ob_get_level()) ob_end_clean();
header('Content-Type: application/json');

require_once '../model/modelappointment.php';

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    // 1. Verificar método HTTP y autenticación
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido', 405);
    }

    if (!isset($_SESSION['id'])) {
        throw new Exception('No autenticado', 401);
    }

    // 2. Obtener y validar datos JSON
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Formato JSON inválido', 400);
    }

    // 3. Validar campos obligatorios con tipos
    $required = [
        'coddoc' => 'string',
        'codespe' => 'string', 
        'date' => 'date',
        'time' => 'time'
    ];

    foreach ($required as $field => $type) {
        if (empty($input[$field])) {
            throw new Exception("Campo $field requerido", 400);
        }
        
        if ($type === 'date' && !DateTime::createFromFormat('Y-m-d', $input[$field])) {
            throw new Exception("Formato de fecha inválido. Use YYYY-MM-DD", 400);
        }
        
        if ($type === 'time' && !preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $input[$field])) {
            throw new Exception("Formato de hora inválido. Use HH:MM en formato 24h", 400);
        }
    }

    // 4. Procesar con el modelo
    $model = new Modelo();

    // Conversión de fecha a día de la semana
    $dayOfWeekEnglish = date('l', strtotime($input['date']));
    $daysMap = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];
    $dayInSpanish = $daysMap[$dayOfWeekEnglish] ?? $dayOfWeekEnglish;

    // 5. Verificar disponibilidad
    $disponibilidad = $model->verificarDisponibilidadHorario($input['coddoc'], $dayInSpanish, $input['time']);

    if (!$disponibilidad['disponible']) {
        $response = [
            'success' => false,
            'message' => 'El horario no está disponible. Por favor elige otro horario.',
            'available_times' => $disponibilidad['horarios_disponibles'] ?? []
        ];
        http_response_code(409); // Conflict
        echo json_encode($response);
        exit;
    }

    // 6. Crear y guardar cita
    $appointment = new Modelo();
    $appointment->dates = $input['date'];
    $appointment->hour = $input['time'];
    $appointment->coddoc = $input['coddoc'];
    $appointment->codespe = $input['codespe'];
    $appointment->codpaci = $_SESSION['id'];
    $appointment->estado = 'pendiente';

    // 7. Versión definitiva de inserción
    try {
        // Intento de inserción
        $model->insertar($appointment);
        
        // Obtener ID de la cita insertada
        $lastId = $model->lastInsertId();
        
        if (!$lastId) {
            throw new Exception('No se pudo obtener el ID de la cita insertada', 500);
        }

        // Respuesta COMPLETA con todos los datos necesarios
        $response = [
            'success' => true,
            'message' => '✅ Cita agendada correctamente',
            'data' => [
                'id' => $lastId,
                'date' => $input['date'],  // Fecha en formato YYYY-MM-DD
                'formatted_date' => date('d/m/Y', strtotime($input['date'])), // Fecha formateada
                'time' => $input['time'],  // Hora en formato HH:MM
                'day' => $dayInSpanish,    // Día de la semana en español
                'doctor_id' => $input['coddoc'],
                'doctor_name' => 'Oscar Novoa', // Reemplaza con consulta real a DB si es necesario
                'specialty_id' => $input['codespe']
            ]
        ];

    } catch (PDOException $e) {
        error_log("Error PDO en inserción: " . $e->getMessage());
        throw new Exception('Error al guardar en base de datos', 500);
    }

} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => '❌ ' . $e->getMessage(),
        'error_code' => $e->getCode()
    ];
    http_response_code($e->getCode() >= 400 ? $e->getCode() : 500);
}

// Enviar respuesta final limpia
echo json_encode($response);
exit;