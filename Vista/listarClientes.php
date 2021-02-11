<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();

if(!isset($_SESSION["Correo"])){
    header("Location:../index.php");
}
require_once("../Controlador/controlador.php");
$controlador = new controlador();
$listarCliente = $controlador->listarClientes();



function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

?>


    <script>
function boton(idCliente) {
     Swal.fire({
  title: 'Esta seguro que desea eliminar el registro?',
  text: "Esta decision es irreversible!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url:"../ProyectoSliceBlush/Controlador/controlador.php?eliminarCliente&idCliente="+idCliente,
        success:()=>{
            window.location.href="../ProyectoSliceBlush/menu.php"
        }})
  }
})
    }
        </script>


<link rel="stylesheet" href="Css/estyleTables.css">
<title>Gestionar Clientes</title>   
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
    <div class="container mt-4">
        <div class="card text-white bg-secondary mb-3">
        <p class="h1" align="center">Lista Clientes</p>
        </div>    
        <div id="formContent">
            <table class="table" id="listadousuarios">
                <thead class="thead-dark">
                <hr>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Contrasena</th>
                        <th>..</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listarCliente as $C){ ?>
                        <tr>
                        <td><?php echo $C->getNombre()  ?></td>
                        <td><?php echo $C->getCorreo()  ?></td>
                        <td><?php echo $C->getDireccion()  ?></td>
                        <td><?php echo $C->getTelefono()  ?></td>
                        <td type="password"><?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?><?php echo $C->getContrasena()  ?><?php
                        }
                        ?> </td>    

                        <td>
                        
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?>
                        <a href="Vista/editarCliente.php?editarCliente&idCliente=<?php echo  $C->getidCliente(); ?>" class="btn btn-outline-warning">Editar</a>
                        <a onclick="boton(<?php echo $C->getIdCliente(); ?>)" type="button" class="btn btn-outline-danger">Eliminar</a>
                        <?php
                        }
                        ?> 
                        </td>     
                        </tr>

                   <?php }  ?>


                </tbody>    

            </table>
            <div class="card-header text-white">
                <a href="Vista/registrarCliente.php" class="btn btn-primary">AGREGAR</a>
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