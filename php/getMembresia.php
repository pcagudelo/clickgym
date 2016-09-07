<?php
require "conexion.php";
$CG=$_GET['gym'];
//$CG=1;
$sqlMembresia="SELECT codigoMembresia,nombreMembresia,valorMembresia, descripcionMembresia,vigenciaMembresia,estado.nombreEstado as estado from membresia inner join estado on membresia.fk_codigoEstado = estado.codigoEstado
	WHERE fk_codigoGimnasio=$CG";

$columnasM= array ();
$i=0;
$ejecucion=mysqli_query($mysqli,$sqlMembresia);
while ($dM=mysqli_fetch_assoc($ejecucion)){
	$columnasM[$i]=$dM;
	$i++;
	}
echo json_encode($columnasM);
mysqli_close($mysqli);
?>