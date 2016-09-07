<?php 
require "conexion.php";

$sql=$_POST['sql'];


if(!mysqli_query($mysqli,$sql))
{

	echo "Error";
}
else {

	if(mysqli_affected_rows($mysqli)>0)
	{

		echo "Actualizado";
	}

	else echo "Sin Actualizar";

}


 ?>