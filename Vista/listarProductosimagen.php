<?php
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}
include "../Modelo/CarritoCompras.php";
require_once("../Modelo/conexion.php");
require_once("../Modelo/config.php");
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarProductos = $controlador-> listarProductos();


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    
</head>
<body background="../Img/rsz_jaco-pretorius-agzehyx-jfo-unsplash_1.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Productos</p>  
    </div>
    
    <br>
    <?php if($mensaje != "") { ?>
        <div class="alert alert-success">
        <?php echo $mensaje; ?>
            <br>
            <a href="Vista/ListaCarritoCompras.php" class="badge badge-success">Ver carrito</a>

        </div>
    <?php  } ?>
    <div class="row"> 
        <?php foreach($listarProductos as $key=>$C){  ?>
            <div class="col-3"  >
                    <div class="card" >
                        <img
                        title="<?php echo $C->getNombreProducto(); ?>" 
                        alt="<?php  echo $C->getNombreProducto(); ?>"
                        class="card-img-top" src="<?php echo $C->getimagen(); ?>"
                        data-toggle="popover"
                        data-trigger="hover"
                        data-content="<?php  echo $C->getDescripcionProducto(); ?>"
                        height="250px"
                        >
                        <div class="card-body">
                            <span><strong><?php echo $C->getNombreProducto(); ?></strong></span>
                            <p class="card-text"><?php  echo $C->getDescripcionProducto(); ?></p>
                            <h5 class="card-title"><strong style="color:green;"><?php  echo $C->getPrecioProducto(); ?></strong></h5>
                            
                            
                           

                            
                            
                            <input type="hidden" name="idProducto" id="idProducto<?php echo $key ?>" value="<?php echo openssl_encrypt($C->getidProducto(),COD,KEY); ?>">
                            <input type="hidden" name="nombre" id="nombre<?php echo $key ?>" value="<?php echo openssl_encrypt($C->getNombreProducto(),COD,KEY); ?>">
                            <input type="hidden" name="precio" id="precio<?php echo $key ?>" value="<?php  echo openssl_encrypt($C->getPrecioProducto(),COD,KEY); ?>">
                            <input type="hidden" name="cantidad" id="cantidad<?php echo $key ?>" value="<?php  echo openssl_encrypt(1,COD,KEY); ?>">

                            <button class="btn btn-primary" name="btnAccion" id="btnAccion"
                            value="Agregar" onclick="addcar(<?php echo $key ?>)" type="button">Agregar al carrito</button>
                            
                            
                        </div>
                    </div>
                    <br>
            </div>

            
        <?php }      
        ?>
    </div>
    
</body>
<script>

    function addcar(id){
        $.ajax({
            type: "POST",
            url: "Vista/listarProductosimagen.php",
            data: {
                idProducto:$('#idProducto'+id).val(),
                nombre:$('#nombre'+id).val(),
                precio:$('#precio'+id).val(),
                cantidad:$('#cantidad'+id).val(),
                btnAccion:"Agregar"
            },
            success : (data)=>{
                $('#navigation').html(data);
            }
        })
        console.log($("#nombre"+id).val());
    }

    /*    $(function () {
                $('[data-toggle="popover"]').popover()
            }); */
</script>
</html>