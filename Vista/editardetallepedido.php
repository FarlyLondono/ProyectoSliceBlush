<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/ControladorPedido.php");
require_once("../Controlador/Controlador.php");
$Controlador = new Controlador();
$ControladorPedido = new ControladorPedido();
/*$ListarPedidos = $ControladorPedido->ListarPedidos();*/
$listarProductos = $ControladorPedido->listarProductos();
$buscardetallepedido= $ControladorPedido->buscardetallepedido($_GET["idDetallePedido"]);

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["editardetallepedido"])){
    $ControladorPedido->editardetallepedido();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle Pedido</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Detalle Pedido</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmdetallepedido" method="POST" action="editardetallepedido.php"> 
    <label for="">Id Detallepedido:</label>  
    <input type="text" readonly name="idDetallePedido" id="idDetallePedido" class="form-control" value="<?php echo $buscardetallepedido->getidDetallePedido(); ?>" readonly>
    <label for="">Id Pedido:</label>  
    <input type="text" readonly name="idPedido" id="idPedido" class="form-control" value="<?php echo $buscardetallepedido->getidPedido() ?>">
    <label for="">Producto:</label>
    <select type="text" name="idProducto" id="idProducto" class="form-control" onchange="mostrarprecio(this.value)" >
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarProductos as $Producto){
                    ?>
                    <option value="<?php echo $Producto->getidProducto() ?>" <?php if($Producto->getidProducto() == $buscardetallepedido->getidProducto()){ ?> selected <?php } ?> > <?php echo $Producto->getNombreProducto();  ?></option>
                    <?php
                }
                ?>                 
                </select>
    <label for="">Precio Producto:</label>
    <input type="text" name="precio" id="precio"  class="form-control" readonly > 
    <label for="">Cantidad:</label>  
    <input type="number" name="cantidad" id="cantidad" class="form-control" onkeypress="calcularvalordetalle()" 
    onkeyup= "calcularValorDetalle()" onkeydown="calcularValorDetalle()" value="<?php echo $buscardetallepedido->getcantidad() ?>" >
    <label>Valor Total:</label>
    <input type="number" name="valorDetalle" id="valorDetalle" class="form-control" readonly/>
    
    </br>

    <button type="submit" name="editardetallepedido" class="btn btn-primary">Editar</button>
    <a href="../menu.php" class="btn btn-success">REGRESAR</a>
        </form>

    </div>
</div>
</div>
</body>
<script>
    

    function mostrarprecio(){
    var idProducto = document.getElementById('idProducto').value;
    var cantidad = $("#cantidad").val();
    var idProductoAux = 0;
    <?php
    foreach($listarProductos as $P){
    ?>
       idProductoAux = <?php echo $P->getidProducto(); ?>; //Asignar a una variable jscript una variable php
       if(idProducto == idProductoAux){
        ($("#precio").val(<?php echo $P->getPrecioProducto();?>));
       }  
    <?php
    }
    ?>
}

function calcularValorDetalle()
{
    let Cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    $("#valorDetalle").val(Cantidad*precio);
}





</script>
</html>