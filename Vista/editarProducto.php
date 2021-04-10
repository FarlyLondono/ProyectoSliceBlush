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
}elseif(isset($_POST["editarimagen"])){
    $controlador->editarProducto();
    desplegarVista("../menu.php");
}



?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/estiloimagen.css">
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

    
    <div>
            <form name="frmImg" id="frmImg" method="POST" action="editarProducto.php" enctype="multipart/form-data">
                    </br>
                        <div class="photo">
                        <label for="foto" >Imagen:</label>
                        <div class="prevPhoto">
                        <span class="delPhoto notBlock">X</span>
                        <label for="foto" ></label>
                        </div>
                        <div class="upimg">
                        <input type="text" name="idProducto" id="idProducto" class="form-control" value="<?php echo $buscarProducto->getidProducto() ?>"readonly>   
                        <input type="text" name="NombreProducto" id="NombreProducto" class="form-control" value="<?php echo $buscarProducto->getNombreProducto() ?>">
                        <input type="text" name="DescripcionProducto" id="DescripcionProducto" class="form-control" value="<?php echo $buscarProducto->getDescripcionProducto() ?>">
                        <input  type="text" name="PrecioProducto" id="PrecioProducto" class="form-control" value="<?php echo $buscarProducto->getPrecioProducto() ?>" >
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
                        <input type="file" name="imagen" id="foto" >
                        </div>
                        <div id="form_alert"></div>
                        </div>
                        </br>
                    <button type="submit" name="editarimagen" class="btn btn-success">Editar Imagen</button>
            </form>
    </div>

    </br>   

    <form name="frmproducto" id="frmproducto" enctype="multipart/form-data"> 
    <input type="hidden" name="editarProducto" id="editarProducto"/>
    <input type="hidden" class="form-control" name="imagen" id="imagen" value="<?php $imagenn['name'] ?>"  >  
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
<script src="../js/estiloimagen.js"></script>
<script src="../js/validacioneditarproducto.js"></script>
<script >



/*$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarProducto").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarproducto()){    
        var datdataStringa = $('#frmproducto').serialize();
        $.post("editarProducto.php",dataString, function(response) { 
          //alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Actualización Exitosa!!!',
            showConfirButton: true,
            //timer: 2000
            }).then(function() {
            window.location.href = "../menu.php"; 
            })});
        }) 
        }
    });    
});*/



</script>

<script>
$(document).ready( function() {
$("#PrecioProducto").on("keyup", function(){//Garantizar que solo se acepten numeros
    
    $("#PrecioProducto").val($("#PrecioProducto").val().replace(/\D/g,""));

});

});
</script>

</html>