<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/ControladorInsumos.php");
$ControladorInsumo = new ControladorInsumo();
/*$ListarPedidos = $ControladorPedido->ListarPedidos();*/
$buscarinsumo= $ControladorInsumo->buscarinsumo($_GET["idinsumo"]);

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["editarinsumo"])){
    $ControladorInsumo->editarinsumo();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Insumo</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Insumo</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frminsumo" method="POST" action="editarInsumo.php"> 
     
    <input type="hidden" name="idinsumo" id="idinsumo" class="form-control" value="<?php echo $buscarinsumo->getidinsumo() ?>" readonly>
    <label for="">Nombre Producto:</label>  
    <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" value="<?php echo $buscarinsumo->getnombreProducto() ?>">
    <label for="">Unidada Medida:</label>  
    <input type="text" name="unidadmedida" id="unidadmedida" class="form-control" value="<?php echo $buscarinsumo->getunidadmedida() ?>">
    <label for="">Precio Producto:</label>  
    <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $buscarinsumo->getprecio() ?>">
    <label for="">Stock:</label>  
    <input type="text" name="Stock" id="Stock" class="form-control" value="<?php echo $buscarinsumo->getStock() ?>">
    </br>

    <button type="submit" name="editarinsumo" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regrasar</a>
        </form>

    </div>
</div>
</div>
</body>
</html>