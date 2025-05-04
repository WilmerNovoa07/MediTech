<?php
// controller/getdoctorsbyspecialtycontroller.php

// Incluir el modelo de doctores
require_once '../model/modeldoctor.php';

// Obtener el código de la especialidad desde la URL
$codespe = $_GET['codespe'];

// Crear una instancia del modelo
$modelo = new Modelo();

// Obtener los doctores por especialidad
$doctors = $modelo->getDoctorsBySpecialty($codespe);

// Verificar si se obtuvieron los doctores
if (empty($doctors)) {
    // Si no hay doctores, devolver un JSON con un mensaje de error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se encontraron doctores para esta especialidad.']);
    exit;
}

// Devolver los doctores en formato JSON
header('Content-Type: application/json');
echo json_encode($doctors);
?>