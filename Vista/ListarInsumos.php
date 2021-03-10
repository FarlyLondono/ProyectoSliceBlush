<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion == 0){
    header("Location:../index.php");
}

require_once("../Controlador/ControladorInsumos.php");
$ControladorInsumo = new ControladorInsumo();
$listarinsumos = $ControladorInsumo-> listarinsumos();


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}


?>

<script>
function boton(idinsumo) {
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
    $.ajax({url:"..ProyectoSliceBlush/Controlador/ControladorInsumos.php?eliminarinsumo&idinsumo="+idinsumo,
        success:()=>{
            window.location.href="../ProyectoSliceBlush/menu.php"
        }})
  }
})
    }
        </script>



<link rel="stylesheet" href="Css/estyleTables.css">
<title>Gestionar Insumos</title>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Insumos</p>
        </div>    
        <div id="formContent">
            <table class="table" id="listadoinsumos">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>Id Insumo</th>
                        <th>Nombre Producto</th>
                        <th>Unidad de Medida</th>
                        <th>Precio Producto</th>
                        <th>Stock</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listarinsumos as $I){ ?> 
                        <tr>
                        <td><?php echo $I->getidinsumo()  ?></td>
                        <td><?php echo $I->getnombreProducto()  ?></td>
                        <td><?php echo $I->getunidadmedida()  ?></td>
                        <td><strong style="color:green;"><?php echo $I->getprecio()  ?></strong></td>
                        <td><?php echo $I->getStock()  ?></td>  
                        <td>
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?>
                        <a href="Vista/editarInsumo.php?editarinsumo&idinsumo=<?php echo  $I->getidinsumo(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                        <a onclick="boton(<?php echo $I->getidinsumo(); ?>)" type="button" class="btn btn-outline-danger"><img style="width: 25px; height: 25px;" src="Img/eliminar.png" alt="">Eliminar</a>
                        <?php
                        }
                        ?>  
                        </td>     
                        </tr>

                   <?php }  ?>


                </tbody>    
                

            </table>

       

            <div class="card-header text-white">
                            <?php
                            $sesion = $_SESSION["IdRol"];
                                if($sesion == 1)
                                {
                                    ?>
                <a href="Vista/RegistrarInsumo.php" class="btn btn-primary">AGREGAR</a>
                        <?php
                        }
                        ?>  
            </div> 

    </div>
   </div> 
  
</body>
<script>
    $(document).ready(function() {
    $('#listadoinsumos').DataTable();
} );
</script>    
</html>