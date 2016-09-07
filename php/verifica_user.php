<?php 
require 'conexion.php';
$usuario=mysqli_real_escape_string($mysqli,$_POST['user']);
$clave= mysqli_real_escape_string($mysqli,$_POST['pass']);
//$clave= "clave";
//$usuario="pcagudelo";

$sql_usuarios=" SELECT codigoUsuario FROM usuario WHERE claveUsuario=MD5('$clave') and nombreUsuario='$usuario' ";
$resultado=mysqli_query($mysqli,$sql_usuarios);
$datos_obtenidos=mysqli_num_rows($resultado);


if($datos_obtenidos>0){
	
 echo "autorizado";

}
else {
	echo "no_autorizado";
	
}

mysqli_close($mysqli);
?>