<?php
// controller/getavailabledatescontroller.php

// Incluir el modelo de disponibilidad
require_once '../model/disponibilidadmodel.php';

// Verificar si se proporcionó el parámetro coddoc
if (!isset($_GET['coddoc'])) {
    // Si no se proporcionó el parámetro, devolver un error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'El parámetro coddoc es requerido.']);
    exit;
}

// Obtener el código del doctor desde la URL
$coddoc = $_GET['coddoc'];

// Crear una instancia del modelo DisponibilidadModel
$model = new DisponibilidadModel();

// Obtener las fechas disponibles para el doctor
$availableDates = $model->getAvailableDates($coddoc);

// Verificar si se obtuvieron las fechas disponibles
if (empty($availableDates)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se encontraron fechas disponibles para este doctor.']);
    exit;
}

// Devolver las fechas disponibles en formato JSON
header('Content-Type: application/json');
echo json_encode($availableDates);

?>