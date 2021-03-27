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
$listarestado = $controlador->listarestados();

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
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="../Css/estiloimagen.css">
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
  <div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">
      <p class="h1" align="center">Agregar Producto</p>
    </div>
    <div class="container mt-5 mb-5">
      <div class="card-bordy">

        <form name="frmusuario" method="POST" action="registrarProducto.php" enctype="multipart/form-data">
          <label for="">Nombre Producto:</label>
          <input type="text" name="NombreProducto" value="<?php echo $_POST['NombreProducto'] ?>" id="NombreProducto" class="form-control">
          <label for="">Descripción:</label>
          <input type="text" name="DescripcionProducto" value="<?php echo $_POST['DescripcionProducto'] ?>" id="DescripcionProducto" class="form-control">
          <label for="">Precio:</label>
          <input type="text" name="PrecioProducto" value="<?php echo $_POST['PrecioProducto'] ?>" id="PrecioProducto" class="form-control">
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
          </br>
          <div class="photo">
              <label for="foto" align="center"></label>
                    <div class="prevPhoto">
                    <span class="delPhoto notBlock">X</span>
                    <label for="foto" align="center" >Imagen:</label>
                    </div>
                    <div class="upimg">
                    <input type="file" name="imagen" id="foto">
                    </div>
                    <div id="form_alert"></div>
            </div>
          </br>


          <button type="submit" name="registrarProducto" class="btn btn-success">Registrar</button>
          <a href="../menu.php" class="btn btn-primary">Regresar</a>




          <?php

          function desplegarVista($ruta)
          {
            header('Location: ' . $ruta);
          }
          function desplegarVista2($ruta)
          {
            require_once($ruta);
          }


          if ((isset($_POST['NombreProducto'])) && (isset($_POST['DescripcionProducto'])) && (isset($_POST['PrecioProducto'])) && (isset($_POST['idEstado']))) {
            $NombreProducto = $_POST['NombreProducto'];
            $DescripcionProducto = $_POST['DescripcionProducto'];
            $PrecioProducto = $_POST['PrecioProducto'];
            $idEstado = $_POST['idEstado'];

            $campos = array();

            if (($NombreProducto == "") || ($DescripcionProducto == "") || ($PrecioProducto == "") || ($idEstado == "")) {
              array_push($campos, "Los campos no pueden quedar vacios");
            }
            if (!preg_match('/^[0-9]*$/', $PrecioProducto)) {
              array_push($campos, "El campo PrecioProducto solo permite numeros");
            }
            if (!preg_match('/^[0-9]*$/', $idEstado)) {
              array_push($campos, "El campo idEstado solo permite numeros");
            }
            if (count($campos) > 0) {
              echo "<div>";
              for ($i = 0; $i < count($campos); $i++) {
          ?>
                <script>
                  swal("<?php echo $campos[$i] ?>");
                </script>
              <?php
              }
            } else {
              if (isset($_GET['registrarProducto'])) {
                desplegarVista("Vista/registrarProducto.php");
              } elseif (isset($_POST["registrarProducto"])) {
                $controlador->registrarProducto();
              ?>
                <script>
                  swal("Buen Trabajo!", "Ya estas registrado!", "success", {
                    button: "OK"
                  }).then(function() {
                    window.location.href = "../menu.php"
                  })
                </script>
          <?php
              }
            }
            echo "</div>";
          }

          ?>

        </form>

      </div>
    </div>
  </div>
</body>
<script src="../js/estiloimagen.js"></script>

</html>