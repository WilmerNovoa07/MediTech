<?php

$conexion = mysqli_connect("localhost","root","","trabajo_grado");

$query = $conexion->query("SELECT * FROM doctor");

echo '<option value="0">Seleccione el doctor</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['coddoc']. '">' . $row['nomdoc'] . '</option>' . "\n";
}



