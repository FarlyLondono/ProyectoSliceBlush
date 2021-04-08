<?php 
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}
require_once("../Modelo/conexion.php");
require_once("../Controlador/ControladorPedido.php");



$ControladorPedido = new ControladorPedido();
$ListarPedidos = $ControladorPedido->ListarPedidos();


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}



?>


<script>
function boton(idPedido) {
     Swal.fire({
  title: 'Estas Seguro??',
  text: "Tu no podras revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Borralo!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url:"../ProyectoSliceBlush/Controlador/ControladorPedido.php?eliminarPedido&idPedido="+idPedido,
        success:()=>{
            window.location.href="../ProyectoSliceBlush/menu.php"
        }})
  }
})
    }
        </script>
<link rel="stylesheet" href="Css/estyleTables.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <div class="card-bordy">
    <div class="card text-white bg-secondary mb-3">
    <h1 align="center">Lista Pedidos</h1>
    </div>
    <?php
     $sesion = $_SESSION["IdRol"];
    if($sesion == 1 || $sesion == 2 )
    {
    ?>
    <?php
    }
    ?>
    <div id="formContent">
    <div class="card-bordy">
    <table class="table" id="listadoPedidos">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        
                        <th>Cliente</th>
                        <th>Fecha Registro</th>
                        <th>Total Pedido</th>
                        <th>Estado Pedido</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(is_array($ListarPedidos)){
                    foreach($ListarPedidos as $Pedido){ ?>
                        <tr>
                        
                        <td><strong><?php echo $Pedido->getNombre()  ?></strong></td>
                        <td><?php echo $Pedido->getFechaRegistro()  ?></td>
                        <td><strong style="color:green;"><?php echo $Pedido->getTotalPedido()  ?></strong></td>
                        <td><?php echo $Pedido->getNombreEstadoPedido()  ?></td>     
                        <td>
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1 || $sesion == 2)
                        {
                            ?>
                        <a href="../ProyectoSliceBlush/Controlador/ControladorPedido.php?editarPedido&idPedido=<?php echo  $Pedido->getidPedido(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                        <a  href="../ProyectoSliceBlush/Controlador/ControladorPedido.php?verdetallepedido&idPedido=<?php echo  $Pedido->getidPedido(); ?>" class="btn btn-outline-primary"><img style="width: 25px; height: 25px;" src="Img/verdetalle.png" alt="">Ver Detalle</a>
                        <a onclick="boton(<?php echo $Pedido->getidPedido(); ?>)" type="button" class="btn btn-outline-danger"><img style="width: 25px; height: 25px;" src="Img/eliminar.png" alt="">Eliminar</a>
                        <?php
                        }
                        ?>
                        </td>     
                        </tr>
                   <?php }  ?>
                    <?php }?>

                </tbody>    

            </table>
            <?php
                $sesion = $_SESSION["IdRol"];
                if($sesion == 1 || $sesion == 2)
                {
            ?> 
            <a href="Vista/RegistrarPedido.php" class="btn btn-primary">Nuevo Pedido</a>
            <a href="Vista/reportePedidos.php" target="_black" class="btn btn-warning">Generar Reporte</a>
            <?php
                        }
                        ?>
    </div>
    </div>
                    </div>
</body>
<script>
    $(document).ready(function() {
    $('#listadoPedidos').DataTable();
} );
</script> 
</html>