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
$ControladorPedido = new ControladorPedido();
$listarClientes = $ControladorPedido->listarClientes();
$listarProductos = $ControladorPedido->listarProductos();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Agregar Pedido</p>
    </div>
    <div class="container mt-5 mb-5">
    <div class="card-bordy">
        <form name="frmpedido" id="frmpedido" method="POST" action="../Controlador/ControladorPedido    .php"> 
        <input type="hidden" name="RegistrarPedido" id="RegistrarPedido" />
        <label for="">Numero pedido:</label>  
        <input type="text" name="idPedido" id="idPedido" class="form-control" readonly />
        <label for="">Cliente:</label>  
        <select type="text" name="Cliente" id="Cliente" class="form-control">
            <option value="">Seleccione Cliente</option>
            <?php 
                foreach($listarClientes as $Cliente){
                    ?>
                    <option value="<?php echo $Cliente -> getidCliente() ?>">
                    <?php echo $Cliente->getNombre() ?>
                    </option>
                    <?php
                }
            ?>
        </select>
        <label for="">Producto:</label>  
        <select type="text" name="producto" id="producto" class="form-control" onchange="mostrarPrecio(this.value); calcularValorDetalle()">
        <option value="">Seleccione El Producto</option>
        <?php 
                foreach($listarProductos as $Producto){
                    ?>
                    <option value="<?php echo $Producto -> getidProducto() ?>">
                    <?php echo $Producto->getNombreProducto(); ?>
                    </option>
                    <?php
                }
            ?>
        </select>
        <label>Precio:</label>
        <input type="text" name="precio" id="precio" class="form-control" readonly />
        <label>Cantidad:</label>
        <input type="text" name="cantidad" id="cantidad" class="form-control" min=1 value=1 onkeypress="calcularValorDetalle()" onkeyup="calcularValorDetalle()" onkeydown="calcularValorDetalle()"/>
        <label>Valor Detalle:</label>
        <input type="text" name="valorDetalle" id="valorDetalle" class="form-control" readonly/>

</br>
        <button type="submit" name="RegistrarPedido" class="btn btn-primary">Agregar</button>  
        <a href="../menu.php" class="btn btn-success">REGRESAR</a>   

    
        </form>

        <div class="card-body" id="ListadoDetallePedido">



        </div>

    </div>
</div>
</div>
</body>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/validacionesPedido.js"></script> 
<script>
    

function mostrarPrecio(idProducto)
{
    let idProductoAux=0;
    <?php
    foreach($listarProductos as $P){
    ?>
        idProductoAux = <?php  echo $P->getidProducto(); ?>;
        if(idProducto == idProductoAux)
        {
            $("#precio").val(<?php echo $P->getPrecioProducto(); ?>);
        }
        <?php
    }
    ?>
}

function calcularValorDetalle()
{
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    $("#valorDetalle").val(cantidad*precio);
}
        
</script>
</html>