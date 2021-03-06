<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
$sesion = $_SESSION["IdRol"];

if (!isset($_SESSION["Correo"])) {
    header("Location:../index.php");
} elseif ($sesion <> 1) {
    header("Location:../index.php");
}
require_once("../Controlador/controlador.php");
require_once("../Controlador/controladorLogin.php");
$buscarusuario= $controlador->buscarusuario($_GET["IdUsuarios"]);
$controlador = new controlador();
$listarUsuarios = $controlador->listarUsuarios();
$listarestado = $controlador->listarestados();
$listarRoles = $controlador->listarRoles();



function desplegarVista($ruta)
{
    header('Location: ' . $ruta);
}
function desplegarVista2($ruta)
{
    require_once($ruta);
}

?>


<script>
    function boton(Estado) {
        Swal.fire({
            title: 'Estás seguro que desea desactivar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'sí, Desactivar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../ProyectoSliceBlush/Controlador/controlador.php?editarEstado&Estado=" + Estado,
                    success: () => {
                        window.location.href = "../ProyectoSliceBlush/menu.php"
                    }
                })
            }
        })
    }
</script>


<link rel="stylesheet" href="Css/estyleTables.css">
<title>Gestionar Usuarios</title>

<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
            <p class="h1" align="center">Lista Usuarios</p>
        </div>
        <div id="formContent">
            <table class="table" id="listadousuarios">
                <thead class="thead-dark">
                    <hr>
                    <tr>
                        <th>NúmeroDocumento</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listarUsuarios as $C) { ?>
                        <tr>
                            <td><?php echo $C->getNumeroDocumento()  ?></td>
                            <td><?php echo $C->getNombre()  ?></td>
                            <td><?php echo $C->getApellidos()  ?></td>
                            <td><?php echo $C->getCorreo()  ?></td>
                            <td><?php echo $C->getNombreRol()  ?></td>
                            <td><?php echo $C->getNombreEstado()  ?></td>
                            <td>
                                <a href="Vista/editarUsuario.php?editarUsuario&IdUsuarios=<?php echo  $C->getIdUsuarios(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                                <label class="switch">
                                    <input type="checkbox" <?php echo $C->getidEstado()==1 ? "checked" : "" ?> onclick="active(<?php echo ($C->getidEstado()) ?>,<?php echo ($C->getIdUsuarios()) ?>);" >
                                    <span class="slider round"></span> 
                                </label>
                            </td>
                        </tr>

                    <?php }  ?>


                </tbody>

            </table>
            <div class="card-header text-white">
                <a href="Vista/RegistrarUsuario.php" class="btn btn-primary">AGREGAR</a>
            </div>
        </div>
    </div>
</body>
<?php
function estados($Existe)
{

    $Cliente = new Clientes();
    $Cliente->setExiste($Existe);

    if ($Cliente->getExiste() == 1) {
        $Cliente->getExiste() == 0;
    } elseif ($Cliente->getExiste() == 0) {
        $Cliente->getExiste() == 1;
    }
}
?>
<script>
function active(isActive,idUsuario){
    console.log(isActive,idUsuario);
    $.ajax({
            type: "POST",
            url: "./Controlador/controlador.php",
            data: {
                IdUsuarios : idUsuario,
                idEstado: isActive==1 ? 2 : 1,
                action: "active"
            },
            success : (data)=>{
                nativation('#navigation','Vista/ListarUsuarios.php')
            }
        })

}
</script>
<script>
    $(document).ready(function() {
        $('#listadousuarios').DataTable();
    });
</script>

</html>