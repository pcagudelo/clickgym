<?php 
require "../php/datosSesion.php";
require "../php/conexion.php";
$sql_select="SELECT codigoMembresia,nombreMembresia,valorMembresia, descripcionMembresia,vigenciaMembresia,estado.nombreEstado as estado from membresia inner join estado on membresia.fk_codigoEstado = estado.codigoEstado WHERE fk_codigoGimnasio=$codigoGim ";

//$query_sql=mysqli_query($mysqli,$sql_select);
$membre=mysqli_query($mysqli,$sql_select);
 ?>
	
<div>
	<legend>Gestión de Membresias</legend>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#nuevo">Agregar</a></li>
    <li><a data-toggle="tab" href="#modificar" id="modPanel">Modificar</a></li>
  </ul>

  <div class="tab-content">

	    <div id="nuevo" class="tab-pane fade in active">
		    <form action="./php/crearMembresia.php" method="POST" role="form" id="formMembresia">
		    	<input type="text" name="codigoGim" value="<?php echo $codigoGim ?>" id="CG" class="hidden">
				<br/>
			    <div class="form-group">
			    <label class="control-label" for="nombre_membresia">Nombre</label>
			    <input type="text" class="form-control" name="Nombre" value="" id="nombreMembresia" />
			    <span name="alerta"></span>
			    </div>

			    <div class="form-group">
			    	<label class="control-label" for="descripcion_membresia">Descripcion</label>
			    	<textarea class="form-control" name="Descripcion" id="descMembresia" rows="2">   </textarea>
			    	<span name="alerta"></span>
			    </div>

			    <div class="form-group">
			    	<label class="control-label" for="vigencia">Vigencia</label>
			    	<select class="form-control" name="Vigencia"  id="vigenciaMembresia" >
			    		<option value="seleccione">Seleccione</option>
			    		<option value="30">Mensual</option>
			    		<option value="14">Quincenal</option>
			    		<option value="7">Semanal</option>
			    		<option value="1">Diaria</option>
			    		<option value="365">Anual</option>
			    	</select>
			    	<span name="alerta"></span>
			    </div>

			    <div class="form-group">
			    	<label class="control-label">Valor</label>
			    	<input type="number" class="form-control" name="Valor"  id="valorMembresia" />
			    	<span name="alerta"></span>
			    </div>
				<br/>
			
				<div class="form-group">
					<input type="button" name="gurdar" value="Guardar" class="btn btn-default" id="btn_membresia" />
					<input type="reset" name="borrar_datos" value="Cancelar" class="btn btn-default" id="boton-reseteo" />
				</div>
			</form>
		</div>
	    
	    <div id="modificar" class="tab-pane fade">

			<table class="table table-bordered table-hover" id="tablajson">
					
				<thead>
					<tr data-id="Mi tr">
						<th class="text-center">#</th>
						<th>Nombre</th>
						<th>Descripcion</th>
						<th class="text-center">Vigencia</th>
						<th class="text-center">Valor</th>
						<th class="text-center">Estado</th>
					</tr>
				</thead>
				<tbody>

				
		
				</tbody>
			</table>

	    </div>
	</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-sm-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="formEdicion">
			
			<div class="form-group">
				<label class="col-sm-2  control-label">Nombre</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="editarNM" value="" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2  control-label">Descripcion</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="editarDM" value="" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2  control-label">Vigencia</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" id="editarVM" value="" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2  control-label">Valor</label>
				<div class="col-sm-8">
					<input class="form-control" type="number" id="editarValM" value="" />
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-2  control-label">Estado</label>
				<div class="col-sm-8">
					<select class="form-control"  id="editarEM" >
						<option value="1" id="opt1">Habilitado</option>
						<option value="2" id="opt2">Deshabilitado</option>
					</select>
				</div>
			
			</div>
	   </form>
      </div>
      <div class="modal-footer col-sm-8">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarCambios">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>


</div>

<script type="text/javascript">
	
