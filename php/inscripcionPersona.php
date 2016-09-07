<?php 
require "conexion.php";
$fi=$_POST['fechaInicial'];
$ff=$_POST['fechaFinal'];
$i=$_POST['identificacion'];
$ce=$_POST['codigoEstado'];
$cm=$_POST['codigoMembresia'];

/*$fi="2016-7-1";
$ff="2016-8-1";
$i=1116437934;
$ce=3;
$cm=1;*/

$sqlRegistrar="insert into inscripcion values (null,'$fi','$ff',$i,$ce,$cm)";

if(!$es=mysqli_query($mysqli,$sqlRegistrar))
{

	echo "Error".mysqli_error().$sqlRegistrar;

}

else {
	
	if(mysqli_affected_rows($mysqli)>0)  echo "exito";
	else echo "fracaso";
}


 ?>