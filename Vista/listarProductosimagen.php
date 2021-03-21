<?php
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}

require_once("../Modelo/CarritoCompras.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</head>
<body background="../Img/rsz_jaco-pretorius-agzehyx-jfo-unsplash_1.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Menú Productos</p>  
    </div>
    <a href="../menu.php" class="btn btn-primary" >Regresar</a>
    <a  href="ListaCarritoCompras.php"  ><img src="../Img/outline_shopping_cart_white_36dp.png" class=" my-3 my-sm-0 mr-sm-3" width="50" height="50" style="color:red;"></a> 
    <br>
    <br>
    <?php if($mensaje != "") { ?>
        <div class="alert alert-success">
        <?php echo $mensaje; ?>
            <br>
            <a href="ListaCarritoCompras.php" class="badge badge-success">Ver carrito</a>

        </div>
    <?php  } ?>
    <div class="row"> 
        <?php foreach($listarProductos as $C){  ?>
            <div class="col-3">
                    <div class="card">

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
                            <h5 class="card-title"><strong style="color:green;"><?php  echo $C->getPrecioProducto(); ?></strong></h5>
                            
                            <form action="listarProductosimagen.php" method="post">
                            
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($C->getidProducto(),COD,KEY); ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($C->getNombreProducto(),COD,KEY); ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php  echo openssl_encrypt($C->getPrecioProducto(),COD,KEY); ?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php  echo openssl_encrypt(1,COD,KEY); ?>">

                            <button class="btn btn-primary" name="btnAccion" id="btnAccion"
                            value="Agregar" type="submit">Agregar al carrito</button>
                            
                            </form>    
                        </div>
                    </div>
                    <br>
            </div>

            
        <?php }      
        ?>
    </div>
    
</body>
<script>
    $(function () {
            $('[data-toggle="popover"]').popover()
        }); 
</script>
</html>