$(document).ready(function(){

	var url="./php/getMembresia.php";
	var numGym={gym:$("#CG").val()};
	var phpMembresia="";
	
	/*						LISTADO DE EVENTOS USADOS
	#################################################################################*/
	//Envio de la informacion del formulario para la creacion de una nueva membresia
	$("#btn_membresia").click(guardar);
	//Rellena el div #modPanel con un listado de las membresias
	$("#modPanel").click(listaMembresia);
	//Levantar ventana modal con los datos de la memebresia
	$("#tablajson").on("click","tbody tr",editarMembresia);
	$("#guardarCambios").click(saveCambios);
	//Validacion de Campos
	$("#formMembresia .form-control").focusout(validaciones($(this)));
	/*#################################################################################
						FIN LISTADO DE EVENTOS USADOS*/
		
	function listaMembresia(){
		var item=1;
		//Limpia el cuerpo de la tabla
		$("#tablajson tbody").html("");
		//Obtiene un arreglo con la informaicon de la consulta contenida en  <url>
		$.getJSON(url,numGym,function(membresias){
		
				$.each(membresias, function(i,membresia){		
				var newRow ="<tr data-id='"+membresia.codigoMembresia+"' data-nombre='"
			   +membresia.nombreMembresia+"' data-descrip='"
			   +membresia.descripcionMembresia+"' data-vigencia='"
			   +membresia.vigenciaMembresia+"' data-valor ='"
			   +membresia.valorMembresia+"' >"
			   +"<td><span class='badge'>"+item+"</span></td>"
			   +"<td data-nombre>"+membresia.nombreMembresia+"</td>"
			   +"<td>"+membresia.descripcionMembresia+"</td>"
			   +"<td class='text-center'>"+membresia.vigenciaMembresia+"</td>"
			   +"<td class='text-center'>"+membresia.valorMembresia+"</td>"
			   +"<td class='text-center'>"+membresia.estado+"</td>"
			   +"</tr>";	
				item++;
				$("#tablajson tbody").append(newRow);
			});
		});
	}
	

	function editarMembresia(){

		//Obtiene el valor codigoMembresia que se encuentra en el tr como data-id
		var valorId=$(this).data('id');
		//Limpia los compos del formulario de edicion
		$("#formEdicion .form-control").attr("value","");
		//Despliega la ventana modal
		$("#myModal").modal('show');
		//Asigna los valores del TR a el formulario de edicion.		
		$("#editarNM").attr("value", $(this).data('nombre') );
		$("#editarDM").attr("value",$(this).data('descrip') );
		$("#editarVM").attr("value",$(this).data('vigencia') );
		$("#editarValM").attr("value",$(this).data('valor') );
		var elSelect=$(this).data('estado');
		if(elSelect=="Habilitado"){

			$("#opt1").prop("selected",  true);
		}

		else $("#opt2").prop("selected",  true);	
	}


	function saveCambios(){

		//oculta la ventana modal
		$("#myModal").modal('hide');
		//crea paquetes que seran enviados			
		var datosEditados={ editId:valorId,
		editNom:$("#editarNM").val(),
		editDes:$("#editarDM").val(),
		editVig:$("#editarVM").val(),
		editVal:$("#editarValM").val(),
		editEM:$("#editarEM").val()
		};

		//Envia paquete y actua segun respues
		$.post("./php/editMembresia.php",datosEditados,function(respuesta){
		
			if(respuesta=="Actualizado"){
				//vuelve a listar las membresias
				listaMembresia ();

			}
		});
	}


	function guardar(){
		var claseC="from-group has-success has-feedback";
		var claseNM=$("#nombreMembresia").parent().attr('class');
		var claseDM=$("#descMembresia").parent().attr('class');
		var claseVM=$("#vigenciaMembresia").parent().attr('class');
		var claseValM=$("#valorMembresia").parent().attr('class');

		if(claseNM!=claseC || claseDM!=claseC || claseVM!=claseC || claseValM!=claseC){

			alertas("Error","campos sin llenar");
		}


		else {

				//$("#formMembresia").submit();

			var paqueteM ={
			nombreM:$("#nombreMembresia").val(),
			descripcionM:$("#descMembresia").val(),
			vigenciaM:$("#vigenciaMembresia").val(),
			valorM:$("#valorMembresia").val(),
			codigoG:$("#CG").val()
			};

			$.post("./php/crearMembresia.php",paqueteM, function  (e){

				if(e=="true"){
					alertas ($("#nombreMembresia").val().toUpperCase(),"almacenado correctamente")			
					$("#formMembresia").trigger("reset");
				}
				else alertas("Error","al almacenar");
			});
		}
	}
	//FIN Envio
});

</script>