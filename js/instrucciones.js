//Variables tipo clase para actuliar los divs contenedores

campo_valido="from-group has-success has-feedback";
campo_invalido="from-group has-warning has-feedback";


//aplica la clase sea exito o sea error
function clase_div (capa,clase){

	capa.find("span[name='alerta']").empty();
	capa.removeClass();
	capa.addClass(clase);
}

//funcion de exito en la cual no se imprime icono ni mensaje de error
//recibe como parametro el campo desencadenante del evento
function exito_val(campo){

	var padre=campo.parent();
	clase_div(padre,campo_valido);	
	//campo.after("<span  aria-hidden='true' class='glyphicon glyphicon-ok form-control-feedback'></span>");
	
}
//funcion de error
//recibe como parametro el campo desencadenante del evento y el mensaje que se quiere desplegar
function error_val(campo,mensaje){

	var padre=campo.parent();
	var nombre_campo=campo.attr('name');
	var descripcion_error=nombre_campo+" "+mensaje;
	clase_div(padre,campo_invalido);
	//campo.after("<span></span>");
	padre.find("span[name='alerta']").addClass("help-block").html(descripcion_error);	
}
//fin funcion error

//funcion pra comprovar si el conenido de un imputo exite o no, debe pasarse como parametro
//la tabla, el campo, el valor de mysql que contiene el dato y por ultimo el campo desencadenante
function verificar_existencia(ver_tabla, ver_campo, ver_valor, form_campo){

	var comprobar={valor:ver_valor,
				   tabla:ver_tabla,
				   campo:ver_campo};


	$.post("./php/existencia.php",comprobar,function(e){

		if(e==="true"){error_val(form_campo,"ya existe");
			//alert("Se verifica y existe :"+ver_valor);
			}

		else if (e=="error"){error_val(form_campo,"error al verificar");
			
	}

		else {exito_val(form_campo);
			//alert("Se verifica y NO existe :"+ver_valor+""+e);
		}
	});
}
//FIN comprobar existencia

//Son alertas para el guardado de informacion se muestran en el div estado_almacenar

function alertas(estado, alerta_mensaje){

	var clase_dexito="alert alert-success";
	var clase_derror="alert alert-warning";
	var clase_serror="glyphicon glyphicon-floppy-remove";
	var clase_sexito="glyphicon glyphicon-floppy-saved";
	var clase_d;
	var clase_s;

	if(estado=="Error")
	{
		clase_d=clase_derror;	
		clase_s=clase_serror;
	}

	else 
	{
		clase_d=clase_dexito;
		clase_s=clase_sexito;
	}

	$("#estado_almacenar").removeClass().addClass(clase_d);
	$("#estado_almacenar strong").empty().append(estado+":");
	$("#estado_almacenar p").empty().append(alerta_mensaje);
	$("#icon_span").removeClass().addClass(clase_s);
	$("#estado_almacenar").show();
}
//fin alertas

/*
usa todas la funciones anteriores para comprobar los datos ingresados
*/
function validaciones (parametro,tipo){

		var campo=parametro;
		var valor=campo.val();
		var nombre=campo.attr('name');
		var tipo=campo[0].tagName;
						
		if (valor.trim()===''){ error_val(campo,": no puede estar vacio");}

		else if(valor == 0 ){ error_val(campo,": no puede ser igual a cero");	}

		else if (tipo!="SELECT" && valor.length<=4){error_val(campo,": es muy corto");}

		else if (valor.length>=4 && nombre=="Cedula")
		{
			verificar_existencia("persona","cedulaPersona",valor,campo);
			//alert("Verifica la cedula: "+valor	);
		}

		else if (nombre=="Identificacion"){

			getName(valor);

		}

		else if (valor=="seleccione"){error_val(campo,": sin seleccionar");}

		else exito_val(campo);
}

function getName(valor){


	var dato={cedula:valor};
	$.post("./php/getNombrePersona.php",dato,function(retorno){

		if(retorno=="inexistente"){  		
			$("#nombre_cliente").attr("value","Cliente no Existe");
			error_val($("#identifiacion")," es incorrecta");
			error_val($("#nombre_cliente")," es incorrecto");
		}

		else if(retorno=="activo"){
			error_val($("#identifiacion"),"esta inscrito actualmente");
			error_val($("#nombre_cliente")," es incorrecto");	
		}

		else {
			$("#nombre_cliente").attr("value",retorno);
			exito_val($("#identifiacion"));
			exito_val($("#nombre_cliente"));
		}
	});
}