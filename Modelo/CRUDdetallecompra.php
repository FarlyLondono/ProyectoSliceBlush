<?php
class cruddetallecompra{
    public function __construct(){}

    public function registrardetallecompra($detallecompra){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO detallecompra(
            idinsumo,idcompra,Cantidad,Total,observaciones
        ) VALUES (:idinsumo,:idcompra,:Cantidad,:Total,:observaciones)');
        $Sql->bindValue('idinsumo',$detallecompra->getidinsumo());
        $Sql->bindValue('idcompra',$detallecompra->getidcompra());
        $Sql->bindValue('Cantidad',$detallecompra->getCantidad());
        $Sql->bindValue('Total',$detallecompra->getTotal());
        $Sql->bindValue('observaciones',$detallecompra->getobservaciones());
        $detalleI = $detallecompra->getidinsumo();
        try{
            $Sql->execute();
            $link = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
            $sql2 = "SELECT idinsumo, Cantidad FROM detallecompra WHERE idinsumo='$detalleI'";
            $result = mysqli_query($link, $sql2);
            $item_2=0;
            if($result->num_rows>0){
                while($fila=$result->fetch_assoc()){
                      $item_1 = $fila['idinsumo'];
                      $item_2 = $fila['Cantidad'];
                      //echo "-".$item_1;
                      self::sumacantidad($item_1,$item_2);
                }
             }
            
            
            
            mysqli_close($link);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
        Db::cerrarconexion($Db);
    }

    public static function sumacantidad($item_1,$item_2){

        $link2 = new mysqli('127.0.0.1', 'root', '', 'proyecto slice blush');
            
            if ( $resultado = $link2->query("SELECT Stock FROM insumos WHERE idinsumo='$item_1'")) {
               // echo 'Número de resultados: '. $resultado->num_rows;

                /* recorrer los resultados  */
                while ($fila = $resultado->fetch_row()) {
                    $num = $fila[0];
                }
            
            }
            
        $cantidadNueva=abs($num+$item_2);
        $sql4 = "UPDATE insumos set Stock = $cantidadNueva WHERE idinsumo = $item_1";
        $result3 = mysqli_query($link2, $sql4);
        mysqli_close($link2);
        $num=0;
        $cantidadNueva=0;
        
        }

        

    public function listardetallecompra($idcompra){
        $Db = Db::Conectar();
        $listardetallecompra = [];
        $Sql = $Db->query("SELECT f.idinsumo,f.idcompra,f.iddetallecompra,
        f.Cantidad,f.Total,f.observaciones,i.idinsumo,i.nombreProducto
         FROM detallecompra  AS f INNER JOIN insumos AS i ON f.idinsumo=i.idinsumo WHERE f.idcompra = $idcompra ");
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detallecompra();
            $D->setiddetallecompra($objeto['iddetallecompra']);
            $D->setidcompra($objeto['idcompra']);
            $D->setidinsumo($objeto['idinsumo']);
            $D->setnombreProducto($objeto['nombreProducto']);
            $D->setCantidad($objeto['Cantidad']);
            $D->setTotal($objeto['Total']);
            $D->setobservaciones($objeto['observaciones']);
    
    
            $listardetallecompra[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listardetallecompra;
    
    
    }

    public function verdetallecompra($idcompra){
        $Db = Db::Conectar();
        $listadetallecompra = [];
        /*'SELECT f.IdEstado,f.IdRol,f.IdUsuarios, f.NumeroDocumento, f.Nombre, f.Apellidos,
         f.Correo, e.idEstado,e.NombreEstado,r.idRol,r.NombreRol FROM usuarios AS f INNER JOIN
          estado AS e ON f.IdEstado=e.IdEstado INNER JOIN rol AS r ON f.IdRol=r.idRol'*/
        $Sql = $Db->query("SELECT f.idinsumo,f.idcompra,f.iddetallecompra,
        f.Cantidad,f.Total,f.observaciones,i.idinsumo,i.nombreProducto
         FROM detallecompra  AS f INNER JOIN insumos AS i ON f.idinsumo=i.idinsumo WHERE f.idcompra= $idcompra");
        //$Sql = $Db->query("SELECT  * FROM detallecompra WHERE idcompra=:idcompra ");
        //$Sql->bindValue('idcompra',$idcompra);
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detallecompra();
            $D->setidcompra($objeto['idcompra']);
            $D->setiddetallecompra($objeto['iddetallecompra']);
            $D->setidinsumo($objeto['idinsumo']);
            $D->setnombreProducto($objeto['nombreProducto']);
            $D->setCantidad($objeto['Cantidad']);
            $D->setTotal($objeto['Total']);
            $D->setobservaciones($objeto['observaciones']);
    
    
            $listadetallecompra[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listadetallecompra;
    
    
    }
    public function eliminardetallecompra($iddetallecompra){
        $mensaje="";
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `detallecompra` WHERE iddetallecompra =:iddetallecompra ');
        $Sql->bindValue('iddetallecompra',$iddetallecompra);
    
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
    public function dropdetallecompra($idcompra){
        $mensaje="";
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `detallecompra` WHERE idcompra =:idcompra ');
        $Sql->bindValue('idcompra',$idcompra);
    
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
    public function buscardetallecompra($iddetallecompra){
        //conectar ala DB
        $Db = Db::Conectar();
        //$listaUsuarios = [];
        //se define la consulta
        //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
        $Sql = $Db->prepare('SELECT iddetallecompra,detallecompra.idinsumo,idcompra,Cantidad,Total,observaciones,precio 
        FROM `detallecompra` join insumos on detallecompra.idinsumo = insumos.idinsumo WHERE iddetallecompra=:iddetallecompra');
        $Sql->bindValue('iddetallecompra',$iddetallecompra);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $detallecompra){
            $I = new detallecompra(); //crear un objeto de tipo usuario
            $I->setiddetallecompra($detallecompra['iddetallecompra']);
            $I->setidcompra($detallecompra['idcompra']);
            $I->setidinsumo($detallecompra['idinsumo']);
            $I->setprecio($detallecompra['precio']);
            $I->setCantidad($detallecompra['Cantidad']);
            $I->setTotal($detallecompra['Total']);
            $I->setobservaciones($detallecompra['observaciones']);
            
    
            //$listaUsuarios[]= $U;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $I;
    }
    public function editardetallecompra($detallecompra){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE detallecompra SET
        idinsumo=:idinsumo,
        idcompra=:idcompra,
        Cantidad=:Cantidad,
        Total=:Total,
        observaciones=:observaciones
        WHERE iddetallecompra=:iddetallecompra');
        $Sql->bindValue('idinsumo',$detallecompra->getidinsumo());
        $Sql->bindValue('idcompra',$detallecompra->getidcompra());
        $Sql->bindValue('Cantidad',$detallecompra->getCantidad());
        $Sql->bindValue('Total',$detallecompra->getTotal());
        $Sql->bindValue('observaciones',$detallecompra->getobservaciones());
        $Sql->bindValue('iddetallecompra',$detallecompra->getiddetallecompra());
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


}

?>