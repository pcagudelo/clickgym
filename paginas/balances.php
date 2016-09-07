
<?php
require "../php/datosSesion.php";
?>
<div>
	<input type="text" name="codigoGim" value="<?php echo $codigoGim ?>" id="CG" class="hidden">
	<ul class="nav nav-tabs">
	    <li class="active"><a data-toggle="tab" href="#seguimiento" id="segui">Seguimiento</a></li>
	    <li><a data-toggle="tab" href="#listaCompleta" id="lista">Lista Completa</a></li>
	    <li><a data-toggle="tab" href="#balance" id="tabBalance">Balance</a></li>
	</ul>

  	<div class="tab-content">
  	<br />
		<div id="seguimiento" class="tab-pane fade in active">
		   	<!--LISTA DE INSCRIPCIONES -->
			<form action="" method="POST" role="form">
				<table id="listInscripciones" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Persona</th>
							<th>Membresia</th>
							<!--<th class='text-center'>Inicio</th>-->
							<th class='text-center'>Fin</th>
							<th class='text-center'>Restantes</th>
							<th class='text-center'>Estado</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</form>
		</div>
	    
	    <div id="listaCompleta" class="tab-pane fade">
	    <br />
			<form>
				<div class="form-group">
					<label class="sr-only" for="ordenSelect">Filtros</label>
					<div class="input-group">
							
						<div class="input-group-addon">Ordenar</div>
						<select name="campo" class="form-control" id="campoSelect">
								<option value="nombrePersona">Nombre</option>
								<option value="fechaInicial">Inicio</option>
								<option value="fechaFinal">Culminacion</option>
								<option value="nombreEstado">Estado</option>
						</select>

						<div class="input-group-addon">Mostrar</div>
						<select name="cantidad" class="form-control" id="cantidadSelect">
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="10000">All</option>
						</select>

						<div class="input-group-addon">Orientacion</div>
						<select name="orientacion" class="form-control" id="ordenSelect">
								<option value="desc">Des</option>
								<option value="asc">Asc</option>
						</select>

						<div class="input-group-addon">
						<a  href="#" id="verMembresias">
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
						Ver
						</a>
						</div>

						<div class="input-group-addon" id="campoDescarga">
						<a  href="#" id="descargarInscripciones">
						<span class="glyphicon glyphicon-download" aria-hidden="true"></span>
						Descargar
						</a>
						</div>
					</div>
				</div>
			</form>
			<div id="descargar">
				<table class="table table-bordered" id="tablaIns">
					<thead>

						<tr>
							<th>Nombre</th>
							<!--<th>Membresia</th>-->
							<th>Inicio</th>
							<th>Culminación</th>
							<th>Estado</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
	    </div>

	    <div id="balance" class="tab-pane fade">
	    <br />
	    <table id="tableBalance" class="table table-bordered">
	    	<thead>
	    		<tr><th>Periodo</th>
	    			<th class='text-center'>Inscritos</th>
	    			<th class='text-center'>Valor</th>
	    		</tr>
	    	</thead>
	    	<tbody></tbody>
	    </table>
			
	    </div>

	</div>

	<div class="modal fade" id="modalSuscripcion" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">

	     	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title"></h4>
	     	</div>
      
	      	<div class="modal-body">

		      	<table  id="infoSuscripcion" class="table table-bordered">

			      	<thead>
			      		<tr>
			      			<th>Item</th>
			      			<th>Valor</th>
			      		</tr>
			      	</thead>
					
					<tbody>
						
					</tbody>	  
		      	</table>
		      	<input type="button" class="btn btn-info"  id="btnInformacion" />
		      	<input type='button' class='hidden' value='Anular' id='anularS' />
	       	</div>       
	      
		    <div class="modal-footer">


		    </div>
	    </div>
	  </div>
	</div>

