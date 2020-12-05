<?php
session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}

require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarProductos = $controlador-> listarProductos();


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}


?>

<script>
function boton(idProducto) {
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
    $.ajax({url:"../CRUDC/Controlador/controlador.php?eliminarProducto&idProducto="+idProducto,
        success:()=>{
            window.location.href="../CRUDC/menu.php"
        }})
  }
})
    }
        </script>



<link rel="stylesheet" href="Css/estyleTables.css">
<title>Gestionar Productos</title>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Productos</p>
        </div>    
        <div id="formContent">
            <table class="table" id="listadoproductos">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>Nombre Producto</th>
                        <th>Descripcion Producto</th>
                        <th>Precio Producto</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listarProductos as $C){ ?> 
                        <tr>
                        <td><strong><?php echo $C->getNombreProducto()  ?></strong></td>
                        <td><?php echo $C->getDescripcionProducto()  ?></td>
                        <td><strong style="color:green;"><?php echo $C->getPrecioProducto()  ?></strong></td>
                        <td><strong><?php echo $C->getNombreEstado()  ?></strong></td>  
                        <td>
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?>
                        <a href="Vista/editarProducto.php?editarProducto&idProducto=<?php echo  $C->getidProducto(); ?>" class="btn btn-outline-warning">Editar</a>
                        <a onclick="boton(<?php echo $C->getidProducto(); ?>)" type="button" class="btn btn-outline-danger">Eliminar</a>
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
                <a href="Vista/registrarProducto.php" class="btn btn-primary">AGREGAR</a>
                        <?php
                        }
                        ?>  
            </div> 

                    </div>

       



    </div>
    <section>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="Img/hotdog.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Perro Grande</h5>
                                        <p class="card-text">Pan perro grande,salchicha,Ensalada,Queso,Ripio de papa,Tocineta,Salsas(opcional)
                                        </p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$11.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/rsz_matthew-reyes-5i5aqyjrdso-unsplash_1.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Salchipapas Pequeñas!</h5>
                                        <p class="card-text">Papas,Salchichas,Salsas(opcional)</p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$9.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/hamburguesa.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Hamburguesa</h5>
                                        <p class="card-text">Pan hamburguesa,carne hamburguesa,Queso,Tocineta,Ensalada,Ripio de papa,Huevo de codornis,Salsas(opcional)
                                        </p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$15.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/carne.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Carne de Res!</h5>
                                        <p class="card-text">Porcion carne de res 250g,Papas ala francesa,Ensalada,Arepa Con queso,Salsas(opcional)</p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$15.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
</body>
<script>
    $(document).ready(function() {
    $('#listadoproductos').DataTable();
} );
</script>    
</html>