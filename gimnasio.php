<?php 
	require "./php/conexion.php";
	require "./php/sesion.php";
	//require "./instrucciones/datosSesion.php";

	?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>ClickGim</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./css/datedropper.css" />
	<script src="./js/jquery-3.0.0.min.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
	<script src="./js/datedropper.js" type="text/javascript"></script>
	<script src="./js/instrucciones.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){

			//Oculta la division de estado
			$("#estado_almacenar").hide();
			$("#desplegado").load("./paginas/balances.php");

			//Barra de menus
			$(".dropdown-menu li a, .navbar-link").click(function (){

				$("#estado_almacenar").hide();	
				var direccion=$(this).attr("href");
	   			$("#desplegado").load(direccion);
	   			$("#navbar-menu").collapse('hide');
	   			return false;
	   		});
	   		//FIN barra de menus
		});
	</script>
	<style type="text/css" media="screen">
		footer {
		position: fixed;
		bottom: 5px;
			}

		.navbar-inverse !important{
			width: auto;
			max-width: 800px;
		}

		body { padding-bottom: 70px; }
	</style>
</head>
<body>
	<header>
		<!-- /header -->
		<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
			<div class="container-fluid">
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
	      			</button>
					<a class="navbar-brand" >ClickGym</a>
					
				</div>
			
				<div class="collapse navbar-collapse" id="navbar-menu" >
				
					<ul class ="nav navbar-nav">
						<!--USUARIOS MENU-->
						<li class="dropdown">
							<!--Titulo Sub menu-->
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

								<span  aria-hidden='true'  class='glyphicon glyphicon-user'></span>	
								Personas
								<span class="caret"></span>
							
							</a>
							<!--Se despliegan opciones-->
							<ul class="dropdown-menu">
								<li>
									<a href="./paginas/registroCliente.php" id="registro_cliente">
										<span  aria-hidden='true'  class='glyphicon glyphicon-plus'></span>
										Nuevo
									</a>
								</li>

								<li>
									<a href="./paginas/listadoCliente.php" id="listado_cliente">
										<span  aria-hidden='true'  class='glyphicon glyphicon-list'></span>
										Listado
									</a>
								</li>
							</ul>
						</li>
						<!--INSCRIPCIONES-->	
						<li>
							<a href="./paginas/inscripcion.php" id="inscripcion_cliente" class="navbar-link">
								<span  aria-hidden='true' class='glyphicon glyphicon-list-alt'></span>
							Inscripciones
							</a>
						</li>
						<!--BALANCES-->	
						<li>
							<a href="./paginas/balances.php" title="Balances" class="navbar-link">
								<span  aria-hidden='true' class='glyphicon glyphicon-stats'></span>
							Registros	
							</a>
						</li>
						<!--CONFIGURACIONES-->	
						<li class="dropdown">

						 	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							
						 	<span  aria-hidden='true' class='glyphicon glyphicon-cog'></span>
						 	Configuraciones
						 	<span class="caret"></span>
							
						 	</a>

						 	<ul class="dropdown-menu">
								
							<li><a href="./paginas/datos_gimnasio.php">
							<span  aria-hidden='true'  class='glyphicon glyphicon-home'></span>
							Gimnasio</a></li>

							<li><a href="./paginas/usuarios.php">
							<span  aria-hidden='true' class='glyphicon glyphicon-pawn'></span>
							Usuarios</a></li>
								
							<li><a href="./paginas/membresia.php">
							<span  aria-hidden='true'  class='glyphicon glyphicon-usd'></span>
							Membresias</a></li>
							</ul>
						</li>
							<!--SALIR-->	
						<li>
							<a href="./php/salir.php" title="Cerrar Sesion" id="log-out">
								<span  aria-hidden='true' class='glyphicon glyphicon-log-out'>
									
								</span>
							</a>
						</li>
					</ul>

				
				</div> <!-- Navbar collapse -->
			</div><!-- container fluid -->
		</nav>
	</header>



	<section class="container">
		<br/>
		<!--Seccion de vistas-->
		<div id="desplegado" >
			<!-- Ajax Here -->
		</div>
		<!--FIN Seccion de vistas-->
		<!--Alerta de Guardado-->
		<div id="estado_almacenar" role="alert">
	    	<span  aria-hidden='true' id='icon_span'></span>
	    	<strong></strong>
	    	<p style="display: inline"></p>
		</div>
		<!--Fin Alerta de Guardado-->
	</section>

	
</body>
</html>