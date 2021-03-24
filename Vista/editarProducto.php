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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Producto</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frmproducto" id="frmproducto" method="POST" action="editarProducto.php"> 
      
    <input type="hidden" name="idProducto" id="idProducto" class="form-control" value="<?php echo $buscarProducto->getidProducto() ?>"readonly>
    <label for="">Nombre Producto:</label>  
    <input type="text" name="NombreProducto" id="NombreProducto" class="form-control" value="<?php echo $buscarProducto->getNombreProducto() ?>">
    <label for="">Descripción:</label>  
    <input type="text" name="DescripcionProducto" id="DescripcionProducto" class="form-control" value="<?php echo $buscarProducto->getDescripcionProducto() ?>">
    <label for="">Precio:</label>  
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

    <button type="submit" name="editarProducto" id="editarProducto" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>     
        
        </form>

    </div>
</div>
</div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarProducto").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarproducto()){    
        var dataString = $('#frmproducto').serialize();
        $.post("editarProducto.php",dataString, function(response) { 
          //alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Registro Exitoso!!!',
            showConfirButton: true,
            //timer: 2000
            }).then(function() {
            window.location.href = "../menu.php"; 
            })});
        }) 
        }
    });    
});
</script>
</html>