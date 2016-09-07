<?php 
require "conexion.php";

$valor=mysqli_real_escape_string($mysqli,$_POST['valor']);
$tabla=$_POST['tabla'];
$campo=$_POST['campo'];
/*
$valor=11164379357;
$tabla="clientes";
$campo="cedula_cli";
*/
$sql_busqueda="SELECT * from $tabla WHERE $campo=$valor";
if(!$query_sql=mysqli_query($mysqli,$sql_busqueda)){

	echo "error";

}

else {

	$resultado_query=mysqli_num_rows($query_sql);
	if($resultado_query>0){
	echo "true";
	
	}
	else echo "false";

}

	mysqli_close($mysqli);
 ?>