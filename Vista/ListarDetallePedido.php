<?php 

require_once("../Controlador/ControladorPedido.php");

$ControladorPedido = new ControladorPedido();
$ListaDetallePedido = $ControladorPedido->ListarDetallePedido($_POST["idPedido"]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script> 
    
</head>
<body>

    <div class="card text-white bg-secondary mb-2">
     <p class="h1" align="center">Detalle Pedidos</p>
    </div>
    <div class="card-bordy">
    <table class="table" id="ListarDetallePedido">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>id Detalle Pedido</th>
                        <th>id Pedido</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ListaDetallePedido as $detallePedidos)
                        { 
                        ?>
                        <tr>
                        <td><?php echo $detallePedidos->getidDetallePedido()  ?></td>
                        <td><?php echo $detallePedidos->getidPedido()  ?></td>
                        <td><strong><?php echo $detallePedidos->getNombreProducto()  ?></strong></td>
                        <td><?php echo $detallePedidos->getcantidad()  ?></td>  
                        <td><strong><?php echo $detallePedidos->getprecio()?></strong></td>

                        </tr>

                   <?php }  ?>

 
                </tbody>    

            </table>
    </div>
    </div>
</body>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
    $('#ListaDetallePedido').DataTable();
} );
</script> 
</html>