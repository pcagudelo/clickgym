<?php 
require "conexion.php";
$buscarCampo=$_POST['buscarCampo'];
$tabla=$_POST['tabla'];
$condicionCampo=$_POST['condicionCampo'];
$condicionValor=$_POST['condicionValor'];


/*$buscarCampo="vigencia";
$tabla="membresia";
$condicionCampo="codigo_membresia";
$condicionValor="";*/
//$sql_busqueda="SELECT $buscarCampo FROM $tabla WHERE $condicionCampo=$condicionValor";
//$sql_busqueda2="SELECT $buscarCampo FROM $tabla WHERE $condicionCampo=$condicionValor";

$sql_busqueda="SELECT $buscarCampo FROM $tabla WHERE $condicionCampo=$condicionValor";


if(!$query_sql=mysqli_query($mysqli,$sql_busqueda)){

	echo "error".mysql_error()." SENTENCIA".$sql_busqueda;

}

else {

	$resultado_query=mysqli_fetch_assoc($query_sql);
	echo  $resultado_query[$buscarCampo];
	 
}

	mysqli_close($mysqli);


 ?>