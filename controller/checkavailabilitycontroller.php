<?php
// controller/checkavailabilitycontroller.php

// Incluir el modelo de disponibilidad
require_once '../model/disponibilidadmodel.php';

// Verificar si se proporcionaron todos los parámetros necesarios
if (!isset($_GET['coddoc']) || !isset($_GET['fecha']) || !isset($_GET['hora'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Todos los parámetros (coddoc, fecha, hora) son requeridos.']);
    exit;
}

// Sanitizar y validar los parámetros
$coddoc = filter_var($_GET['coddoc'], FILTER_VALIDATE_INT);
$fecha = filter_var($_GET['fecha'], FILTER_SANITIZE_STRING);
$hora = filter_var($_GET['hora'], FILTER_SANITIZE_STRING);

// Validar el formato de la fecha (YYYY-MM-DD)
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Formato de fecha no válido. Use YYYY-MM-DD.']);
    exit;
}

// Validar el formato de la hora (HH:MM)
if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $hora)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Formato de hora no válido. Use HH:MM.']);
    exit;
}

if (!$coddoc || !$fecha || !$hora) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Parámetros no válidos.']);
    exit;
}

try {
    // Crear una instancia del modelo DisponibilidadModel
    $model = new DisponibilidadModel();

    // Obtener el horario del doctor
    $schedule = $model->getDoctorSchedule($coddoc);

    if (!$schedule) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'No hay un horario configurado para este doctor.']);
        exit;
    }

    // Validar que la hora esté dentro del rango permitido
    
    if ($hora < $schedule['hora_inicio'] || $hora > $schedule['hora_fin']) {
        header('Content-Type: application/json');
        echo json_encode([
            'error' => 'La hora seleccionada está fuera del horario laboral del doctor.',
            'horario_doctor' => [
                'desde' => $schedule['hora_inicio'],
                'hasta' => $schedule['hora_fin']
            ],
            'hora_seleccionada' => $hora
        ]);
        exit;
}

    // Verificar la disponibilidad
    $available = $model->checkAvailability($coddoc, $fecha, $hora);

    // Devolver la disponibilidad en formato JSON
    header('Content-Type: application/json');
    echo json_encode([
        'available' => $available,
        'message' => $available ? 'El horario está disponible.' : 'El horario no está disponible.',
        'data' => [
            'coddoc' => $coddoc,
            'fecha' => $fecha,
            'hora' => $hora
        ]
    ]);
} catch (Exception $e) {
    // Manejar errores inesperados
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Error en el servidor: ' . $e->getMessage(),
        'data' => [
            'coddoc' => $coddoc,
            'fecha' => $fecha,
            'hora' => $hora
        ]
    ]);
}

?>