</div>
<script>
$(document).ready(function(){

	var numGym={gym:$("#CG").val()};
	var codigo=$("#CG").val();
	var getInscripciones="./php/getInscripciones.php";
	var getMembresia="./php/getMembresia.php";
	var phpjson="./php/getJSON.php";
	var opciones={format:"Y-m-d",lang: "es",minYear: "2012",maxYear: "2020",dropPrimaryColor:"#4c595c"};
	var dialogoModal="";
	$("#campoDescarga").hide();
	printInscripciones();
	$("#tablaIns thead").hide();
	

	//$.getJSON(getMembresia,numGym,printMembresia);
	$("#listInscripciones tbody").on('click','tr',clickModal);
	$("#btnInformacion, #anularS").click(accionBtnInfo);
	//$("#lista").click(allSus);
	$("#segui").click(printInscripciones);
	$("#tabBalance").click(balance);

	function printInscripciones (){

		$("#listInscripciones tbody").html("");
		var clase="";
		var lab="";
		var item=1;

		$.getJSON(getInscripciones,numGym,function (inscripciones){
		
		
			$.each(inscripciones,function(i,inscripcion){

				if(inscripcion.nombreEstado=="Pago Pendiente"){
					clase="danger";
					lab="label label-danger";
				}
				else if(inscripcion.diasRestantes<=0){
					clase="warning"; 
					lab="label label-warning";
				}
				else if(inscripcion.diasRestantes<=3){
					clase="info";
					lab="label label-info";
				}
				else {
					clase="";
					lab="label label-default";
				}
				
				var linea="<tr class='"+clase+"'  data-fecha='"+inscripcion.fechaFinal+"' data-id='"+inscripcion.codigoInscripcion+"'>"
					+"<td><span class='badge'>"+item+"</span></td>"
					+"<td class='text-capitalize'>"+inscripcion.nombrePersona+"</td>"
					+"<td>"+inscripcion.nombreMembresia+"</td>"
					//+"<td class='text-center'>"+inscripcion.fechaInicial+"</td>"
					+"<td class='text-center'>"+inscripcion.fechaFinal+"</td>"
					+"<td class='text-center'><span class='"+lab+"'>"+inscripcion.diasRestantes+"</span></td>"
					+"<td class='text-center'><small><span class='"+lab+"'>"+inscripcion.nombreEstado+"</span></small></td>"
					+"</tr>"
				;

				$("#listInscripciones tbody").append(linea);
				item++;
			});
		});
	}

	function clickModal(){

		var clase=$(this).attr("class");
		var codigoInscripcion=$(this).data('id');
		var title=$("#modalSuscripcion .modal-header h4");
		
		var sqlSus="SELECT nombreMembresia,valorMembresia,vigenciaMembresia, DATE_FORMAT(inscripcion.fechaInicial,'%Y-%m-%d') as fechaInicial ,DATE_FORMAT(inscripcion.fechaFinal,'%Y-%m-%d') as fechaFinal,DATEDIFF(inscripcion.fechaFinal,NOW()) as diasRestantes FROM inscripcion INNER JOIN membresia on inscripcion.fk_codigoMembresia = membresia.codigoMembresia where codigoInscripcion="+codigoInscripcion;

		var dialogoModal="";
		var btnInfo="";

		$.getJSON("./php/getJSON.php",{sql:sqlSus},mostrarJson);

		if(clase=="danger"){
			
			boton="&nbsp;&nbsp;"
			dialogoModal="Suscripción Sin Pagar";
			btnInfo="Pagar";
			$("#anularS").removeClass().addClass("btn btn-default");
			$("#anularS").removeAttr("data-valor").attr("data-valor",codigoInscripcion)

		}
		else if(clase=="warning"){
			dialogoModal="Suscripción Vencida";
			btnInfo="Culminar";		
		}
		else {
			dialogoModal="Información Suscripción";
			btnInfo="aceptar";
		}

		

		$("#modalSuscripcion").modal('show');
		$(title).empty("").append(dialogoModal);
		$("#btnInformacion").removeAttr("value").attr("value",btnInfo);
		$("#btnInformacion").removeAttr("data-valor").attr("data-valor",codigoInscripcion);
	}

	function mostrarJson(campos){
		$("#infoSuscripcion tbody").html("");

		$.each(campos,function(i,campo){
			
		var tablatr="<tr><td>Membresia:</td><td>"+campo.nombreMembresia+"</td></tr>"
					+"<tr><td>Valor:</td><td>"+campo.valorMembresia+"</td></tr>"
					+"<tr><td>Vigencia:</td><td>"+campo.vigenciaMembresia+"</td></tr>"
					+"<tr><td>Inicio:</td><td>"+campo.fechaInicial+"</td></tr>"
					+"<tr><td>Culminación:</td><td>"+campo.fechaFinal+"</td></tr>"
					+"<tr><td>Faltante:</td><td>"+campo.diasRestantes+" días</td></tr>";

		$("#infoSuscripcion tbody").append(tablatr);
		});
	}

	function accionBtnInfo (){

		var criterio=$(this).val();
		console.log("Click en Boton"+criterio);
		var codigoS=$(this).data('valor');
		var sql="";
		var estado="";
		 if(criterio=="Pagar"){
		 	estado=3;
		 }
		 else if (criterio =="Culminar"){
		 	estado=2;
		 }
		 
		 else if(criterio =="Anular"){
		 	estado=5;
		 }

		 else {
		 		
		 		return false;
		 }

		 sql="UPDATE inscripcion set fk_codigoEstado="+estado+" where codigoInscripcion="+codigoS;
		 $.post("./php/updatePOST.php",{sql:sql},validarRespuesta);
		 console.log(sql);
		
		 $("#modalSuscripcion").modal('hide');
	}

	function validarRespuesta(dato){

		if(dato=="Actualizado"){
			alert("Suscripción Actualizada");
			printInscripciones();
			console.log("Actualizado");
			}

		else if(dato=="Error") {

			console.log("Error en el SQL:");

		}
		else console.log("Sin actualizar");
	}


	$("#verMembresias").click(function(){

		var os=$("#ordenSelect option:selected").val();
		var cs=$("#campoSelect option:selected").val();
		var cas=$("#cantidadSelect option:selected").val();
		$("#campoDescarga").show();
		allSus(os,cs,cas);
		
		
		console.log(os);
		console.log(cs);
		console.log(cas);

		


	});

	function allSus(os,cs,cas){
		//console.log("funcion allsus");
		$("#tablaIns thead").show();
		$("#tablaIns tbody").html("");

		//console.log("Limpiando Tbody");
		var sql={sql:"SELECT nombrePersona,nombreMembresia, DATE_FORMAT(inscripcion.fechaInicial,'%Y-%m-%d') as fechaInicial ,DATE_FORMAT(inscripcion.fechaFinal,'%Y-%m-%d') as fechaFinal,DATEDIFF(inscripcion.fechaFinal,NOW()) as diasRestantes, nombreEstado, valorMembresia FROM inscripcion INNER JOIN persona on inscripcion.fk_cedulaPersona=persona.cedulaPersona INNER JOIN membresia on inscripcion.fk_codigoMembresia = membresia.codigoMembresia INNER JOIN gimnasio on membresia.fk_codigoGimnasio = gimnasio.codigoGimnasio INNER JOIN estado on inscripcion.fk_codigoEstado = estado.codigoEstado where membresia.fk_codigoGimnasio="+codigo+" ORDER BY "+cs+" "+os+" limit "+cas};
		console.log("Preparando SQL");
		console.log(sql);
		console.log("Se solicita JSON:");
		console.log(phpjson);
		$.getJSON(phpjson,sql,function(inscripcions){
			/*console.log("Se obtiene respuesta");
			console.log(inscripcions);*/
			$.each(inscripcions, function(i,inscripcion){
				var trlinea="<tr>"+
				"<td><p><small>"+inscripcion.nombrePersona+"</small></p></td>"+
				//"<td>"+inscripcion.nombreMembresia+"</td>"+
				"<td><small>"+inscripcion.fechaInicial+"</small></td>"+
				"<td><small>"+inscripcion.fechaFinal+"</small></td>"+
				"<td>"+inscripcion.nombreEstado+"</td>"+
				"<td>"+inscripcion.valorMembresia+"</td>"+
				"</tr>";
				$("#tablaIns tbody").append(trlinea);
			});
		});
	}

	function balance(){

		var sql={sql:"SELECT DATE_FORMAT(inscripcion.fechaInicial,'%Y-%m') as periodo, COUNT(valorMembresia) as cantidad, FORMAT (SUM(valorMembresia),0) as valor FROM inscripcion INNER JOIN membresia on inscripcion.fk_codigoMembresia = membresia.codigoMembresia INNER JOIN gimnasio on membresia.fk_codigoGimnasio = gimnasio.codigoGimnasio INNER JOIN estado on inscripcion.fk_codigoEstado = estado.codigoEstado where membresia.fk_codigoGimnasio="+codigo+" GROUP BY periodo ORDER by periodo desc"};
		$("#tableBalance tbody").html("");

		$.getJSON(phpjson,sql,function(resumens){
			
			$.each(resumens, function(i,resumen){
			var tr="<tr><td>"+resumen.periodo+
					"</td><td class='text-center'>"+resumen.cantidad+
					"</td><td class='text-center'>"+resumen.valor+
					
					"</td></tr>";

			$(tr).appendTo("#tableBalance tbody");

			});
		});
	}

 $("#descargarInscripciones").on("click",function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($("#descargar").html()));
        e.preventDefault();
    });

});
</script>

