<?php 
session_start();
class CRUDPedido{
    public function _construct(){

    }

    public function ListarPedidos(){
        $Db = Db::Conectar();
        $listarPedidos = [];
        //$Sql = $Db->query('SELECT f.IdEstadoPedido,f.IdCliente,f.idPedido, f.fechaRegistro,e.IdEstadoPedido,e.NombreEstadoPedido,r.idCliente,r.Nombre FROM pedidos AS f INNER JOIN estadopedido AS e ON f.IdEstadoPedido=e.IdEstadoPedido INNER JOIN clientes AS r ON f.idCliente=r.idCliente');

        $Sql = $Db->query('SELECT f.IdEstadoPedido,f.IdCliente,f.idPedido,f.fechaRegistro,e.IdEstadoPedido,e.NombreEstadoPedido,r.idCliente,r.Nombre,
        sum(p.precio) as TotalPedido 
        FROM pedido AS f INNER JOIN estadopedido AS e ON f.IdEstadoPedido=e.IdEstadoPedido
        INNER JOIN clientes AS r ON f.idCliente=r.idCliente INNER JOIN detallepedidos AS p ON f.idPedido=p.idPedido
        WHERE f.IdEstadoPedido IN (1,2,3) GROUP BY p.idPedido ORDER BY f.fechaRegistro DESC');
       
        $Sql->execute();
        foreach($Sql->fetchAll() as $Registro){
            $C = new Pedido(); //crear un objeto de tipo usuario
            $C->setidPedido($Registro['idPedido']);
            $C->setNombre($Registro['Nombre']);
            $C->setfechaRegistro($Registro['fechaRegistro']);
            $C->setNombreEstadoPedido($Registro['NombreEstadoPedido']);
            $C->setTotalPedido($Registro['TotalPedido']);
            $ListarPedidos[]= $C;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $ListarPedidos;//retornar el array de objetos.
    }

    public function editarPedido($Pedido){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE pedido SET
        idCliente=:idCliente,  
        fechaRegistro=:fechaRegistro,
        IdEstadoPedido=:IdEstadoPedido
        WHERE idPedido = :idPedido ');
        $Sql->bindValue('idCliente',$Pedido->getidCliente());
        $Sql->bindValue('fechaRegistro',$Pedido->getfechaRegistro());
        $Sql->bindValue('IdEstadoPedido',$Pedido->getIdEstadoPedido());
        $Sql->bindValue('idPedido',$Pedido->getidPedido());
        
        
        

        try{

            $Sql->execute();
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    } 

    public function eliminarPedido($idPedido){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `pedido` WHERE idPedido =:idPedido');
        $Sql->bindValue('idPedido',$idPedido);

        try{

            $Sql->execute();
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
            
        }

        Db::cerrarconexion($Db);
        return $mensaje;
    }

    public function buscarPedido($idPedido){
        //conectar ala DB
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM pedido WHERE idPedido=:idPedido');
        $Sql->bindValue(':idPedido',$idPedido);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Pedido){
            $C = new Pedido(); //crear un objeto de tipo cliente
            $C->setidPedido($Pedido['idPedido']);
            $C->setidCliente($Pedido['idCliente']);
            $C->setfechaRegistro($Pedido['fechaRegistro']);
            $C->setIdEstadoPedido($Pedido['IdEstadoPedido']);
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $C;
    }

    public function RegistrarPedido($pedido){
        $Db = Db::Conectar();
        $idPedidoGenerado = -1;
        $sql = $Db->prepare('INSERT INTO pedido(
            idCliente,fechaRegistro,IdEstadoPedido)
            VALUES(
            :idCliente,NOW(),:IdEstadoPedido)');
        $sql->bindValue('idCliente', $pedido->getidCliente());
        $sql->bindValue('IdEstadoPedido',1);
        try{
            $sql->execute();
            $idPedidoGenerado = $Db->lastInsertId();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        Db::CerrarConexion($Db);
        return $idPedidoGenerado;
    }

    public function RegistrarPedidoCarrito(){
        // if($_POST){
             $ControladorPedido = new ControladorPedido();
             $total=0;
             //$SID=session_id();
             $Correo=$_POST['email'];
             //echo $SID;
             $idCliente = $ControladorPedido->buscaridcliente($Correo);
             echo'  
             <script>
                swal($idCliente, "=)!","success",{
                    button: "OK"
                }).then(function(){
                window.location.href="../index.php"
                })
             </script>
             
             ';
             foreach($_SESSION['CARRITO'] as $indice=>$producto){
             $total=$total+($producto['precio']*$producto['cantidad']);
                 //var_dump($producto['idProducto']);
             }
         
                 $Db = Db::Conectar();
                 $idPedidoGenerado = -1;
                 $sentencia=$Db->prepare("INSERT INTO `pedido`
                          (`idCliente`, `fechaRegistro`, `IdEstadoPedido`)
                 VALUES (:idCliente,NOW(),:IdEstadoPedido)");
                 $sentencia->bindValue(":idCliente",print_r($idCliente,true));
                 $sentencia->bindValue(":IdEstadoPedido",1);
                 
                 $sentencia->execute();
                 var_dump($sentencia);
                 $idPedidoGenerado = $Db->lastInsertId();
                 //var_dump($idPedidoGenerado);
 
                 //
                 Db::CerrarConexion($Db);
                 return $idPedidoGenerado;
                     
     //
     }
}

?>