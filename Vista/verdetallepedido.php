<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
$verdetallepedido = $ControladorPedido->verdetallepedido($_GET["idPedido"]);




function desplegarVista($ruta)
{
    header('Location: ' . $ruta);
}
function desplegarVista2($ruta)
{
    require_once($ruta);
}

?>


<script>
    function boton(idDetallePedido) {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Tu no podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, Borralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../Controlador/ControladorPedido.php?eliminarDetallePedido&idDetallePedido=" + idDetallePedido,
                    success: () => {
                        window.location.href = "../menu.php"
                    }
                })
            }
        })
    }
</script>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Pedido</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
            <p class="h1" align="center">Lista Detalle Pedido</p>
        </div>
        <div id="formContent">
            <table class="table" id="detallepedido">
                <thead class="thead-dark">
                    <hr>
                    <tr align="center">
                        
                        <th>Id Pedido</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Valor Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verdetallepedido as $C) { ?>
                        <tr align="center">
                            
                            <td><strong><?php echo $C->getidPedido()  ?></strong></td>
                            <td><?php echo $C->getNombreProducto()  ?></td>
                            <td><strong><?php echo $C->getcantidad()  ?></strong></td>
                            <td><?php echo $C->getprecio()  ?></td>
                            <td>
                                <a href="../Vista/editardetallepedido.php?editardetallepedido&idDetallePedido=<?php echo  $C->getidDetallePedido(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                                <a onclick="boton(<?php echo $C->getidDetallePedido(); ?>)" type="button" class="btn btn-outline-danger"><img style="width: 25px; height: 25px;" src="Img/eliminar.png" alt="">Eliminar</a>
                            </td>
                        </tr>

                    <?php }  ?>


                </tbody>

            </table>
        </div>

        <div class="card-header text-white">
            <a href="../menu.php" class="btn btn-success">REGRESAR</a>
        </div>
    </div>


</body>
<script type="text/javascript" charset="utf8" src="../js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#detallepedido').DataTable();
    });
</script>

</html>