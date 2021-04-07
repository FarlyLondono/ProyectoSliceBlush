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
require_once("../Controlador/ControladorInsumos.php");
$controlador = new controlador();
$ControladorInsumo = new ControladorInsumo();
$listarProductos = $controlador->listarProductos();
$listarestado = $controlador->listarestados();
$listarinsumos = $ControladorInsumo->listarinsumos();

//$post = $_POST['imagen'];
//if(isset($_POST["frmimgn"])){
  //if(isset($_FILES["imagenn"])){


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Producto</title>
  <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../Css/estiloimagen.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
  <div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">
      <p class="h1" align="center">Agregar Producto</p>
    </div>
    <div class="container mt-5 mb-5">
      <div class="card-bordy">
     
      </br>
          <div class="photo">
              <!--<label for="foto" align="center">Imagen:</label>-->
                    <div class="prevPhoto" id="prevPhoto">
                    
                    <span class="delPhoto notBlock">X</span>
                    <label for="foto" align="center">Imagen:</label>
                    </div>
                    
                    <form name="frmImg" id="frmImg" method="POST" action="registrarProducto.php" enctype="multipart/form-data">
                    <div class="upimg" id="upimg">
                    <input type="hidden" name="registrarProductos" id="registrarProductos">
                    <input type="hidden" name="frmimgn" id="frmimgn">
                    <input type="file" name="imagenn" id="foto" onchange="prueba(this.value)">                               
                    <!--<input type="file" name="imagen" id="foto">-->

                    </div>
                    <button type="submit" name="registrarProductos" class="btn btn-primary">Enviar Imagen</button>
                    </form>
                    
                    <div id="form_alert"></div>
            </div>
          </br>
       
        <form name="frmproducto" id="frmproducto" method="POST" action="../Controlador/controlador.php" enctype="multipart/form-data">
          <input type="hidden" name="registrarProducto" id="registrarProducto">
          <input type="hidden" name="imagen" id="imagen" value="<?php $imagenn['name'] ?>"  > 
          </br>
          <label for="">Numero Producto</label> 
          <input type="text" name="idProducto" id="idProducto"  class="form-control" readonly>
          <label for="">Nombre Producto:</label>
          <input type="text" name="NombreProducto"  id="NombreProducto" value="<?php echo $_POST['NombreProducto'] ?>" class="form-control">
          <label for="">Descripcion Producto:</label>
          <input type="text" name="DescripcionProducto"  id="DescripcionProducto" value="<?php echo $_POST['DescripcionProducto'] ?>" class="form-control">
          <label for="">Precio Producto:</label>
          <input type="text" name="PrecioProducto"  id="PrecioProducto" value="<?php echo $_POST['PrecioProducto'] ?>" class="form-control">
          <label for="">Estado:</label>
          <select name="idEstado" id="idEstado" class="form-control">
            <option value="">Seleccione</option>
            <?php
            foreach ($listarestado as $estado) {
            ?>
              <option value="<?php echo $estado->getIdEstado() ?>">
                <?php echo $estado->getNombreEstado() ?>
              </option>
            <?php
            }
            ?>
          </select>
         
          <label for="">Insumo:</label> 
                <select  type="text"  name="insumo" id="insumo" class="form-control" onchange="mostrarUmedida(this.value);">
                    <option value="" >seleccione insumo</option>
                    <?php
                foreach($listarinsumos as $insumo){
                    ?>
                    <option value="<?php echo $insumo->getidinsumo() ?>" >
                    <?php echo $insumo->getnombreProducto();  ?></option>
                    <?php
                }
                ?>                 
                </select>
            </br>
            <label for="">Unidad de medida:</label>
            <input type="text" name="unidadMedida" id="unidadMedida"  class="form-control" readonly >
            </br>
            <label for="">Cantidad Insumo:</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" min=1 value=1 >
            </br>    
          
          <button type="submit" name="registrarProducto" class="btn btn-primary">Registrar</button>
          <a href="../menu.php" class="btn btn-success">REGRESAR</a>
          
         

        </form>

      </div>
    </div>
  </div>
  <div class="card-body" id="listadoDetalleProducto">



</div>
</body>
<script src="../js/estiloimagen.js"></script>
<script src="../js/validarproducto.js"></script>
<script>
function mostrarUmedida(idinsumo){
    let idinsumoaux = 0;
    <?php
        foreach($listarinsumos as $I){ ?>
            idinsumoaux = <?php echo $I->getidinsumo(); ?>;//asignar a una variable jscript una variable php

            if(idinsumo == idinsumoaux){
                $("#unidadMedida").val("<?php echo $I->getunidadmedida(); ?>")
            } 
        <?php
        }
    ?>      
}


function prueba(){

var dataString = $('#frmImg').serialize();
        $.post("registrarProducto.php",dataString, function(response) { 
          //alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            title: 'Imagen cargada con Exitoso!!!',
            icon: 'success',
            input: 'Dar clic en Enviar imagen',
            showConfirButton: false,
            timer: 2000
            }).then(function() {
            //window.location.href = "../index.php";
            })});
        }) 
}


</script>
<?php

if(isset($_POST["registrarProductos"])){
  
  $imagenn= $_FILES['imagenn'];
  $nombreimagen=$imagenn['name'];
  $type=$imagenn['type'];
  $urltemp=$imagenn['tmp_name'];

  if($nombreimagen !=''){
  $destino='../img2/';
  $imgnombre= 'img_'.md5(date('d-m-Y H:m:s'));
  $imagenproducto= $imgnombre.'.jpg';
  $src=$destino.$imagenproducto;
  }
  if($nombreimagen != ''){
    move_uploaded_file($urltemp,$src);
  }
  
        echo "<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
        <script type='text/javascript'>
        
        $('#upimg').css('display', 'none');
        $('#prevPhoto').css('display', 'none');
        $('#imagen').val('$imagenproducto');
        
        </script>"
        ;
}       
  ?>

</html>