<?php 
require "conexion.php";

$sql=$_GET['sql'];
$arrayq= array();
$i=0;
$query=mysqli_query($mysqli,$sql);

	while($assoc=mysqli_fetch_assoc($query)){
		$arrayq[$i]=$assoc;
		$i++;
	}

echo json_encode($arrayq);
mysqli_close($mysqli);							
?>