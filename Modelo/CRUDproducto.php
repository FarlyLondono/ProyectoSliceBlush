<?php 

class CRUDproducto{
    public function _construct(){

    }

    public function cambiarEstadoP($Productos){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE productos SET
        idEstado=:idEstado     
        WHERE idProducto=:idProducto');
        $Sql->bindValue('idEstado',$Productos->getidEstado());
        $Sql->bindValue('idProducto',$Productos->getidProducto());
        
         
         

        try{

            $Sql->execute();
            //echo "Actualizacion exitosa";
        }
        catch(Exception $e){
            //echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);
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
            $imagen='img2/'.$Productos['imagen'];
            $C = new Productos(); //crear un objeto de tipo usuario
            $C->setidProducto($Productos['idProducto']);
            $C->setNombreProducto($Productos['NombreProducto']);
            $C->setDescripcionProducto($Productos['DescripcionProducto']);
            $C->setPrecioProducto($Productos['PrecioProducto']);
            $C->setidEstado($Productos['idEstado']);
            $C->setNombreEstado($Productos['NombreEstado']);
            $C->setimagen($imagen);     
            
          
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
        $idProductoGenerado = -1;
        /*$imagen= $_FILES['imagen'];
            $nombreimagen=$imagen['name'];
            $type=$imagen['type'];
            $urltemp=$imagen['tmp_name'];

            if($nombreimagen !=''){
            $destino='../img2/';
            $imgnombre= 'img_'.md5(date('d-m-Y H:m:s'));
            $imagenproducto= $imgnombre.'.jpg';
            $src=$destino.$imagenproducto;

            }*/
        $Sql = $Db->prepare('INSERT INTO productos(NombreProducto,DescripcionProducto,PrecioProducto,idEstado,imagen)
         VALUES(:NombreProducto,:DescripcionProducto,:PrecioProducto,:idEstado,:imagen)');
        $Sql->bindValue('NombreProducto',$Productos->getNombreProducto());
        $Sql->bindValue('DescripcionProducto',$Productos->getDescripcionProducto());
        $Sql->bindValue('PrecioProducto',$Productos->getPrecioProducto());
        $Sql->bindValue('idEstado',$Productos->getidEstado());
        $Sql->bindValue('imagen',$Productos->getimagen());

        //var_dump($Usuario);

        try{

            $Sql->execute();
            $idProductoGenerado = $Db->lastInsertid();
            /*if($nombreimagen != ''){
                move_uploaded_file($urltemp,$src);
            }*/
            //echo "registro exitoso";
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $idProductoGenerado;
    }

    public function editarProducto($Productos){
       
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE productos SET
        NombreProducto=:NombreProducto,
        DescripcionProducto=:DescripcionProducto,
        PrecioProducto=:PrecioProducto
        WHERE idProducto=:idProducto');
        $Sql->bindValue('NombreProducto',$Productos->getNombreProducto());
        $Sql->bindValue('DescripcionProducto',$Productos->getDescripcionProducto());
        $Sql->bindValue('PrecioProducto',$Productos->getPrecioProducto());
        $Sql->bindValue('idProducto',$Productos->getidProducto());
        

        try{

            $Sql->execute();
           
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }



        $imagen= $_FILES['imagen'];
        $nombreimagen=$imagen['name'];
        $type=$imagen['type'];
        $urltemp=$imagen['tmp_name'];

        if($nombreimagen !=''){
        $destino='../img2/';
        $imgnombre= 'img_'.md5(date('d-m-Y H:m:s'));
        $imagenproducto= $imgnombre.'.jpg';
        $src=$destino.$imagenproducto;

        $Sql = $Db->prepare('UPDATE productos SET
        NombreProducto=:NombreProducto,
        DescripcionProducto=:DescripcionProducto,
        PrecioProducto=:PrecioProducto,
        idEstado=:idEstado,
        imagen=:imagen
        WHERE idProducto=:idProducto');
        $Sql->bindValue('imagen',$imagenproducto);
        $Sql->bindValue('NombreProducto',$Productos->getNombreProducto());
        $Sql->bindValue('DescripcionProducto',$Productos->getDescripcionProducto());
        $Sql->bindValue('PrecioProducto',$Productos->getPrecioProducto());
        $Sql->bindValue('idEstado',1);
        $Sql->bindValue('idProducto',$Productos->getidProducto());

        try{

            $Sql->execute();
            if($nombreimagen != ''){
                move_uploaded_file($urltemp,$src);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

            }
  
        Db::cerrarconexion($Db);
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