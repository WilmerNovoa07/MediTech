<?php

$conexion = mysqli_connect("localhost","root","","trabajo_grado");

$query = $conexion->query("SELECT * FROM customers");

echo '<option value="0">Seleccione el paciente</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['codpaci']. '">' . $row['nombrep'] . '</option>' . "\n";
}



