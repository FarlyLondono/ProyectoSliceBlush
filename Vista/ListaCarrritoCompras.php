<?php 
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}
require_once("../Modelo/conexion.php");
require_once("../Controlador/ControladorPedido.php");
require_once("../Modelo/config.php");
require_once("../Modelo/CarritoCompras.php");



$ControladorPedido = new ControladorPedido();
$ListarPedidos = $ControladorPedido->ListarPedidos();


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
    <title>Carrito de Compras</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../Css/estyleTables.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card-bordy">
    <div class="card text-white bg-secondary mb-3">
    <h1 align="center">Lista Carrito de Compras</h1>
    <a href="listarProductosimagen.php" class="btn btn-success">REGRESAR</a> 
    <?php if(!empty($_SESSION['CARRITO'])){ ?>
    </div>
    <div id="formContent">
    <div class="card-bordy">
    <table class="table" id="listadoPedidos">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th width="40%">Nombre Producto</th>
                        <th width="15%" class="text-center">Cantidad</th>
                        <th width="20%" class="text-center">Precio</th>
                        <th width="20%" class="text-center">SubTotal</th>
                        <th>--</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $total=0; ?>
                    <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
                            <tr>
                            <td width="40%"><?php echo $producto['NOMBRE'] ?></td>
                            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
                            <td width="20%" class="text-center"><?php echo $producto['PRECIO'] ?></td>
                            <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2);  ?></td>
                            
                            <td width="5%">



                            <form action="ListaCarritoCompras.php" method="post">
                            <input type="hidden" name="id"
                            id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY); ?>">

                                <button class="btn btn-danger"
                                type="submit"
                                name="btnAccion"
                                value="Eliminar"
                                >Eliminar</button>

                            </form>
                            </td>
                        </tr>
                        <?php  $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); ?>

                        <?php } ?>
                        <tr>
                            <td colspan="3" align="right"><h3>Total</h3></td>
                            <td align="right"><h3><?php echo number_format($total,2); ?></h3></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="5">
                                <form action="../Modelo/pagar.php" method="post">
                                <div class="alert alert-success">
                                <div class="form-group">
                                        <label for="my-input">Correo de Contacto:</label>
                                        <input id="email"
                                        class="form-control"
                                        type="email" value="<?php echo $_SESSION["Correo"]?>" name="email" readonly>
                                </div>
                                    <small id="emailHelp" class="form-text text-muted">
                                    Gracias por preferirnos,estaremos en contacto para su entrega.
                                    </small>

                                </div>
                                    <button class="btn btn-success btn-lg btn-block"
                                    type="submit" value="proceder" name="btnAccion">Pago en efectivo>></button>
                                </form>
                            </td>
                        </tr>
                </tbody>
            </table> 
              
    </div>
    </div>
</div>
<?php }else{ ?>
<div class="alert alert-success" >
No hay productos en el carrito...
</div>

<?php } ?>
</body>

</html>