<?php
session_start();
$sesion = $_SESSION["IdRol"];

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
elseif($sesion == 0){
    header("Location:../index.php");
}
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarCliente = $controlador->listarClientes();




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="container mt-4">
    <div class="card text-white bg-secondary mb-3">    
    <p class="h1" align="center">Agregar Cliente</p>
    </div>
    <div class="card-bordy">
<form action="registrarCliente.php" method="POST">

        <label for="">Nombre:</label>  
        <input type="text" name="Nombre" id="Nombre" value="<?php echo $_POST['Nombre'] ?>" class="form-control" >
        <label for="">Correo:</label> 
        <input type="text" name="Correo" id="Correo" value="<?php echo $_POST['Correo'] ?>" class="form-control">
        <label for="">Dirección:</label>
        <input type="text" name="Direccion" id="Direccion" value="<?php echo $_POST['Direccion'] ?>" class="form-control">
        <label for="">Teléfono:</label>
        <input type="text" name="Telefono" id="Telefono" value="<?php echo $_POST['Telefono'] ?>" class="form-control">
        <label for="">Contraseña:</label>
        <input type="password" name="Contrasena" value="<?php echo $_POST['Contrasena'] ?>" id="Contrasena" class="form-control">


</br>
        
        <button type="submit" name="registrarCliente" class="btn btn-success">Registrar</button>
        <a href="../menu.php" class="btn btn-primary">Regresar</a>   
 

<?php

function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}


if((isset($_POST['Nombre'])) && (isset($_POST['Correo'])) && (isset($_POST['Direccion'])) && (isset($_POST['Telefono'])) && (isset($_POST['Contrasena']))){
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Direccion = $_POST['Direccion'];
    $Telefono = $_POST['Telefono'];
    $Contrasena = $_POST['Contrasena'];


    $campos = array();
    
    if(strlen($Contrasena) < 8){
        array_push($campos, "El campo contraseña no debe tener menos de 8 caracteres");
    }
    if(strpos($Correo, "@")==false){
        array_push($campos, "ingrese un correo electronico valido");
    }
    if(!preg_match('/^[0-9]*$/',$Telefono)){
        array_push($campos, "El campo Telefono solo permite numeros");
    }
    if(strpos($Direccion, "#")==false){
        array_push($campos, "ingrese una Direccion valida");
    }
    if(($Nombre == "" ) || ($Correo == "" ) || ($Direccion == "" ) || ($Telefono == "" ) || ($Contrasena == "" )){
        array_push($campos, "Los campos no pueden quedar vacios");
    }
    if(count($campos) > 0){
      echo "<div>";
      for($i = 0; $i < count($campos); $i++){
        ?>
          <script>
        swal("<?php echo $campos[$i] ?>");
          </script>
        <?php
      }
    }else{
        if(isset($_GET['registrarCliente'])){
            desplegarVista("Vista/registrarCliente.php");
        }elseif(isset($_POST["registrarCliente"])){
            $controlador->registrarCliente();
            ?>
            <script>
        swal("Buen Trabajo!", "Ya estas registrado!","success",{
            button: "OK"
          }).then(function(){
        window.location.href="../menu.php"
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
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>