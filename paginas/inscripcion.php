<?php
//require "../instrucciones/conexion.php";
require "../php/datosSesion.php";
$sql_select="SELECT codigoMembresia,nombreMembresia,valorMembresia, vigenciaMembresia from membresia 
WHERE fk_codigoGimnasio=$codigoGim and fk_codigoEstado=1";

$query_sql=mysqli_query($mysqli,$sql_select);
//$membresia=mysqli_fetch_assoc($query_sql);
?>
<form action="" method="POST" role="form" id="formularioM">

	<input type="text" name="codigoUser" value="<?php echo $codigoU ?>" id="codigoUsuario" class="hidden">

	<legend>Incripción Personas</legend>

	<div class="form-group" id="formIdentificacion">
		<label class="control-label">Identificacion</label>
		<input class="form-control" type="number" name="Identificacion" id="identifiacion" />
		<span name="alerta"></span>
	</div>

	<div class="form-group" id="formNombreCli">
		<label class="control-label">Cliente</label>
		<input type="text" class="form-control" name="Nombre" disabled id="nombre_cliente" />
		<span name="alerta"></span>
	</div>

	<div class="form-group" id="formMembresia">
		<label class="control-label">Membresia</label>
		<select class="form-control" id="membresia" name="Membresia">
		<option value="seleccione">Seleccione</option>
		<?php
			while ($membresia=mysqli_fetch_assoc($query_sql)) {

			echo "<option data-id='".$membresia['vigenciaMembresia'].
				 "'value='".$membresia['codigoMembresia'].
				 "'>".$membresia['nombreMembresia'].
				 " $:".$membresia['valorMembresia'].
				 " ".$membresia['vigenciaMembresia'].
				 " dias</span></option>";
		}
		?>
		</select>
		<span name="alerta"></span>
	</div>
		<label class="control-label">Periodo</label>
		<div class="input-group" id="formPeriodo">
		    <input type="text" class="form-control" id="fecha_inicial" name="fecha1" disabled />
		    <span class="input-group-addon">Hasta</span>
		    <input type="text" class="form-control" id="fecha_final"  name="fecha2" disabled />
			<span class="input-group-addon">
				<a id="botonEditar" href="#">
				cambiar
				</a>
			</span>		
		</div>

	
		<br/>
	<div class="form-group">
		<label class="control-label">Estado:</label> <br/>
		<label class="radio-inline">
  			<input type="radio"  name="estado_pago" id="inlineRadio1" value="3" checked> Pago Realizado
		</label>
		<label class="radio-inline">
		  <input type="radio" name="estado_pago" id="inlineRadio2" value="4"> Pago Pendiente
		</label>
	</div>

	<div class="form-group">
		<input type="button" name="gurdar" value="Registrar" class="btn btn-default" id="botonRegistrar" />
		<input type="reset" name="btn_borrar_datos" value="Cancelar" class="btn btn-default" id="reseteo" />
	</div>
</form>

<script>

  $(document).ready(function(){

  	    var opciones = {
	    format:"Y-m-d",
	    lang: "es",
	    minYear: "2012",
	    maxYear: "2020",
	    dropPrimaryColor:"#4c595c",
	    dropBorder: "1px solid #4c595c"
	  	};

  	$("#fecha_inicial, #fecha_final").dateDropper(opciones);
    

  	$(".form-control").focusout(function (){

		validaciones($(this));	
		
	});
  
	
	$("#membresia").change(function(){

		var str = "";
		var dias=""
				
	    $("#membresia option:selected").each(function() {
	      str += $( this ).val();
	      dias += $(this).data("id");
	    });
	
		var codigoMembresia=parseInt(str);		
		var diaMembresia=parseInt(dias);
		
		var fecha= new Date;
		var mes= fecha.getMonth();
		var dia=fecha.getDate(); 
		var ano=fecha.getFullYear();
		var fechaInicial=ano + '-'+ (mes+1) + '-' +dia;
		var hoy= new Date (fecha.getFullYear(),fecha.getMonth(),fecha.getDate());
		var fechaFinal;
		

		if(dias=="seleccione"){

			error_val($(this),": sin seleccionar");
			$("#fecha_inicial, #fecha_final").removeAttr('value')
			$("#formPeriodo").removeClass();
			$("#formPeriodo").addClass("input-group has-warning has-feedback");
		}

		else if(dias==30){

			hoy.setMonth(hoy.getMonth()+1);
			hoy.setDate(hoy.getDate()-1);
			
		}

		else {

			hoy.setDate(hoy.getDate()+(diaMembresia-1));
			
		}
		fechaFinal=hoy.getFullYear()+"-"+(hoy.getMonth()+1)+"-"+(hoy.getDate());		
	

		$("#fecha_inicial").attr("value",fechaInicial);
		$("#fecha_final").attr("value",fechaFinal);
		$("#formPeriodo").removeClass();
		$("#formPeriodo").addClass("input-group has-success has-feedback");
			
	});


	$("#botonEditar").click(function(){

	  	$("#fecha_inicial, #fecha_final").prop("disabled",false);
	   	$("#formPeriodo").removeClass();
	    $("#formPeriodo").addClass("input-group has-success has-feedback")
	});

	$("#botonRegistrar").click(function(){

		var claseCo="from-group has-success has-feedback";
		var clasePV="input-group has-success has-feedback"
		var claseIda=$("#identifiacion").parent().attr('class');
		var claseNom=$("#nombre_cliente").parent().attr('class');
		var claseMem=$("#membresia").parent().attr('class');
		var claseFI=$("#fecha_inicial").parent().attr('class');
		var claseFF=$("#fecha_final").parent().attr('class');

			if(claseIda!=claseCo || claseNom!=claseCo || claseMem!=claseCo || claseFI!=clasePV || claseFF!=clasePV)

			{
				
				alertas("Error","campos sin llenar");

			}

			else {

				console.log("Enviando datos")
				var datosMembresia={ 
					fechaInicial: $("#fecha_inicial").val(),
					fechaFinal: $("#fecha_final").val(), 
					identificacion:$("#identifiacion").val(),
					codigoEstado: $("input[name='estado_pago']:checked").val(),
					codigoMembresia: $("#membresia").val()
				}
				console.log(datosMembresia);

				$.post("./php/inscripcionPersona.php",datosMembresia, function (respuesta){
				console.log(respuesta);

				if(respuesta=="exito"){
					alertas($("#nombre_cliente").val(),"registrado correctamente");
					$("#formularioM").trigger("reset");
					$("#nombre_cliente, #fecha_inicial, #fecha_final").attr("value","");

				}

				else if(respuesta=="Error"){

					alertas("Error",respuesta);


				}

				else alertas("Error",": sin actualizar");



			});

		}

	});

});




</script>