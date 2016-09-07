<?php 
require 'conexion.php';
$nombreM=mysqli_real_escape_string($mysqli,$_POST['nombreM']);
$descripcionM=mysqli_real_escape_string($mysqli,$_POST['descripcionM']);
$vigenciaM=mysqli_real_escape_string($mysqli,$_POST['vigenciaM']);
$valorM=mysqli_real_escape_string($mysqli,$_POST['valorM']);
$codigoG=mysqli_real_escape_string($mysqli,$_POST['codigoG']);

/*$nombreM="Membresia Test";
$descripcionM="Probando la creacion de las membresiass";
$vigenciaM=30;
$valorM=400000;
$codigoG=1;*/

$sql="INSERT INTO membresia VALUES (null,'$nombreM','$descripcionM',$vigenciaM,$valorM,$codigoG,1)";

	if(mysqli_query($mysqli,$sql)){
		echo 'true';
	}
	else echo 'false'.mysql_error();
mysqli_close($mysqli);
 ?>