<?php 
	require "conexion.php";
	$gym=$_GET['gym'];

	$sqlInscripciones="SELECT codigoInscripcion,nombrePersona,nombreMembresia, DATE_FORMAT(inscripcion.fechaInicial,'%Y-%m-%d') as fechaInicial ,DATE_FORMAT(inscripcion.fechaFinal,'%Y-%m-%d') as fechaFinal,DATEDIFF(inscripcion.fechaFinal,NOW()) as diasRestantes, nombreEstado FROM inscripcion INNER JOIN persona on inscripcion.fk_cedulaPersona=persona.cedulaPersona INNER JOIN membresia on inscripcion.fk_codigoMembresia = membresia.codigoMembresia INNER JOIN gimnasio on membresia.fk_codigoGimnasio = gimnasio.codigoGimnasio INNER JOIN estado on inscripcion.fk_codigoEstado = estado.codigoEstado where membresia.fk_codigoGimnasio=$gym and NOT(inscripcion.fk_codigoEstado = 2 or inscripcion.fk_codigoEstado=5) and DATEDIFF(inscripcion.fechaFinal,NOW()) <=4 ORDER BY inscripcion.fk_codigoEstado desc, diasRestantes asc ";
	$arrayQuery= array();
	$a=0;

	$sqlQuery=mysqli_query($mysqli,$sqlInscripciones);
	while($resQuery=mysqli_fetch_assoc($sqlQuery))
	{
		$arrayQuery[$a]=$resQuery;
		$a++;
	}

	echo json_encode($arrayQuery);
	mysqli_close($mysqli);							

 ?>
