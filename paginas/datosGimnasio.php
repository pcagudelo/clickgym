
<form>
	<legend>Informacion Gimansio</legend>

	<div class="form-group">
		<label class="control-label">Nombre Gimansio</label>
		<input type="text" class="form-control text-capitalize" id="nombre_gimnasio" name="Nombre Gimansio">
	</div>

	<div class="form-group">
		<label class="control-label">Direccion</label>
		<input type="text" class="form-control text-capitalize" id="direccion_gimnasio" name="Direccion">
	</div>

	<div class="form-group">
		<label class="control-label">Departamento</label>
		<input type="text" class="form-control text-capitalize" id="departamento" name="Departamento">
	</div>

	<div class="form-group">
		<label class="control-label">Localidad</label>
		<input type="text" class="form-control text-capitalize" id="localidad" name="Localidad">
	</div>

	<div class="form-group">
	<input type="button" name="btn_gurdar" value="Guardar" class="btn btn-default" id="boton_guardar_usuario">
	<input type="reset" name="btn_borrar_datos" value="Cancelar" class="btn btn-default" id="boton-reseteo">
	</div>

</form>
<script>
$(document).ready(function(){

	$(".form-control").focusout(function (){

		validaciones($(this));	
	});


	var clases=[$("#nombre_gimnasio").parent().attr('class'),
				$("#direccion_gimnasio").parent().attr('class'),
				$("#departamento").parent().attr('class'),
				$("#localidad").parent().attr('class')
	];

	$("#btn_gurdar").click(validar_clase (clases));


});
	

	/*
*/






</script>

