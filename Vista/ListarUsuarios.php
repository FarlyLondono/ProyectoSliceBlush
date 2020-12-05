<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
$listarestado = $controlador->listarestados();
$listarRoles = $controlador->listarRoles();



function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

?>


    <script>
function boton(IdUsuarios) {
     Swal.fire({
  title: 'Estas seguro?',
  text: "Tu no podras revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'si, Borralo!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url:"../CRUDC/Controlador/controlador.php?eliminarUsuario&IdUsuarios="+IdUsuarios,
        success:()=>{
            window.location.href="../CRUDC/menu.php"
        }})
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
                        <th>NumeroDocumento</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listarUsuarios as $C){ ?>
                        <tr>
                        <td><?php echo $C->getNumeroDocumento()  ?></td>
                        <td><?php echo $C->getNombre()  ?></td>
                        <td><?php echo $C->getApellidos()  ?></td>
                        <td><?php echo $C->getCorreo()  ?></td>
                        <td><?php echo $C->getNombreRol()  ?></td>
                        <td><?php echo $C->getNombreEstado()  ?></td>
                        <td>
                        <a href="Vista/editarUsuario.php?editarUsuario&IdUsuarios=<?php echo  $C->getIdUsuarios(); ?>" class="btn btn-outline-warning">Editar</a>
                        <a onclick="boton(<?php echo $C->getIdUsuarios(); ?>)" type="button" class="btn btn-outline-danger">Eliminar</a>
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
<script>
    $(document).ready(function() {
    $('#listadousuarios').DataTable();
} );
</script>    
</html>