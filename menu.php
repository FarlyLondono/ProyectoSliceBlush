<?php 
session_start();
if(!isset($_SESSION["Correo"]))
{
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" ></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .carousel-inner img {
            width: 100%;
            height: 550px;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
</head>

<body background="Img/rsz_jaco-pretorius-agzehyx-jfo-unsplash_1.jpg">

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <img src="Img/cubiertos.png" width="50" height="50"
            alt="">
        <a style="color: white;" class="navbar-brand" href="menu.php">Asados La Portada</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <?php
                    $sesion = $_SESSION["IdRol"];
                    if($sesion == 1)
                    {
                ?>
                        <li class="nav-item active">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarUsuarios.php')">Usuarios<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarClientes.php')">Clientes<span
                                    class="sr-only">(current)</span></a>
                        </li>
                    
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')"
                                >Productos</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')"
                                >Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarCompras.php')"
                                >Compras</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarInsumos.php')"
                                >Insumos</a>
                        </li>
                        <?php
                    }
                  elseif($sesion == 0)
                  {
                        ?>
                            <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')"
                                >Productos</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;"  class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')"
                            >Pedidos</a>
                            </li>
                      <?php
                    } elseif($sesion == 2)
                        {
                      ?>
                            <li class="nav-item active">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarClientes.php')">Clientes<span
                                    class="sr-only">(current)</span></a>
                            </li>
                    
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')"
                                    >Productos</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')"
                                    >Pedidos</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarCompras.php')"
                                    >Compras</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarInsumos.php')"
                                    >Insumos</a>
                            </li>
                            <?php
                        } elseif($sesion == 3)
                    {
                            ?>
                            <li class="nav-item">
                            <a style="color: white;" class="nav-link pointer" onclick="nativation('#navigation','Vista/listarProductos.php')"
                                >Productos</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: white;"  class="nav-link pointer" onclick="nativation('#navigation','Vista/ListarPedidos.php')"
                            >Pedidos</a>
                            </li>
                            <?php
                    }
                    ?>
                
            </ul>
            <img src="Img/outline_shopping_cart_white_36dp.png" class=" my-3 my-sm-0 mr-sm-3" width="35" height="35">
            <form class="form-inline my-2 my-lg-0">
                <h6 style="color: white;" class=" my-3 my-sm-0 mr-sm-3" color="">Bienvenido(a)  <?php echo $_SESSION["Nombre"]; ?> </h6> 
            </form>
            </br>
            <form class="form-inline my-2 my-lg-0">
                <a href="Vista/cerrarSesion.php" class="btn btn-outline-light my-3 my-sm-0 mr-sm-3" aria-pressed="true"
                    type="submit">Cerrar sesión</a>
            </form>
        </div>
    </nav>
    <div id="navigation">
    <title>Menu</title>
    <section>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <img src="Img/hotdog.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Perro Grande</h5>
                                        <p class="card-text">Pan perro grande,salchicha,Ensalada,Queso,Ripio de papa,Tocineta,Salsas(opcional)
                                        </p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$11.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/rsz_matthew-reyes-5i5aqyjrdso-unsplash_1.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Salchipapas Pequeñas!</h5>
                                        <p class="card-text">Papas,Salchichas,Salsas(opcional)</p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$9.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/hamburguesa.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Hamburguesa</h5>
                                        <p class="card-text">Pan hamburguesa,carne hamburguesa,Queso,Tocineta,Ensalada,Ripio de papa,Huevo de codornis,Salsas(opcional)
                                        </p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$15.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="Img/carne.jpg" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Carne de Res!</h5>
                                        <p class="card-text">Porcion carne de res 250g,Papas ala francesa,Ensalada,Arepa Con queso,Salsas(opcional)</p>
                                        <p class="card-text"><small class="text-muted"><FONT SIZE=5><strong>$15.000</strong></font></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <div class="container mt-5 mb-5">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Img/rsz_paula-vermeulen-urjzkhqsubk-unsplash.jpg" class="d-block w-100" alt="...">
                        <div style="color:black;" class="carousel-caption d-none d-md-block">
                            <h4><strong style="color: white;">Disfruta de nuestro agradable ambiente!</strong></h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Img/rsz_dan-gold-e6hjqab7uea-unsplash.jpg" class="d-block w-100" alt="...">
                        <div style="color:black;" class="carousel-caption d-none d-md-block">
                            <h4><strong style="color:white;">Disfruta en familia!</strong></h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Img/rsz_robin-stickel-tzl1ucxg5es-unsplash.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h4><strong>Disfruta de la mejor comida rapida!</strong></h4>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="container body-content">
        <hr />
        <footer>
        <p style="color:white;">TELEFONO: 321 885 3889 - Correo: Asadoslaportada@gmail.com</p>
        </footer>
    </div>
</body>
<script type="text/javascript" charset="utf8" src="js/dataTables.js"></script>
<script src="js/navbar.js"></script>
</html>