<?php
/*session_start();
if(!isset($_SESSION["Correo"]))
{
    header("Location:../index.php");
}*/
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarRoles = $controlador->listarRoles();
$listarestados = $controlador->listarestados();
$crudcliente = new CRUDcliente();



?>
<title>Registro</title>
<link rel="icon" type="image/png" href="../Img/hamburguer.png" />
<link rel="stylesheet" href="../Css/styleregistro.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="container mt-5 mb-5">
        <div class="body"></div>
        <div class="grad"></div>
      
        <br>
        <div class="login">
            <form action="RegistrarCliente1.php" method="POST">
            <div id="formContent">
                <input type="text" placeholder="Nombre" id="Nombre" name="Nombre"><br>
                </br>
                <input type="text" placeholder="Correo" id="Correo" name="Correo"><br>
                </br>
                <input type="text" placeholder="Dirección" id="Direccion" name="Direccion"><br>
                </br>
                <input type="text" placeholder="Teléfono" id="Telefono" name="Telefono">
                </br>
                <input type="password" placeholder="Contraseña" id="Contrasena" name="Contrasena">
                </br>
                <button type="submit" name="registrarCliente" class="btn btn-dark">Registrar</button>
                </br>
                <a type="submit" name="" href="../index.php" class="btn btn-dark">Volver</a>
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
                    
                    if(strlen($Contrasena) < 6){
                        array_push($campos, "El campo contraseña no debe tener menos de 6 caracteres");
                    }
                    if(strpos($Correo, "@")==false){
                        array_push($campos, "ingrese un correo electronico valido");
                    }
                    if(!preg_match('/^[0-9]*$/',$Telefono)){
                        array_push($campos, "El campo Telefono solo permite numeros");
                    }
                    
                    if(($Nombre == "" ) || ($Correo == "" ) || ($Direccion == "" ) || ($Telefono == "" ) || ($Contrasena == "" )){
                        array_push($campos, "Los campos no pueden quedar vacio");
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
                            $Correo = $_POST['Correo'];
                            $NombreCorreo = $crudcliente->buscarCorreoCliente($Correo);
                            if ($NombreCorreo == 0){
                            $controlador->registrarCliente();
                            ?>
                            <script>
                        swal("Buen Trabajo!", "Ya estas registrado!","success",{
                            button: "OK"
                        }).then(function(){
                        window.location.href="../index.php"
                        })
                            </script>
                            <?php
                            }else{
                                ?>
                            <script>
                            swal("error!", "Este usuario ya existe!","error",{
                            button: "OK"
                        }).then(function(){
                        window.location.href="../index.php"
                        })
                            </script>
                            <?php
                            }
                        }
                    }
                    echo "</div>";
                }

                ?>
                
                </form>
            </div>
        </div>
    </div>