<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
require_once("../Modelo/clientes.php");

$controlador = new controlador();
$listarCliente = $controlador->listarClientes();
$buscarCliente= $controlador->buscarCliente($_GET["idCliente"]);


function desplegarVista($ruta){
    header('Location: '.$ruta);
}
function desplegarVista2($ruta){
    require_once($ruta);
}

if(isset($_POST["cambiarEstado"])){
    $controlador->cambiarEstado();

    desplegarVista("../menu.php");

    //desplegarVista("../menu.php");

}

?>


<script>
function boton() {
     Swal.fire({
  title: 'Esta seguro que desea Cambiar el registro?',
  text: "Esta decision es irreversible!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Cambiar!'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({url:"../ProyectoSliceBlush/Controlador/controlador.php",
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
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
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
                        <td><?php echo $C->getNombreEstado() ?></td>
                           

                        <td>
                        <a href="Vista/editarCliente.php?editarCliente&idCliente=<?php echo  $C->getidCliente(); ?>" class="btn btn-outline-warning"><img style="width: 25px; height: 25px;" src="Img/editar.png" alt="">Editar</a>
                        <label class="switch">
                                    <input type="checkbox" <?php echo $C->getidEstado()==1 ? "checked" : "" ?> onclick="active(<?php echo ($C->getidEstado()) ?>,<?php echo ($C->getidCliente()) ?>);" >
                                    <span class="slider round"></span> 
                                </label>
                        <?php
                        $sesion = $_SESSION["IdRol"];
                        if($sesion == 1) 
                        {
                            ?>
                               
                                
                        <?php
                        }
                        ?> 
                        </td>     
                        </tr>

                   <?php }  ?>


                </tbody>    

            </table>
            <div class="card-header text-white">
                <?php
                $sesion = $_SESSION["IdRol"];
                        if($sesion == 1)
                        {
                            ?>
                <a href="Vista/registrarCliente.php" class="btn btn-primary">AGREGAR</a>
            <?php
            }
            ?>
            </div> 
    </div>
                    </div>
</body>
<script>
function active(isActive,idCliente){
    console.log(isActive,idCliente);
    $.ajax({
            type: "POST",
            url: "./Controlador/controlador.php",
            data: {
                idCliente : idCliente,
                idEstado: isActive==1 ? 2 : 1,
                actionc: "active"
            },
            success : (data)=>{
                nativation('#navigation','Vista/listarClientes.php')
            }
        })

}
</script>
<script>
    $(document).ready(function() {
    $('#listadousuarios').DataTable();
} );
</script>


</html>