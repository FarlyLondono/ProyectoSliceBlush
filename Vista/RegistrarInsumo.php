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
/*$listarProductos = $controlador->listarProductos();
$listarestado = $controlador->listarestados();*/

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Insumo</title>
  <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
  <div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">
      <p class="h1" align="center">Agregar Insumo</p>
    </div>
    <div class="container mt-5 mb-5">
      <div class="card-bordy">

        <form name="frminsumo" id="frminsumo">
          <input type="hidden" name="RegistrarInsumo" />
          <label id="nombreRequerido" for="">Nombre Producto:</label>
          <input type="text" name="nombreProducto" value="<?php echo $_POST['nombreProducto'] ?>" id="nombreProducto" class="form-control">
          <label id="unidadRequerido" for="">Unidad De Medida:</label>
          <select name="unidadmedida" id="unidadmedida" value="<?php echo $_POST['unidadmedida'] ?>" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="Kg">Kg</option>
                    <option value="Unidades">Unidades</option>
          </select>
         
          <label id="precioRequerido" for="">Precio Producto:</label>
          <input type="text" name="precio" value="<?php echo $_POST['precio'] ?>" id="precio" class="form-control">
          <label id="StockRequerido" for="">Stock:</label>
          <input type="text" name="Stock" value="<?php echo $_POST['Stock'] ?>" id="Stock" class="form-control">
          <br>
          <button type="submit" name="RegistrarInsumo" id="RegistrarInsumo" class="btn btn-success">Registrar</button>
          <a href="../menu.php" class="btn btn-primary">Regresar</a>




          

        </form>

      </div>
    </div>
  </div>
</body>
<script src="../js/validaciones.js"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#RegistrarInsumo").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        if(validarDatosInsumo()){    
        var dataString = $('#frminsumo').serialize();
        $.post("../Controlador/ControladorInsumos.php",dataString, function(response) { 
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