<?php
// controller/getspecialtiescontroller.php

// Incluir el modelo de especialidades
require_once '../model/modelspecialty.php';

// Crear una instancia del modelo SpecialtyModel
$specialtyModel = new SpecialtyModel();

// Obtener las especialidades
$specialties = $specialtyModel->getSpecialties();

// Verificar si se obtuvieron las especialidades
if (empty($specialties)) {
    // Si no hay especialidades, devolver un JSON con un mensaje de error
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No se encontraron especialidades.']);
    exit;
}

// Devolver las especialidades en formato JSON
header('Content-Type: application/json');
echo json_encode($specialties);
?>