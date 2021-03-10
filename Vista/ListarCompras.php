<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion == 0){
    header("Location:../index.php");
}

require_once("../Controlador/ControladorCompra.php");
$ControladorCompra = new ControladorCompra();
$listarcompras = $ControladorCompra-> listarcompras();

/*SELECT f.idcompra,f.IdUsuarios,f.proveedor, f.numerofactura,
f.fechacompra,sum(r.Total) FROM compras AS f INNER JOIN detallecompra
 AS r ON f.idcompra=r.idcompra WHERE f.idcompra= 11*/

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
    $.ajax({url:"../ProyectoSliceBlush/Controlador/ControladorCompra.php?eliminarcompra&idcompra="+idcompra,
        success:()=>{
            window.location.href="../ProyectoSliceBlush/menu.php"
        }})
  }
})
    }
        </script>



<link rel="stylesheet" href="Css/estyleTables.css">
<title>Gestionar las Compras</title>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista de Compras</p>
        </div>    
        <div id="formContent">
            <table class="table" id="listarcompras">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>Id</th>
                        <th>Nombre Usuario</th>
                        <th>Proveedor</th>
                        <th>Numero Factura</th>
                        <th>Fecha Compra</th>
                        <th>Total</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listarcompras as $C){ ?> 
                        <tr>
                        <td><?php echo $C->getidcompra()  ?></td>
                        <td><strong><?php echo $C->getNombre()  ?></strong></td>
                        <td><?php echo $C->getproveedor()  ?></td>
                        <td><?php echo $C->getnumerofactura()  ?></td>
                        <td><?php echo $C->getfechacompra()  ?></td>
                        <td><strong style="color:green;"><?php echo $C->getTotal()  ?></strong></td> 
                        <td>
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?>
                        <a href="Vista/editarCompra.php?editarcompra&idcompra=<?php echo  $C->getidcompra(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                        <a  href="Controlador/Controladordetallecompra.php?verdetallecompra&idcompra=<?php echo  $C->getidcompra(); ?>" class="btn btn-outline-primary">Ver Detalle</a>
                        <a onclick="boton(<?php echo $C->getidcompra(); ?>)" type="button" class="btn btn-outline-danger"><img style="width: 25px; height: 25px;" src="Img/eliminar.png" alt="">Eliminar</a>
                        <?php
                        }
                        ?>  
                        </td>     
                        </tr>

                   <?php }  ?>


                </tbody>    

            </table>
            <div class="card-header text-white">
                <a href="Vista/RegistrarCompra.php" class="btn btn-primary">AGREGAR</a>
            </div> 

       



    </div>
                    </div>
</body>
<script>
    $(document).ready(function() {
    $('#listarcompras').DataTable();
} );
</script>    
</html>

