<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cli Gimn</title>
    <?php
    require './php/librerias.php'
    ?>
  
   <script>

        $(document).ready(function(){

            $("#estado_login").hide();

            $("#boton_ingreso").click(enviar);

            function error_sesion (){
                    $("#estado_login").addClass("alert alert-warning");
                    $("#estado_login strong").empty();
                    $("#estado_login strong").append("Error:");
                    $("#estado_login p").empty();
                    $("#estado_login p").append("Hay problemas con credenciales de usuario");
                    $("#estado_login").show();
            }

            function enviar () {
                var usuario_val=$("#nombre_usuario").val();
                var clave_usuario =$("#clave_usuario").val();

                if(usuario_val.length>0 & clave_usuario.length>0){

                    var paquete={user:usuario_val, pass: clave_usuario};
                    
                    //funcion ("destino","datos_enviados","funcion que procesa la respuesta")
                     $.post("./php/verifica_user.php", paquete, ingreso_app)
                }

                else  error_sesion ();
             };


            function ingreso_app (datos_login) {

                if(datos_login=="autorizado")

                {
                  
                   $("form").submit();
                   //$(location).attr('href','gimnasio.php');
                }

                else  error_sesion ();
             }
        });
   </script>
</head>
<body class="container-fluid">
<header class="header-page">

<h1 class="text-center">ClicGim<small> un sistema de Membresias</small></h1>
    
</header><!-- /header -->
    <section>
        <div>

            <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-8" >
                  </div> 
                  <div class="col-xs-6 col-md-4"> 
                  </div>

            </div>

            <div class="row">
                <!--LOGIN-->
                <div class="col-xs-12 col-sm-6 col-md-8"> 
                   <form action="./php/login.php" method="post">
                        <div class="panel panel-primary">    
                            <div class="panel-heading">
                                Inicio de sesión
                            </div>
                            
                           <div class="panel-body">    
                                <div class="form-group">
                                   <label>Nombre de usuario </label>
                                   <input type="text" name="nombre" class="form-control" id="nombre_usuario" required> </input> 
                                </div>
                                       
                                <div class="form-group">
                                    <label>Clave</label>
                                    <input type="password" name="clave"  class="form-control" id="clave_usuario" required>
                                 </div>

                                <div class="">
                                   <input type="button" name="btn_ingreso" value="Ingresar" class="btn btn-default" id="boton_ingreso">
                                   <input type="reset" name="btn_reset" value="Cancelar" class="btn btn-default" id="boton-reseteo">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="estado_login" role="alert">
                    <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                         <span aria-hidden='true'>&times;</span>
                    </button>
                    <span  aria-hidden='true' id='icon_span'></span>
                    <strong></strong>
                    <p style="display: inline"></p>
                </div>
                <!--FIN LOGIN--> 

                <!--CHACHARA-->
                <div class="col-xs-12 col-sm-6 col-md-7 " >

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Mision</h3>
                            <p>Controlar las membresias que provee el gimnasio. </p><p>Cli Gim te permitira:</p>
                             <ol>
                                 <li>Crear usuarios para tus instructores</li>
                                 <li>Crear membresias</li>
                                 <li>Registrar clientes</li>
                                 <li>Controlar vigencia de las membresias</li>
                                 <li>Balances</li>
                             </ol>
                        </div>
                     </div>
                </div> 
                <!--FIN CHACHARA-->
               
            </div>
        </div>                  
    </section>
<footer>

            <address>
                  <strong>Pablo Cesar Agudelo</strong><br>
                  Soft Developer<br/>
                  <abbr title="Phone">Cel:</abbr> (+57) 312-602-1142<br/>
                  <a href="mailto:#">pcaguddelo@gmail.com</a>
            </address>

    
</footer>

</body>
</html>