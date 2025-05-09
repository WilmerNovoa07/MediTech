<?php
session_start();
// Verificar que es un doctor
if($_SESSION['user_type'] != 'doctor') {
    header('Location: login.php');
    exit();
}

include_once('../config/dbconect.php');
$database = new Connection();
$db = $database->open();

// Obtener citas del doctor
$stmt = $db->prepare("SELECT a.codcit, a.dates, a.hour, c.nombrep, c.apellidop 
                     FROM appointment a 
                     JOIN customers c ON a.codpaci = c.codpaci
                     WHERE a.coddoc = :coddoc AND a.dates >= CURDATE()
                     ORDER BY a.dates, a.hour");
$stmt->execute(array(':coddoc' => $_SESSION['user_id']));
$citas = $stmt->fetchAll();

$database->close();
?>

<!-- HTML para mostrar las citas -->
<h2>Mis Citas Agendadas</h2>
<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Paciente</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($citas as $cita): ?>
        <tr>
            <td><?php echo $cita['dates']; ?></td>
            <td><?php echo $cita['hour']; ?></td>
            <td><?php echo $cita['nombrep'].' '.$cita['apellidop']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>