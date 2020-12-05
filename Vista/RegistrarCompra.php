<?php 
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}
require_once("../Controlador/ControladorCompra.php");
require_once("../Controlador/ControladorInsumos.php"); 
require_once("../Controlador/controlador.php");
$ControladorCompra = new ControladorCompra();
$ControladorInsumo = new ControladorInsumo();
$controlador = new controlador();
$listarUsuarios = $controlador->listarUsuarios();
$listarinsumos = $ControladorInsumo->listarinsumos();
/*$listarProductos = $ControladorPedido->listarProductos();*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Compra</title>
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
    <p class="h1" align="center">Agregar Compra</p>
    </div>
    <div class="container mt-5 mb-5">
    <div class="login">
            <form id="frmcompra" name="frmcompra"  method="POST" action="../Controlador/ControladorCompra.php" >
            <input type="hidden" name="registrarcompra" id="registrarcompra">
                <label for="">Numero Compra</label> 
                <input type="text" name="idcompra" id="idcompra" class="form-control" readonly>
                <label id="usuariorequerido" for="">Usuario</label> 
                <select type="text"  name="usuario" id="usuario" class="form-control">
                    <option value="" >seleccione usuario</option>
                    <?php
                foreach($listarUsuarios as $usuario){
                    ?>
                    <option value="<?php echo $usuario->getIdUsuarios() ?>" ><?php echo $usuario->getNombre();  ?></option>
                    <?php
                }
                ?>                 
                </select>
                <label id="numerofacturarequerido" for="">Numero Factura</label> 
                <input type="text" name="numerofactura" id="numerofactura" class="form-control" >
                <label id="proveedorreuqerido" for="">Proveedor</label> 
                <input type="text" name="proveedor" id="proveedor"  class="form-control">
                <label for="">Insumo</label> 
                <select  type="text"  name="insumo" id="insumo" class="form-control" onchange="mostrarprecio(this.value);calcularvalordetalle()">
                    <option value="" >seleccione insumo</option>
                    <?php
                foreach($listarinsumos as $insumo){
                    ?>
                    <option value="<?php echo $insumo->getidinsumo() ?>" >
                    <?php echo $insumo->getnombreProducto();  ?></option>
                    <?php
                }
                ?>                 
                </select>
                <label for="">Precio:</label>
                <input type="text" name="precio" id="precio"  class="form-control"readonly >
                <label for="">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" min=1 value=1 onkeypress="calcularvalordetalle()"
                onkeyup= "calcularValorDetalle()" onkeydown="calcularValorDetalle()" >
                <label for="">Valor Total:</label>
                <input type="text" name="valortotal" id="valortotal" class="form-control" readonly >
                <label for="">Observaciones</label> 
                <input type="text" name="observaciones" id="observaciones"  class="form-control">
            </br>
        <button type="submit" name="registrarcompra" class="btn btn-primary">Agregar</button>  
        <a href="../menu.php" class="btn btn-success">REGRESAR</a>   

    
        </form>

        <div class="card-body" id="listadoDetallecompra">



        </div>

    </div>
</div>
</div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/validaciones.js"></script>
<script src="../js/validarCompra.js"></script>


<script>
    

function mostrarprecio(idinsumo){
    let idinsumoaux = 0;
    <?php
        foreach($listarinsumos as $I){ ?>
            idinsumoaux = <?php echo $I->getidinsumo(); ?>;//asignar a una variable jscript una variable php

            if(idinsumo == idinsumoaux){
                $("#precio").val(<?php echo $I->getprecio(); ?>)
            } 
        <?php
        }
    ?>      
}

function calcularValorDetalle()
{
    let cantidad = $("#cantidad").val();
    let precio = $("#precio").val();
    $("#valortotal").val(cantidad*precio);
}





</script>
</html>