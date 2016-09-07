<?php 
require "conexion.php";
$cedula=$_POST['cedula'];
//$cedula=1116437934;
$sql_nombre="SELECT nombrePersona from persona where cedulaPersona=$cedula";
$sqlActivo="SELECT * from inscripcion where fk_cedulaPersona=$cedula and fk_codigoEstado in (3,4)";


if(!$ejecucion=mysqli_query($mysqli,$sql_nombre)){

	echo "Error al comprobar";

}

else if(!$revActivo=mysqli_query($mysqli,$sqlActivo)){
	echo "Error al comprobar";
}

else {

		if(mysqli_num_rows($ejecucion)==0)
		{
			echo "inexistente";
		}
		else if (mysqli_num_rows($revActivo)>0){

			echo "activo";

		}
		else
		{
		$nombre_persona=mysqli_fetch_assoc($ejecucion);
		echo $nombre_persona['nombrePersona'];
		
		}

}
mysqli_close($mysqli);

 ?>