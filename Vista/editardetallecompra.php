<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/Controladordetallecompra.php");
require_once("../Controlador/ControladorInsumos.php");
$ControladorInsumo = new ControladorInsumo();
$controladordetallecompra = new controladordetallecompra();
/*$ListarPedidos = $ControladorPedido->ListarPedidos();*/
$listarinsumos = $ControladorInsumo->listarinsumos();
$buscardetallecompra= $controladordetallecompra->buscardetallecompra($_GET["iddetallecompra"]);

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["editardetallecompra"])){
    $controladordetallecompra->editardetallecompra();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle Compra</title>
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
    <p class="h1" align="center">Editar Detalle Compra</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmdetallecompra" id="frmdetallecompra" method="POST" action="editardetallecompra.php"> 
    <label for=""></label>  
    <input type="hidden" readonly name="iddetallecompra" id="iddetallecompra" class="form-control" value="<?php echo $buscardetallecompra->getiddetallecompra() ?>" readonly>
    <label for=""></label>  
    <input type="hidden" readonly name="idcompra" id="idcompra" class="form-control" value="<?php echo $buscardetallecompra->getidcompra() ?>">
    <label for="">Insumo:</label>
    <select type="text" name="idinsumo" id="idinsumo" class="form-control" onchange="mostrarprecio(this.value)" >
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarinsumos as $insumo){
                    ?>
                    <option value="<?php echo $insumo->getidinsumo() ?>" <?php if($insumo->getidinsumo() == $buscardetallecompra->getidinsumo()){ ?> selected <?php } ?> > <?php echo $insumo->getnombreProducto();  ?></option>
                    <?php
                }
                ?>                 
                </select>
    <label for="">Precio:</label>
    <input type="text" name="precio" id="precio"  class="form-control" value="<?php echo $buscardetallecompra->getprecio() ?>" readonly > 
    <label for="">Cantidad:</label>  
    <input type="text" name="Cantidad" id="Cantidad" class="form-control" value="<?php echo $buscardetallecompra->getCantidad() ?>"  onkeypress="calcularvalordetalle()"
                onkeyup= "calcularValorDetalle()" onkeydown="calcularValorDetalle()">
    <label for="">Total:</label>  
    <input type="text" readonly name="Total" id="Total" class="form-control" value="<?php echo $buscardetallecompra->getTotal() ?>">
    <label for="">Observaciones:</label>  
    <input type="text" name="observaciones" id="observaciones" class="form-control" value="<?php echo $buscardetallecompra->getobservaciones() ?>">
    
    </br>

    <button type="submit" name="editardetallecompra" id="editardetallecompra" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>
        </form>

    </div>
</div>
</div>
</body>
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
    let Cantidad = $("#Cantidad").val();
    let precio = $("#precio").val();
    $("#Total").val(Cantidad*precio);
}

</script>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editardetallecompra").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatosdetallecompra()){    
        var dataString = $('#frmdetallecompra').serialize();
        $.post("editardetallecompra.php",dataString, function(response) { 
          //alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Registro Exitoso!!!',
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