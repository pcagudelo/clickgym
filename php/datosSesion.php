<?php 
	require "sesion.php";
	require "conexion.php";
	$nusuario=$_SESSION["usuario"];
	$datosUsuarioGim="SELECT codigoUsuario,nombreCUsuario,fk_codigoGimnasio,fk_codigoTUsuario, nombreGimnasio FROM usuario INNER JOIN gimnasio on usuario.fk_codigoGimnasio = gimnasio.codigoGimnasio WHERE nombreUsuario='$nusuario'";

	if(!$result=mysqli_query($mysqli,$datosUsuarioGim)){
		echo mysql_error();
		echo $datosUsuarioGim;
	}
	else $datos_user=mysqli_fetch_assoc($result);

	$codigoU=$datos_user['codigoUsuario'];
	$nombreU=$datos_user['nombreCUsuario'];
	$codigoGim=$datos_user['fk_codigoGimnasio'];
	$codgoTU=$datos_user['fk_codigoTUsuario'];
	$nombreGim=$datos_user['nombreGimnasio'];
 ?>