<?php 

require 'conexion.php';
$cedula=$_POST['cedula'];
$nombre=$_POST['nombre'];
$genero=$_POST['genero'];

$sql="INSERT INTO persona VALUES ($cedula,'$nombre',$genero)";

		if(mysqli_query($mysqli,$sql)){
		echo 'true';
				
		}
		else echo 'false';
mysqli_close($mysqli);
?>
