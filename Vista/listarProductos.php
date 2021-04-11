<?php
session_start();
if (!isset($_SESSION["Correo"])) {
    //header("Location:../index.php");
}




require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarProductos = $controlador->listarProductos();


function desplegarVista($ruta)
{
    header('Location: ' . $ruta);
}
function desplegarVista2($ruta)
{
    require_once($ruta);
}


?>




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
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($listarProductos as $C) { ?>
                        <tr>
                            <td><strong><?php echo $C->getNombreProducto()  ?></strong></td>
                            <td><?php echo $C->getDescripcionProducto()  ?></td>
                            <td><strong style="color:green;"><?php echo $C->getPrecioProducto()  ?></strong></td>
                            <td><strong><?php echo $C->getNombreEstado()  ?></strong></td>
                            <td>
                                <?php
                                $sesion = $_SESSION["IdRol"];
                                if ($sesion == 1) {
                                ?>
                                    <a href="Vista/editarProducto.php?editarProducto&idProducto=<?php echo  $C->getidProducto(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                                    <a href="Controlador/ControladorProducto.php?verdetalleproducto&idProducto=<?php echo  $C->getidProducto(); ?>" class="btn btn-outline-primary">Ver Detalle</a>
                                    <label class="switch">
                                        <input type="checkbox" <?php echo $C->getidEstado() == 1 ? "checked" : "" ?> onclick="active(<?php echo ($C->getidEstado()) ?>,<?php echo ($C->getidProducto()) ?>);">
                                        <span class="slider round"></span>
                                    </label>
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
                if ($sesion == 1) {
                ?>
                    <a href="Vista/registrarProducto.php" class="btn btn-primary">AGREGAR</a>
                <?php
                }
                ?>
            </div>

        </div>





    </div>


</body>
<script>
    function active(isActive, idProducto) {
        console.log(isActive, idProducto);
        $.ajax({
            type: "POST",
            url: "./Controlador/controlador.php",
            data: {
                idProducto: idProducto,
                idEstado: isActive == 1 ? 2 : 1,
                actionp: "active"
            },
            success: (data) => {
                nativation('#navigation', 'Vista/listarProductos.php')
            }
        })

    }
</script>
<script>
    $(document).ready(function() {
        $('#listadoproductos').DataTable();
    });
</script>

</html>