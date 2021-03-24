<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$buscarusuario= $controlador->buscarusuario($_GET["IdUsuarios"]);
$listarestado = $controlador->listarestados();
$listarRoles = $controlador->listarRoles();

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["editarUsuario"])){
    //$controlador->editarusuario();
    //desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Usuario</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmeditarusuario" id="frmeditarusuario"> 
    
    <input type="hidden" name="IdUsuarios" id="IdUsuarios" class="form-control" value="<?php echo $buscarusuario->getIdUsuarios() ?>" readonly>
    <label for="">Número Documento:</label>  
    <input type="text" name="NumeroDocumento" id="NumeroDocumento" class="form-control" value="<?php echo $buscarusuario->getNumeroDocumento() ?>">
    <label for="">Nombre:</label>  
    <input  type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo $buscarusuario->getNombre() ?>" >
    <label for="">Apellidos:</label>  
    <input type="text" name="Apellidos" id="Apellidos" class="form-control" value="<?php echo $buscarusuario->getApellidos() ?>">
    <label for="">Correo:</label>  
    <input type="text" name="Correo" id="Correo" class="form-control"  value="<?php echo $buscarusuario->getCorreo() ?>">
    <label for="">Contraseña:</label>  
    <input type="password" name="Contrasena" id="Contrasena" class="form-control"  value="<?php echo $buscarusuario->getContrasena() ?>">
    <label for="">Estado:</label>
    <select type="text" name="IdEstado" id="IdEstado" class="form-control">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarestado as $estado){
                    ?>
                    <option value="<?php echo $estado->getIdEstado() ?>" <?php if($estado->getIdEstado() == $buscarusuario->getIdEstado()){ ?> selected <?php } ?> > <?php echo $estado->getNombreEstado();  ?></option>
                    <?php
                }
                ?>                 
                </select>
    <label for="">Rol:</label>  
    <select type="text" name="IdRol" id="IdRol" class="form-control">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarRoles as $rol){
                    ?>
                    <option value="<?php echo $rol->getIdRol() ?>" <?php if($rol->getIdRol() == $buscarusuario->getIdRol()){ ?> selected <?php } ?> > <?php echo $rol->getNombreRol();  ?></option>
                    <?php
                }
                ?>                 
                </select>
</br>

    <button type="submit" name="editarUsuario" id="editarUsuario" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>     

        </form>

    </div>
</div>
</div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarUsuario").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarusurio()){    
        var dataString = $('#frmeditarusuario').serialize();
        $.post("../Vista/editarUsuario.php",dataString, function(response) { 
          alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Registro Exitoso!!!',
            showConfirButton: true,
            //timer: 2000
            }).then(function() {
            //window.location.href = "../menu.php"; 
            })});
        }) 
        }
    });    
});
</script>

</html>