<?php
 require "../php/conexion.php";
$sql_select="SELECT cedulaPersona, nombrePersona, generoPersona FROM persona ORDER BY nombrePersona";
$query_sql=mysqli_query($mysqli,$sql_select);
?>

<!DOCTYPE html>
<html>
<head>
	<script>
	$(document).ready(function(){

		$("#eliminar").click(function(){

			alert($(this).val());
		});
	});

	</script>

</head>
<body>
<table class="table table-bordered table-hover">
		<legend>Listado de personas Registradas</legend>
		<thead>
			<tr>
				<th class='text-center'>#</th>
				<th>Documento</th>
				<th>Nombre</th>
				</tr>
		</thead>
		<tbody>

<?php
$i=1;

while ($datos_usuario=mysqli_fetch_assoc($query_sql))
{

	echo "<tr>
		 <td class='text-center'><span class='badge'>".$i."</span></td>
		 <td>".$datos_usuario['cedulaPersona']."
		 <td>".$datos_usuario['nombrePersona']."</td>
		 </tr>";

$i++;

}


/*
	<td>
	<button type='button' id='eliminar' class='btn btn-default' value='".$datos_usuario['cedulaPersona']."'>
	<span  aria-hidden='true' id='icon_span' class='glyphicon glyphicon-trash'>
	</span>
	Borrar
	</button>
	
	<button type='button' id='editar' class='btn btn-default'>
	<span  aria-hidden='true' id='icon_span' class='glyphicon glyphicon-asterisk'>
	</span>
	Editar
	</button>

	<button type='button' id='matricular' class='btn btn-default'>
	<span  aria-hidden='true' id='icon_span' class='glyphicon glyphicon-list-alt'>
	</span>
	Matricular
	</button>
	</td>
*/
?>
		</tbody>
	</table>	
</body>
</html>