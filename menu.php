<?php
session_start();
if (!isset($_SESSION["Correo"])) {
    header("Location:index.php");
}

date_default_timezone_set("America/Lima");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/bottton.js"></script>
    <link href="Css/button.css" rel="stylesheet" type="text/css">
    <link href="css/switch.css" rel="stylesheet" type="text/css">
    <style>
        .carousel-inner img {
            width: 100%;
            height: 550px;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
    <script>
        $(document).ready(() => {
            let currentPage = localStorage.getItem("currentPage");
            isPathInValid(currentPage) ? nativation('#navigation', 'Vista/principal.php') : nativation('#navigation', currentPage);
        });
    </script>
</head>

<body background="Img/rsz_jaco-pretorius-agzehyx-jfo-unsplash_1.jpg">

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <img src="Img/cubiertos.png" width="50" height="50" alt="">
        <a style="color: white;" class="navbar-brand pointer" onclick="nativation('#navigation','Vista/principal.php')">Asados La Portada</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <?php
                $sesion = $_SESSION["IdRol"];
                if ($sesion == 1) {
                ?>
                    <div class="content">
                        <a href="https://www.youtube.com/watch?v=6xUnSVTh8fI&ab_channel=DeccaRecords" target="_blank">
                            <button class="botonF1 pointer ">
                                <span class="material-icons">accessibility_new</span>
                            </button>
                        </a>
                    </div>
                    <li class="nav-item active">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarUsuarios.php')">Usuarios<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarClientes.php')">Clientes<span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarCompras.php')">Compras</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarInsumos.php')">Insumos</a>
                    </li>
                <?php
                } elseif ($sesion == 0) {

                ?>
                    <div class="content">
                        <a href="https://www.youtube.com/watch?v=M9UgWs1f1-4&list=PLbr5ZlakwQm0WLsGujwlsApzLraTxTFOD&ab_channel=JuanEstebanQuiroga" target="_blank">
                            <button class="botonF1 pointer ">
                                <span class="material-icons">accessibility_new</span>
                            </button>
                        </a>
                    </div>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductosimagen.php')">Menu Productos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')">Pedidos</a>
                    </li>
                <?php
                } elseif ($sesion == 2) {
                ?>
                    <li class="nav-item active">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarClientes.php')">Clientes<span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductosimagen.php')">Menu Productos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarCompras.php')">Compras</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarInsumos.php')">Insumos</a>
                    </li>
                <?php
                } elseif ($sesion == 3) {
                ?>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductosimagen.php')">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')">Pedidos</a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <a href="Vista/ListaCarritoCompras.php"><img src="Img/outline_shopping_cart_white_36dp.png" class=" my-3 my-sm-0 mr-sm-3" width="35" height="35"></a>
            <form class="form-inline my-2 my-lg-0">
                <h6 style="color: white;" class=" my-3 my-sm-0 mr-sm-3" color="">Bienvenido(a) <?php echo $_SESSION["Nombre"]; ?> </h6>
            </form>
            </br>
            <form class="form-inline my-2 my-lg-0">
                <a href="Vista/cerrarSesion.php" class="btn btn-outline-light my-3 my-sm-0 mr-sm-3" aria-pressed="true" type="submit">Cerrar sesión</a>
            </form>
    </nav>
    </div>
    <div id="navigation"></div>
    <div class="container body-content">
        <hr />
        <footer>
            <p style="color:white;">TELEFONO: 321 885 3889 - Correo: Asadoslaportada@gmail.com</p>
        </footer>
    </div>
</body>

<script type="text/javascript" charset="utf8" src="js/dataTables.js"></script>
<script src="js/navbar.js"></script>

<script>
    $(document).ready(function() {
        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        let page = getParameterByName('page');
        if (page != null && page != '' && page != undefined && page != 'undefined') {
            nativation('#navigation', page);
            console.log(page);
        }
    });
</script>

</html>