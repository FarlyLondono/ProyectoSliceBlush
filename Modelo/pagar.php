<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
session_start();
require_once("conexion.php");
require_once("config.php");
require_once("CarritoCompras.php");
require_once("../Controlador/ControladorPedido.php");
$ControladorPedido = new ControladorPedido();
?>

<?php
//$_SESSION['idCliente'] = $_POST['idCliente'];
if($_POST){
    $total=0;
    //$SID=session_id();
    $Correo=$_POST['email'];
    //echo $SID;
    $idCliente = $ControladorPedido->buscaridcliente($Correo);
  echo'  
    <script>
swal($idCliente, "Ya estas registrado!","success",{
    button: "OK"
}).then(function(){
window.location.href="../index.php"
})
    </script>
    
    ';
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }

        $Db = Db::Conectar();
        $idPedidoGenerado = -1;
        $sentencia=$Db->prepare('INSERT INTO pedidos
                 (idCliente, fechaRegistro, IdEstadoPedido)
        VALUES (:idCliente,NOW(),:IdEstadoPedido)');
        $sentencia->bindValue(":idCliente",print_r($idCliente,true));
        $sentencia->bindValue(":IdEstadoPedido",1);

        $sentencia->execute();
        $idPedidoGenerado = $Db->lastInsertId();
        Db::CerrarConexion($Db);
        return $idPedidoGenerado;
    
        
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
            $Db = Db::Conectar();
            $sentencia=$Db->prepare('INSERT INTO `detallepedidos`
                (`idPedido`, `idProducto`, `cantidad`, `precio`) 
            VALUES (:idPedido, :idProducto, :cantidad, :precio);');

            $sentencia->bindValue(":idPedido",$idPedidoGenerado);
            $sentencia->bindValue(":idProducto",$producto->setidProducto(['ID']));
            $sentencia->bindValue(":cantidad",$producto->setcantidad(['CANTIDAD']));
            $sentencia->bindValue(":precio",$producto->setprecio(['PRECIO']));
            $sentencia->execute();

            Db::CerrarConexion($Db);
        }
            /*$Db = Db::Conectar();
            $sql = $Db->prepare('INSERT INTO detallepedidos(
                idPedido,idProducto,cantidad,precio)
                VALUES(
                :idPedido,:idProducto,:cantidad,:precio)');
            $sql->bindValue('idPedido', $detallePedidos->getidPedido());
            $sql->bindValue('idProducto', $detallePedidos->getidProducto());
            $sql->bindValue('cantidad', $detallePedidos->getcantidad());
            $sql->bindValue('precio', $detallePedidos->getprecio());

            try{
                $sql->execute();
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            Db::CerrarConexion($Db);*/
    //echo "<h3>".$total."</h3>";

}

//session_destroy()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="icon" type="image/png" href="../Img/hamburguer.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../Css/estyleTables.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</head>
<body background="../Img/rsz_shapelined-_jbkdviwexi-unsplash.jpg">
<div class="jumbotron text-center">
    <h1 class="display-4">!Gracias por su solicitud!</h1>
    <hr class="my-4">
    <p class="lead">El pago de su pedido en Efectivo es de : 
        <h4>$<?php echo number_format($total,2);  ?></h4>
    
    </p>
    <p>Los productos podran ser descargados una vez que se procese el pago<br>
    <strong>(para aclaraciones : Asadoslaportada@gmail.com)</strong>
    </p>
    <a href="../menu.php" class="btn btn-success">Regresar</a>
</div>
</body>

</html>