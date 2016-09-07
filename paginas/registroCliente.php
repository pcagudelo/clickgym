
<form> 
<legend>Creacion de Personas</legend>

<div class="form-group" id="form-cedula">
	<label class="control-label">Identificación</label>
	<input type="number" name="Cedula" class="form-control" id="cedula_cliente" placeholder="Doc CC. TI." />
	<span></span>
</div>

<div class="form-group" id="form-nombre">
	<label class="control-label">Nombre</label>
	<input type="text" name="Nombre" class="form-control text-uppercase" id="nombre_cliente" placeholder="Nombre completo" />
	<span></span>
</div>

<div class="form-group" id="form-genero">
	<label class="control-label">Genero:</label><br/>
	<label class="radio-inline">
  		<input type="radio" name="Genero" id="inlineRadio1" value="1" checked /> Mujer
	</label>
	<label class="radio-inline">
	  <input type="radio" name="Genero" id="inlineRadio2" value="2" /> Hombre
	</label>

</div>
<br/>
<div class="form-group">
<input type="button" name="gurdar" value="Ingresar" class="btn btn-default" id="boton_guardar_usuario" />
<input type="reset" name="btn_borrar_datos" value="Cancelar" class="btn btn-default" id="boton-reseteo" />
</div>
</form>


<script>

	$(".form-control").focusout(function (){

		validaciones($(this));	
	});


	$("#boton_guardar_usuario").click(function (){

	var clase_correcta="from-group has-success has-feedback";
	var clase_cedula=$("#cedula_cliente").parent().attr('class');
	var clase_nombre=$("#nombre_cliente").parent().attr('class');
	//var clase_genero=$("input:radio[name=Genero]:checked").parent().attr('class');

	//Valida que los campos no tengas aplicada la clase de Error
	if(clase_cedula!=clase_correcta || clase_nombre!=clase_correcta)

	{	alertas("Error","campos sin llenar"); } 

	//Envia los datos para la creacion del cliente
	else{
		
		var paquete_usuario={cedula:$("#cedula_cliente").val(),
							 nombre:$("#nombre_cliente").val().toUpperCase(),
							 genero:$("input:radio[name=Genero]:checked").val()
		};

		$.post("./php/nuevoUsuario.php",paquete_usuario,creacion);


		function creacion (e){

			if(e=="true"){
				alertas ($("#nombre_cliente").val().toUpperCase(),"almacenado correctamente")				
				$("#formulario_cliente").trigger("reset");
			}

			else alertas("Error","al almacenar");
		}
	}
});

</script>

