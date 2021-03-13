<?php 

class CRUDproducto{
    public function _construct(){

    }

    public function listarProductos(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listarProductos = [];
        //se define la consulta
        $Sql = $Db->query('SELECT p.idEstado,p.idProducto, p.NombreProducto,p.DescripcionProducto,p.PrecioProducto,p.imagen,e.idEstado,e.NombreEstado FROM productos as p INNER JOIN estado as e ON e.idEstado=p.idEstado');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Productos){
            $C = new Productos(); //crear un objeto de tipo usuario
            $C->setidProducto($Productos['idProducto']);
            $C->setNombreProducto($Productos['NombreProducto']);
            $C->setDescripcionProducto($Productos['DescripcionProducto']);
            $C->setPrecioProducto($Productos['PrecioProducto']);
            $C->setidEstado($Productos['idEstado']);
            $C->setNombreEstado($Productos['NombreEstado']);
            $C->setimagen($Productos['imagen']);
          
            /*echo "<p>".$Usuario['idUsuarios']."</p>";
            echo "<p>".$Usuario['tipodocumento']."</p>";*/

            $listarProductos[]= $C;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listarProductos;//retornar el array de objetos.
    }
    
    public function eliminarProducto($idProducto){  
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `productos` WHERE idProducto =:idProducto');
        $Sql->bindValue('idProducto',$idProducto);

        try{

            $Sql->execute();
            $mensaje="Eliminacion exitosa";
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $mensaje;
    }

    public function registrarProducto($Productos){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO productos(NombreProducto,DescripcionProducto,PrecioProducto,idEstado)
         VALUES(:NombreProducto,:DescripcionProducto,:PrecioProducto,:idEstado)');
        $Sql->bindValue('NombreProducto',$Productos->getNombreProducto());
        $Sql->bindValue('DescripcionProducto',$Productos->getDescripcionProducto());
        $Sql->bindValue('PrecioProducto',$Productos->getPrecioProducto());
        $Sql->bindValue('idEstado',$Productos->getidEstado());

        //var_dump($Usuario);

        try{

            $Sql->execute();
            //echo "registro exitoso";
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    }

    public function editarProducto($Productos){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE productos SET
        NombreProducto=:NombreProducto,
        DescripcionProducto=:DescripcionProducto,
        PrecioProducto=:PrecioProducto,
        idEstado=:idEstado
        WHERE idProducto=:idProducto');
        $Sql->bindValue('NombreProducto',$Productos->getNombreProducto());
        $Sql->bindValue('DescripcionProducto',$Productos->getDescripcionProducto());
        $Sql->bindValue('PrecioProducto',$Productos->getPrecioProducto());
        $Sql->bindValue('idEstado',$Productos->getidEstado());
        $Sql->bindValue('idProducto',$Productos->getidProducto());
        
        
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


    public function buscarProducto($idProducto){
        //conectar ala DB
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM productos WHERE idProducto=:idProducto');
        $Sql->bindValue(':idProducto',$idProducto);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Productos){
            $C = new Productos(); //crear un objeto de tipo cliente
            $C->setidProducto($Productos['idProducto']);
            $C->setNombreProducto($Productos['NombreProducto']);
            $C->setDescripcionProducto($Productos['DescripcionProducto']);
            $C->setPrecioProducto($Productos['PrecioProducto']);
            $C->setidEstado($Productos['idEstado']);
            $C->setNombreEstado($Productos['NombreEstado']);

        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $C;
    }
}

?>