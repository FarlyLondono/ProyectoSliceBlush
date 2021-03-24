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
$listarCliente = $controlador->listarClientes();
$buscarCliente= $controlador->buscarCliente($_GET["idCliente"]);

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_GET["editarCliente"])){
    desplegarVista2("editarCliente.php");
}
elseif(isset($_POST["editarCliente"])){
    $controlador->editarCliente();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
    <p class="h1" align="center">Editar Cliente</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmcliente" id="frmcliente" > 
    <input type="hidden" name="editarCliente"/>
    <input type="hidden" name="idCliente" id="idCliente" class="form-control" value="<?php echo $buscarCliente->getidCliente() ?>" readonly>
    <label for="">Nombre:</label>  
    <input type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo $buscarCliente->getNombre() ?>">
    <label for="">Correo:</label>  
    <input  type="text" name="Correo" id="Correo" class="form-control" value="<?php echo $buscarCliente->getCorreo() ?>" >
    <label for="">Dirección:</label>  
    <input type="text" name="Direccion" id="Direccion" class="form-control" value="<?php echo $buscarCliente->getDireccion() ?>">
    <label for="">Teléfono:</label>  
    <input type="text" name="Telefono" id="Telefono" class="form-control"  value="<?php echo $buscarCliente->getTelefono() ?>">
    <label for="">Contraseña:</label>  
    <input type="password" name="Contrasena" id="Contrasena" class="form-control"  value="<?php echo $buscarCliente->getContrasena() ?>">

</br>

    <button type="submit" name="editarCliente" id="editarCliente" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>     

    </form>

    </div>
</div>
</div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarCliente").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarcliente()){    
        var dataString = $('#frmcliente').serialize();
        $.post("editarCliente.php",dataString, function(response) { 
          //alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Actualización Exitosa!!!',
            showConfirButton: true,
            //timer: 2000
            }).then(function() {
            window.location.href = "../menu.php"; 
            })});
        }) 
        }
    });    
});
</script>

</html>