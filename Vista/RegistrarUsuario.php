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
$listarUsuarios = $controlador->listarUsuarios();
$listarRoles = $controlador->listarRoles();
$listarestados = $controlador->listarestados();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
            <p class="h1" align="center">Agregar Usuario</p>
        </div>
        <div class="card-bordy">
            <form action="RegistrarUsuario.php" method="POST">

                <label for="">NumeroDocumento:</label>
                <input type="text" name="NumeroDocumento" value="<?php echo $_POST['NumeroDocumento'] ?>" id="NumeroDocumento" class="form-control">
                <label for="">Nombre:</label>
                <input type="text" name="Nombre" id="Nombre" value="<?php echo $_POST['Nombre'] ?>" class="form-control">
                <label for="">Apellidos:</label>
                <input type="text" name="Apellidos" id="Apellidos" value="<?php echo $_POST['Apellidos'] ?>" class="form-control">
                <label for="">Correo:</label>
                <input type="text" name="Correo" id="Correo" value="<?php echo $_POST['Correo'] ?>" class="form-control">
                <label for="">Contraseña:</label>
                <input type="password" name="Contrasena" id="Contrasena" value="<?php echo $_POST['Contrasena'] ?>" class="form-control">
                <label for="">Estado:</label>
                <select name="IdEstado" id="IdEstado" onchange="mostrarnombre(this.value)" class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                    foreach ($listarestados as $estado) {
                    ?>
                        <option value="<?php echo $estado->getIdEstado() ?>">
                            <?php echo $estado->getNombreEstado() ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <label for="">Rol:</label>
                <select name="IdRol" id="IdRol" onchange="mostrarRol(this.value)" class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                    foreach ($listarRoles as $Rol) {
                    ?>
                        <option value="<?php echo $Rol->getIdRol() ?>"><?php echo $Rol->getNombreRol(); ?></option>
                    <?php
                    }

                    ?>
                </select>



                </br>

                <button type="submit" name="RegistrarUsuario" class="btn btn-success">Registrar</button>
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


                if ((isset($_POST['NumeroDocumento'])) && (isset($_POST['Nombre'])) && (isset($_POST['Apellidos'])) && (isset($_POST['Correo'])) && (isset($_POST['Contrasena'])) && (isset($_POST['IdEstado'])) && (isset($_POST['IdRol']))) {
                    $NumeroDocumento = $_POST['NumeroDocumento'];
                    $Nombre = $_POST['Nombre'];
                    $Apellidos = $_POST['Apellidos'];
                    $Correo = $_POST['Correo'];
                    $Contrasena = $_POST['Contrasena'];
                    $IdEstado = $_POST['IdEstado'];
                    $IdRol = $_POST['IdRol'];

                    $campos = array();

                    if (strlen($Contrasena) < 6) {
                        array_push($campos, "El campo contraseña no debe tener menos de 6 caracteres");
                    }
                    if (strlen($NumeroDocumento) > 10) {
                        array_push($campos, "El campo NumeroDocumento no debe tener mas de 10 caracteres");
                    }
                    if (strlen($NumeroDocumento) < 6) {
                        array_push($campos, "El campo NumeroDocumento no debe tener menos de 6 caracteres");
                    }
                    if (strpos($Correo, "@") == false) {
                        array_push($campos, "ingrese un correo electronico valido");
                    }
                    if (($NumeroDocumento == "") || ($Nombre == "") || ($Apellidos == "") || ($Correo == "") || ($Contrasena == "") || ($IdEstado == "") || ($IdRol == "")) {
                        array_push($campos, "Los campos no pueden quedar vacio");
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
                        if (isset($_GET['RegistrarUsuario'])) {
                            desplegarVista("Vista/RegistrarUsuario.php");
                        } elseif (isset($_POST["RegistrarUsuario"])) {
                            $controlador->RegistrarUsuario();
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
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    function mostrarnombre(IdEstado) {
        let IdEstadoaux = 0;
        <?php
        foreach ($listarestados as $I) { ?>
            IdEstadoaux = <?php echo $I->getIdEstado(); ?>; //asignar a una variable jscript una variable php

            if (IdEstado == IdEstadoaux) {
                $("#NombreEstado").val(<?php echo $I->getNombreEstado(); ?>)
            }
        <?php
        }
        ?>
    }

    function mostrarRol(IdRol) {
        let IdRolaux = 0;
        <?php
        foreach ($listarRoles as $R) { ?>
            IdRolaux = <?php echo $R->getIdRol(); ?>; //asignar a una variable jscript una variable php

            if (IdRol == IdRolaux) {
                $("#NombreRol").val(<?php echo $R->getNombreRol(); ?>)
            }
        <?php
        }
        ?>
    }
</script>

</html>