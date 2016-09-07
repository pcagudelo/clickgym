<?php 
require "conexion.php";

$editId=$_POST['editId'];
$editNom=$_POST['editNom'];
$editDes=$_POST['editDes'];
$editVig=$_POST['editVig'];
$editVal=$_POST['editVal'];
$editEM=$_POST['editEM'];



$sqlActualizar="update membresia set nombreMembresia='$editNom',descripcionMembresia='$editDes',
				vigenciaMembresia=$editVig,valorMembresia=$editVal,fk_codigoEstado=$editEM
				where codigoMembresia=$editId";

if(!mysqli_query($mysqli,$sqlActualizar))
{

	echo "Error".$sqlActualizar.mysqli_error();
}
else {

	if(mysqli_affected_rows($mysqli)>0)
	{

		echo "Actualizado";
	}

	else echo "Sin Actualizar";

}
?>