<?php
	
	$mysqli = new mysqli('localhost', 'root', '', 'trabajo_grado');
	
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>