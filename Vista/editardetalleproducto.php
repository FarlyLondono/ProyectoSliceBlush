<?php
session_start();
$sesion = $_SESSION["IdRol"];

if (!isset($_SESSION["Correo"])) {
    header("Location:../index.php");
} elseif ($sesion <> 1) {
    header("Location:../index.php");
}
require_once("../Controlador/ControladorProducto.php");
require_once("../Controlador/ControladorInsumos.php");
$ControladorInsumo = new ControladorInsumo();
$controladordetalleproducto = new controladordetalleproducto();
/*$ListarPedidos = $ControladorPedido->ListarPedidos();*/
$listarinsumos = $ControladorInsumo->listarinsumos();
$buscardetalleproducto = $controladordetalleproducto->buscardetalleproducto($_GET["iddetalleproducto"]);

function desplegarVista($ruta)
{
    header('Location: ' . $ruta);
}
function desplegarVista2($ruta)
{
    require_once($ruta);
}

if (isset($_POST["editardetalleproducto"])) {
    $controladordetalleproducto->editardetalleproducto();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle Producto</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
            <p class="h1" align="center">Editar Detalle Producto</p>
        </div>

        <div class="container mt-5 mb-5">
            <div class="card-bordy">

                <form name="frmdetalleproducto" id="frmdetalleproducto">
                    <input type="hidden" name="editardetalleproducto" />
                    <label for=""></label>  
                    <input type="hidden" name="idProducto" id="idProducto" readonly value="<?php echo $buscardetalleproducto->getidProducto()  ?>">
                    <label for=""></label>  
                    <input type="hidden" name="iddetalleproducto" id="iddetalleproducto" class="form-control" value="<?php echo $buscardetalleproducto->getiddetalleproducto() ?>" readonly>
                    <label for="">Insumo:</label>
                    <select type="text" name="idinsumo" id="idinsumo" class="form-control" onchange="mostrarUmedida(this.value);">
                        <option value="">seleccione insumo</option>
                        <?php
                        foreach ($listarinsumos as $insumo) {
                        ?>

                            <option value="<?php echo $insumo->getidinsumo() ?>" <?php if ($insumo->getidinsumo() == $buscardetalleproducto->getidinsumo()) { ?> selected <?php } ?>> <?php echo $insumo->getnombreProducto();  ?></option>

                        <?php
                        }
                        ?>
                    </select>

                    <label for="">Unidad de medida:</label>
                    <input type="text" name="unidadMedida" id="unidadMedida" class="form-control" value="<?php echo $buscardetalleproducto->getunidadMedida() ?>" readonly>
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control" value="<?php echo $buscardetalleproducto->getcantidad() ?>">

                    </br>

                    <button type="submit" name="editardetalleproducto" id="editardetalleproducto" class="btn btn-success">Editar</button>
                    <a href="../menu.php" class="btn btn-primary">Regresar</a>
                </form>


            </div>
        </div>
    </div>
</body>
<script>
    function mostrarUmedida(idinsumo) {
        let idinsumoaux = 0;
        <?php
        foreach ($listarinsumos as $I) { ?>
            idinsumoaux = <?php echo $I->getidinsumo(); ?>; //asignar a una variable jscript una variable php

            if (idinsumo == idinsumoaux) {
                $("#unidadMedida").val("<?php echo $I->getunidadmedida(); ?>")
            }
        <?php
        }
        ?>
    }
</script>
<script src="../js/validaciones.js"></script>
<script>
  $(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editardetalleproducto").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validardatosdetalleproducto()){    
        var dataString = $('#frmdetalleproducto').serialize();
        $.post("editardetalleproducto.php",dataString, function(response) { 
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