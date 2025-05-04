<?php
// app/controllers/UpdateAvailabilityController.php

require_once __DIR__ . '/../model/disponibilidadmodel.php';
require_once __DIR__ . '/../config/conexion1.php';

$data = json_decode(file_get_contents('php://input'), true);
$coddoc = $data['coddoc'];
$fecha = $data['fecha'];
$hora = $data['hora'];

$model = new DisponibilidadModel($db);
$success = $model->updateAvailability($coddoc, $fecha, $hora);

echo json_encode(['success' => $success]);
?>