<?php
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}

require_once("../Controlador/Controladordetallecompra.php");
$controladordetallecompra = new controladordetallecompra();
$listardetallecompra = $controladordetallecompra-> listardetallecompra($_POST["idcompra"]);


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}


?>

<script>
function boton(idcompra) {
     Swal.fire({
  title: 'Esta seguro que desea eliminar el registro?',
  text: "Esta decision es irreversible!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url:"../CRUDC/Controlador/ControladorCompra.php?eliminarcompra&idcompra="+idcompra,
        success:()=>{
            window.location.href="../CRUDC/menu.php"
        }})
  }
})
    }
        </script>



<head>
<title>Gestionar Detalle Compras</title>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        
</head>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Detalle Compra</p>
        </div>    
            <table class="table" id="listarcompras">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>Id Detalle Compra</th>
                        <th>Id Insumo</th>
                        <th>Nombre Insumo</th>
                        <th>Id compra</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listardetallecompra as $C){ ?> 
                        <tr>
                        <td><strong><?php echo $C->getiddetallecompra()  ?></strong></td>
                        <td><strong><?php echo $C->getidinsumo()  ?></strong></td>
                        <td><strong><?php echo $C->getnombreProducto()  ?></strong></td>
                        <td><strong><?php echo $C->getidcompra()  ?></strong></td>
                        <td><strong><?php echo $C->getCantidad()  ?></strong></td>
                        <td><strong><?php echo $C->getTotal()  ?></strong></td>
                        <td><strong><?php echo $C->getobservaciones()  ?></strong></td>        
                            
                        </tr>

                   <?php }  ?>


                </tbody>    

            </table>
       



    </div>
    
</body>
<script type="text/javascript" charset="utf8" src="../js/dataTables.js"></script>
<script>
    $(document).ready(function() {
    $('#listarcompras').DataTable();
} );
</script>    
</html>