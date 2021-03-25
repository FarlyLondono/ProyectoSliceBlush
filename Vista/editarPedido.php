<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion == 0){
    header("Location:../index.php");
}
require_once("../Controlador/ControladorPedido.php");
require_once("../Controlador/controlador.php");
$ControladorPedido = new ControladorPedido();
$listarClientes = $ControladorPedido->listarClientes();
$listarestadopedido = $controlador->listarestadopedido();
$ListarPedidos = $ControladorPedido->ListarPedidos();
$buscarPedido= $ControladorPedido->buscarPedido($_GET["idPedido"]);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditarPedido</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Pedido</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmpedido" id="frmpedido" > 
    <input type="hidden" name="editarPedido" />
    <input type="hidden" name="idPedido" id="idPedido" class="form-control" value="<?php echo $buscarPedido->getidPedido() ?>" readonly>
    <label for="">Cliente:</label>  
    <select type="text" name="idCliente" id="idCliente" class="form-control">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarClientes as $estado){
                    ?>
                    <option value="<?php echo $estado->getidCliente() ?>" 
                    <?php if($estado->getidCliente() == $buscarPedido->getidCliente())
                    { ?> selected <?php } ?> > <?php echo $estado->getNombre();  ?>
                    </option>
                    <?php
                }
                ?>                 
                </select>
    <label for="">Fecha Registro:</label>  
    <input type="text" name="fechaRegistro" id="fechaRegistro" class="form-control" value="<?php echo $buscarPedido->getfechaRegistro() ?>" readonly>
    <label for="">Estado Pedido:</label>  
    <select type="text" name="IdEstadoPedido" id="IdEstadoPedido" class="form-control">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarestadopedido as $estado){
                    ?>
                    <option value="<?php echo $estado->getIdEstadoPedido() ?>" 
                    <?php if($estado->getIdEstadoPedido() == $buscarPedido->getIdEstadoPedido())
                    { ?> selected <?php } ?> > <?php echo $estado->getNombreEstadoPedido();  ?>
                    </option>
                    <?php
                }
                ?>                 
                </select>
                </br>

    <button type="submit" name="editarPedido" id="editarPedido" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>     
        
        </form>

    </div>
</div>
</div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarPedido").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarpedido()){    
        var dataString = $('#frmpedido').serialize();
        $.post("../Controlador/ControladorPedido.php",dataString, function(response) { 
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