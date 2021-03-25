
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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Editar Compra</p>
    </div>

    <div class="container mt-5 mb-5">
    <div class="card-bordy">

    <form name="frminsumo" id="frminsumo" method="POST" action="editarCompra.php"> 
    <input type="hidden" name="editarcompra" />  
    <input type="hidden" name="idcompra" id="idcompra" class="form-control" value="<?php echo $buscarcompra->getidcompra() ?>" readonly>
    <label for="">Nombre Usuario:</label>  
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
    <label for="">Número de Factura:</label>  
    <input type="text" name="numerofactura" id="numerofactura" class="form-control" value="<?php echo $buscarcompra->getnumerofactura() ?>">
    <label for="">Fecha Compra:</label>  
    <input type="text" name="fechacompra" id="fechacompra" class="form-control" value="<?php echo $buscarcompra->getfechacompra() ?>" readonly>
    </br>

    <button type="submit" name="editarcompra" id="editarcompra" class="btn btn-success">Editar</button>
    <a href="../menu.php" class="btn btn-primary">Regresar</a>
        </form>

    </div>
</div>
</div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#editarcompra").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatoseditarcompra()){    
        var dataString = $('#frminsumo').serialize();
        $.post("editarCompra.php",dataString, function(response) { 
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
});
</script>
</html>