<?php
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}

require_once("../Controlador/ControladorProducto.php");
$controladordetalleproducto = new controladordetalleproducto();
$listardetalleproducto = $controladordetalleproducto-> listardetalleproducto($_POST["idProducto"]);


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
<title>Gestionar Detalle Producto</title>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        
</head>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Detalle Producto</p>
        </div>    
            <table class="table" id="listarcompras">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        
                        <th align="center" >Nombre Insumo</th>
                        <th align="center">Cantidad</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listardetalleproducto as $C){ ?> 
                        <tr>
                        
                        <td align="center"><strong><?php echo $C->getNombreInsumo()  ?></strong></td>
                        <td align="center"><strong><?php echo $C->getCantidad()  ?></strong></td>
                        
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