<?php 

class CRUDdetallePedido{
    
    public function _construct(){

    }

    public  function RegistrarDetallePedido($detallePedidos){
        $Db = Db::Conectar();
        $sql = $Db->prepare('INSERT INTO detallepedidos(
            idPedido,idProducto,cantidad,precio)
            VALUES(
            :idPedido,:idProducto,:cantidad,:precio)');
        $sql->bindValue('idPedido', $detallePedidos->getidPedido());
        $sql->bindValue('idProducto', $detallePedidos->getidProducto());
        $sql->bindValue('cantidad', $detallePedidos->getcantidad());
        $sql->bindValue('precio', $detallePedidos->getprecio());
        $detalleP = $detallePedidos->getidProducto();
        $cantddProdc = $detallePedidos->getcantidad();
        try{
            $sql->execute();
            $link = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
            
            $sql2 = "SELECT idinsumo, idProducto, cantidad FROM detalleproducto WHERE idProducto='$detalleP'";
            $result = mysqli_query($link, $sql2);
            if($result->num_rows>0){
                while($fila=$result->fetch_assoc()){
                      $item_1 = $fila['idinsumo'];
                      $item_2 = $fila['idProducto'];
                      $item_5 = $fila['cantidad'];
                      //echo "-".$item_2;
                      self::descuentacantidad($item_1,$item_2,$item_5,$cantddProdc);
                }
             }
            
            
            
            mysqli_close($link);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        Db::CerrarConexion($Db);
    }


    public static function descuentacantidad($item_1,$item_2,$item_5,$cantddProdc){

        $link2 = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
            
            if ( $resultado = $link2->query("SELECT Stock FROM insumos WHERE idinsumo='$item_1'")) {
               // echo 'Número de resultados: '. $resultado->num_rows;

                /* recorrer los resultados  */
                while ($fila = $resultado->fetch_row()) {
                    $num = $fila[0];
                }
            
            }
            
        $cantidadNueva=abs($num - ($item_5 * $cantddProdc));
        $sql4 = "UPDATE insumos set Stock = $cantidadNueva WHERE idinsumo = $item_1";
        $result3 = mysqli_query($link2, $sql4);
        mysqli_close($link2);
        
        }


    public function buscardetallepedido($idDetallePedido){
        //conectar ala DB
        $Db = Db::Conectar();
        //$listaUsuarios = [];
        //se define la consulta
        //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
        $Sql = $Db->prepare('SELECT * FROM detallepedidos WHERE idDetallePedido=:idDetallePedido');
        /*$Sql = $Db->prepare('SELECT idDetallePedido,idPedido,detallepedido.idProducto,PrecioProducto,pecio,cantidad 
        FROM `detallepedidos` join productos on detallepedido.idProducto = productos.idProducto WHERE idDetallePedido=:idDetallePedido');*/
        $Sql->bindValue('idDetallePedido',$idDetallePedido);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $idDetallePedido){
            $I = new detallePedidos(); //crear un objeto de tipo usuario
            $I->setidDetallePedido($idDetallePedido['idDetallePedido']);
            $I->setidPedido($idDetallePedido['idPedido']);
            $I->setidProducto($idDetallePedido['idProducto']);
            //$I->setPrecioProducto($idDetallePedido['PrecioProducto']);
            $I->setprecio($idDetallePedido['precio']);
            $I->setcantidad($idDetallePedido['cantidad']);
            
    
            //$listaUsuarios[]= $U;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $I;
    }

    public function ListarDetallePedido($idPedido){
        $Db = Db::Conectar();
        //$Sql = $Db->query("SELECT * FROM detallepedidos WHERE idPedido=$idPedido
        //ORDER BY idDetallePedido DESC");
        $Sql = $Db->query("SELECT f.idDetallePedido,f.idPedido,f.idProducto,f.cantidad,
        f.precio,i.idProducto,i.NombreProducto 
        FROM detallepedidos  AS f LEFT JOIN productos AS i ON f.idProducto=i.idProducto WHERE f.idPedido = $idPedido ");
        $Sql->execute();
        foreach($Sql->fetchAll() as $detallePedidos){
            $C = new detallePedidos(); //crear un objeto de tipo usuario
            $C->setidDetallePedido($detallePedidos['idDetallePedido']);
            $C->setidPedido($detallePedidos['idPedido']);
            $C->setidProducto($detallePedidos['idProducto']);
            $C->setNombreProducto($detallePedidos['NombreProducto']);
            $C->setcantidad($detallePedidos['cantidad']);
            $C->setprecio($detallePedidos['precio']);
          
            /*echo "<p>".$Usuario['idUsuarios']."</p>";
            echo "<p>".$Usuario['tipodocumento']."</p>";*/

            $Lista[]= $C;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $Lista;//retornar el array de objetos.
    }

    public function eliminarDetallePedido($idDetallePedido){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `detallepedidos` WHERE idDetallePedido =:idDetallePedido');
        $Sql->bindValue('idDetallePedido',$idDetallePedido);

        try{

            $Sql->execute();
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
            
        }

        Db::cerrarconexion($Db);
        return $mensaje;
    }

    public function editardetallepedido($detallePedidos){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE detallepedidos SET
        idPedido=:idPedido,
        idProducto=:idProducto,
        cantidad=:cantidad,
        precio=:precio
        WHERE idDetallePedido=:idDetallePedido');
        $Sql->bindValue('idPedido',$detallePedidos->getidPedido());
        $Sql->bindValue('idProducto',$detallePedidos->getidProducto());
        $Sql->bindValue('cantidad',$detallePedidos->getcantidad());
        $Sql->bindValue('precio',$detallePedidos->getprecio());
        $Sql->bindValue('idDetallePedido',$detallePedidos->getidDetallePedido());
        //var_dump($Sql);
        //var_dump($Usuario);
    
        try{
    
            $Sql->execute();
            //echo "Actualizacion exitosa";
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }
    
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    }

    public function verdetallepedido($idPedido){
        $Db = Db::Conectar();
        $listadetallepedido = [];
        /*'SELECT f.IdEstado,f.IdRol,f.IdUsuarios, f.NumeroDocumento, f.Nombre, f.Apellidos,
         f.Correo, e.idEstado,e.NombreEstado,r.idRol,r.NombreRol FROM usuarios AS f INNER JOIN
          estado AS e ON f.IdEstado=e.IdEstado INNER JOIN rol AS r ON f.IdRol=r.idRol'*/
        $Sql = $Db->query("SELECT f.idDetallePedido,f.idPedido,f.idProducto,f.cantidad,
        f.precio,i.idProducto,i.NombreProducto 
        FROM detallepedidos  AS f LEFT JOIN productos AS i ON f.idProducto=i.idProducto WHERE f.idPedido = $idPedido ");
        //$Sql = $Db->query("SELECT  * FROM detallepedidos WHERE idPedido=$idPedido");
        //$Sql->bindValue('idPedido',$idPedido);
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detallePedidos();
            $D->setidDetallePedido($objeto['idDetallePedido']);
            $D->setidPedido($objeto['idPedido']);
            $D->setidProducto($objeto['idProducto']);
            $D->setNombreProducto($objeto['NombreProducto']);
            $D->setcantidad($objeto['cantidad']);
            $D->setprecio($objeto['precio']);
           
    
    
            $listadetallepedido[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listadetallepedido;
    
    
    }
    public function dropdetallepedido($idPedido){
        $mensaje="";
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `detallepedidos` WHERE idPedido =:idPedido ');
        $Sql->bindValue('idPedido',$idPedido);
    
        try{
    
            $Sql->execute();
            $mensaje=1;
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $mensaje;
    }

    public function RegistrarDetallePedidoCarrito($detallePedidos){
    
        // foreach($_SESSION['CARRITO'] as $indice=>$detallePedidos){
             $Db = Db::Conectar();
             $sentencia2=$Db->prepare('INSERT INTO `detallepedidos`
                 (`idPedido`, `idProducto`, `cantidad`, `precio`) 
             VALUES (:idPedido, :idProducto, :cantidad, :precio);');
     
             $sentencia2->bindValue("idPedido",$detallePedidos->getidPedido());
             $sentencia2->bindValue("idProducto",$detallePedidos->getidProducto());
             $sentencia2->bindValue("cantidad",$detallePedidos->getcantidad());
             $sentencia2->bindValue("precio",$detallePedidos->getprecio());
             $detalleP = $detallePedidos->getidProducto();
             $cantddProdc = $detallePedidos->getcantidad();
             $sentencia2->execute();
             try{
                $sentencia2->execute();
                $link = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
                
                $sql2 = "SELECT idinsumo, idProducto, cantidad FROM detalleproducto WHERE idProducto='$detalleP'";
                $result = mysqli_query($link, $sql2);
                if($result->num_rows>0){
                    while($fila=$result->fetch_assoc()){
                          $item_1 = $fila['idinsumo'];
                          $item_2 = $fila['idProducto'];
                          $item_5 = $fila['cantidad'];
                          //echo "-".$item_1;
                          self::descuentacantidadcarrito($item_1,$item_2,$item_5,$cantddProdc);
                    }
                 }
                
                
                
                mysqli_close($link);
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            Db::CerrarConexion($Db);
     
    }
    
    public static function descuentacantidadcarrito($item_1,$item_2,$item_5,$cantddProdc){

        $link2 = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
            
            if ( $resultado = $link2->query("SELECT Stock FROM insumos WHERE idinsumo='$item_1'")) {
               // echo 'Número de resultados: '. $resultado->num_rows;

                /* recorrer los resultados  */
                while ($fila = $resultado->fetch_row()) {
                    $num = $fila[0];
                }
            
            }
            
        $cantidadNueva=abs($num - ($item_5 * $cantddProdc));
        $sql4 = "UPDATE insumos set Stock = $cantidadNueva WHERE idinsumo = $item_1";
        $result3 = mysqli_query($link2, $sql4);
        mysqli_close($link2);
        
        }
    
    

    

}

?>