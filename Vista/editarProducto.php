<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarProductos = $controlador->listarProductos();
$buscarProducto= $controlador->buscarProducto($_GET["idProducto"]);
$listarestado = $controlador->listarestados();


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_GET["editarProducto"])){
    desplegarVista2("editarProducto.php");
}
elseif(isset($_POST["editarProducto"])){
    $controlador->editarProducto();
    desplegarVista("../menu.php");
}



?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Producto</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form method="POST" action="editarProducto.php"> 
    <label for="">idProducto:</label>  
    <input type="text" name="idProducto" id="idProducto" class="form-control" value="<?php echo $buscarProducto->getidProducto() ?>"readonly>
    <label for="">NombreProducto:</label>  
    <input type="text" name="NombreProducto" id="NombreProducto" class="form-control" value="<?php echo $buscarProducto->getNombreProducto() ?>">
    <label for="">DescripcionProducto:</label>  
    <input type="text" name="DescripcionProducto" id="DescripcionProducto" class="form-control" value="<?php echo $buscarProducto->getDescripcionProducto() ?>">
    <label for="">PrecioProducto:</label>  
    <input  type="text" name="PrecioProducto" id="PrecioProducto" class="form-control" value="<?php echo $buscarProducto->getPrecioProducto() ?>" >
    <label for="">Estado:</label>
    <select type="text" name="idEstado" id="idEstado" class="form-control">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarestado as $estado){
                    ?>
                    <option value="<?php echo $estado->getIdEstado() ?>" <?php if($estado->getIdEstado() == $buscarProducto->getidEstado()){ ?> selected <?php } ?> > <?php echo $estado->getNombreEstado();  ?></option>
                    <?php
                }
                ?>                 
                </select>
</br>

    <button type="submit" name="editarProducto" class="btn btn-primary">Editar</button>
    <a href="../menu.php" class="btn btn-success">REGRESAR</a>     
        
        </form>

    </div>
</div>
</div>
</body>
</html>