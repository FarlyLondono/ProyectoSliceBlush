<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/ControladorProducto.php");
$controladordetalleproducto = new controladordetalleproducto();
$verdetalleproducto = $controladordetalleproducto->verdetalleproducto($_GET["idProducto"]);




function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

?>


    <script>
function boton(iddetallecompra) {
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
    $.ajax({url:"../Controlador/Controladordetallecompra.php?eliminardetallecompra&iddetallecompra="+iddetallecompra,
        success:()=>{
            window.location.href="../menu.php"
        }})
  }
})
    }
        </script>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Producto</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Detalle Producto</p>
        </div>    
            <table  class="table" id="detallecompra">
                <thead class="thead-dark">
                <hr>
                    <tr align="center">
                            <th align="center" >Nombre Insumo</th>
                            <th align="center">Cantidad</th>
                            <th >..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($verdetalleproducto as $C){ ?>
                        <tr align="center" >
                        <td align="center"><strong><?php echo $C->getNombreInsumo()  ?></strong></td>
                        <td align="center"><strong><?php echo $C->getCantidad()  ?></strong></td>
                        <td>
                        <a href="../Vista/editardetallecompra.php?editardetallecompra&iddetallecompra=<?php echo  $C->getiddetalleproducto(); ?>" class="btn btn-outline-warning">Editar</a>
                        <a onclick="boton(<?php echo $C->getiddetalleproducto(); ?>)" type="button" class="btn btn-outline-danger">Eliminar</a>
                        </td>     
                        </tr>

                   <?php }  ?>


                </tbody>    

            </table>
            <div class="card-header text-white">
            <a href="../menu.php" class="btn btn-success">REGRESAR</a>  
            </div> 
    </div>
   
</body>
<script type="text/javascript" charset="utf8" src="../js/dataTables.js"></script>
<script>
    $(document).ready(function() {
    $('#detallecompra').DataTable();
} );
</script>    
</html>