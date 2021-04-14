<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
        <link rel="stylesheet" href="../Css/estyleTables.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card-bordy">
    <div class="card text-white bg-secondary mb-3">
    <h1 align="center">Lista Carrito de Compras</h1>
    <a href="../menu.php" class="btn btn-success">REGRESAR</a> 
    <?php if(!empty($_SESSION['CARRITO'])){ ?>
    </div>
    <div id="formContent">
    <div class="card-bordy">
    <table class="table" id="listadoPedidos">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        
                        <th width="40%">Nombre Producto</th>
                        
                        <th width="20%"  class="text-center">Precio</th>
                        <th width="15%" class="text-center">SubTotal</th>
                        <th>--</th>
                    </tr>
                </thead>
                <tbody>

                        <tr>
                            <td colspan="5">
                            <?php  $total=0; ?>
                            <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
                            <tr>
                            
                                <td width="40%"><?php echo $producto['NOMBRE'] ?></td>
                                
                                <td width="20%" class="text-center"><?php echo $producto['precio'] ?></td>
                                <td width="20%" class="text-center"><?php echo number_format($producto['precio'] * $producto['cantidad'], 2);  ?></td>
                            
                            <td width="5%">
                            <form action="ListaCarritoCompras.php" method="post">
                            <input type="hidden" name="id"
                            id="id" value="<?php echo openssl_encrypt($producto['idProducto'],COD,KEY); ?>">

                                <button class="btn btn-danger"
                                type="submit"
                                name="btnAccion"
                                value="Eliminar"
                                >Eliminar</button>

                            </form>
                            </td>
                        </tr>
                        <?php  $total=$total+($producto['precio']*$producto['cantidad']); ?>

                        <?php } ?>

                        <tr>
                            <td colspan="5">
                                <form name="frmPagar" id="frmPagar">
                                <input type="hidden" name="proceder" id="proceder" />
                           
                        <tr>
                            <td colspan="3" align="right"><h3>Total</h3></td>
                            <td align="right"><h3><?php echo number_format($total,2); ?></h3></td>
                            <td></td>
                        </tr>
                                <div class="alert alert-success">
                                <div class="form-group">
                                        <label for="my-input">Correo de Contacto:</label>
                                        <input id="email"
                                        class="form-control"
                                        type="email" value="<?php echo $_SESSION["Correo"]?>" name="email" readonly>
                                        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
                                         <input type="hidden" name="idProducto" id="idProducto" value="<?php echo number_format($producto['idProducto']); ?>">
                                      
                                        <input type="hidden"name="cantidad" id="cantidad" value="<?php echo number_format( $producto['cantidad']);?>" > 

                                        <input type="hidden" name="precio" id="precio" value="<?php echo ($producto['precio']);?>" >
                                        
                                         <?php } ?> 

                                    <button class="btn btn-success btn-lg btn-block" 
                                    type="submit"  id="proceder" name="proceder">Pago en efectivo>></button>
                                </form>
                                </div>
                                        <small id="emailHelp" class="form-text text-muted">
                                    Gracias por preferirnos,estaremos en contacto para su entrega.
                                    </small>
                                        </div>
                                
                                <form type="hidden" name="frmPagar2"  >
                                       
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
    <script >
        $("#proceder").on('click',function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
            $("#frmPagar").submit(function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
            var dataString = $('#frmPagar').serialize();    
                $.post("../Controlador/ControladorPedido.php",dataString, function(response) {
                        alert("Gracias por preferirnos!!! \n En unos instantes nos comunicaremos \n con usted para confirmar  su pedido"); 
                    window.location='../menu.php';    
                }); 
            }
            );
        });


function calcularValorDetalle()
        {
            let cantidad = $("#cantidad").val();
            let precio = $("#precio").val();
            $("#valorDetalle").val(cantidad*precio);
        }
            

</script>

</html>

