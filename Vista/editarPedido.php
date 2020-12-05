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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Pedido</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmpedido" method="POST" action="../Controlador/ControladorPedido.php"> 
    <label for="">idPedido:</label>  
    <input type="text" name="idPedido" id="idPedido" class="form-control" value="<?php echo $buscarPedido->getidPedido() ?>" readonly>
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
                </br>
    <label for="">fecha Registro:</label>  
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

    <button type="submit" name="editarPedido" class="btn btn-primary">Editar</button>
    <a href="../menu.php" class="btn btn-success">REGRESAR</a>     
        
        </form>

    </div>
</div>
</div>
</body>
</html>