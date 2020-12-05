
<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion <> 1){
    header("Location:../index.php");
}
require_once("../Controlador/ControladorCompra.php");
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarUsuarios = $controlador->listarUsuarios();
$ControladorCompra = new ControladorCompra();
/*$ListarPedidos = $ControladorPedido->ListarPedidos();*/
$buscarcompra= $ControladorCompra->buscarcompra($_GET["idcompra"]);

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["editarcompra"])){
    $ControladorCompra->editarcompra();
    desplegarVista("../menu.php");
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Compra</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Compra</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frminsumo" method="POST" action="editarCompra.php"> 
    <label for="">Id Compra:</label>  
    <input type="text" name="idcompra" id="idcompra" class="form-control" value="<?php echo $buscarcompra->getidcompra() ?>" readonly>
    <label for="">Id Usuario:</label>  
    <select type="text" name="IdUsuarios" id="IdUsuarios" class="form-control" onchange="mostrarprecio(this.value)">
                    <option value="" >seleccione</option>
                    <?php
                foreach($listarUsuarios as $usuarios){
                    ?>
                    <option value="<?php echo $usuarios->getIdUsuarios() ?>" <?php if($usuarios->getIdUsuarios() == $buscarcompra->getIdUsuarios()){ ?> selected <?php } ?> > <?php echo $usuarios->getNombre();  ?></option>
                    <?php
                }
                ?>                 
                </select> <label for="">Proveedor:</label>  
    <input type="text" name="proveedor" id="proveedor" class="form-control" value="<?php echo $buscarcompra->getproveedor() ?>">
    <label for="">Numero de Factura:</label>  
    <input type="text" name="numerofactura" id="numerofactura" class="form-control" value="<?php echo $buscarcompra->getnumerofactura() ?>">
    <label for="">Fecha Compra:</label>  
    <input type="text" name="fechacompra" id="fechacompra" class="form-control" value="<?php echo $buscarcompra->getfechacompra() ?>" readonly>
    </br>

    <button type="submit" name="editarcompra" class="btn btn-primary">Editar</button>
    <a href="../menu.php" class="btn btn-success">REGRESAR</a>
        </form>

    </div>
</div>
</div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>