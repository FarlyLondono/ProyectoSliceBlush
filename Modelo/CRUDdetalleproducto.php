<?php



class cruddetalleproducto{

    public function __construct(){}

    public function RegistrarDetalleProducto($Detalleproducto){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO detalleproducto(
        idProducto,idinsumo,cantidad,unidadMedida
        ) VALUES (:idProducto,:idinsumo,:cantidad,:unidadMedida)');
        $Sql->bindValue('idProducto',$Detalleproducto->getidProducto());
        $Sql->bindValue('idinsumo',$Detalleproducto->getidinsumo());
        //$Sql->bindValue('NombreInsumo',$Detalleproducto->getNombreInsumo());
        $Sql->bindValue('cantidad',$Detalleproducto->getcantidad());
        $Sql->bindValue('unidadMedida',$Detalleproducto->getunidadMedida());
    
        try{
            $Sql->execute();
    
    
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
        Db::cerrarconexion($Db);
    }

    public function listardetalleproducto($idProducto){
        $Db = Db::Conectar();
        $listardetalleproducto = [];
        $Sql = $Db->query("SELECT f.iddetalleproducto,f.idProducto,f.idinsumo,f.cantidad,
        f.unidadMedida,i.idinsumo,i.nombreProducto
        FROM detalleproducto  AS f INNER JOIN insumos AS i ON f.idinsumo=i.idinsumo WHERE f.idProducto = $idProducto ");
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detalleproducto();
            $D->setiddetalleproducto($objeto['iddetalleproducto']);
            $D->setidProducto($objeto['idProducto']);
            $D->setidinsumo($objeto['idinsumo']);
            $D->setNombreInsumo($objeto['nombreProducto']);
            $D->setCantidad($objeto['cantidad']);
            $D->setunidadMedida($objeto['unidadMedida']);
            
    
            $listardetalleproducto[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listardetalleproducto;
    
    
    }

    public function verdetalleproducto($idProducto){
        $Db = Db::Conectar();
        $listadetalleproducto = [];
        /*'SELECT f.IdEstado,f.IdRol,f.IdUsuarios, f.NumeroDocumento, f.Nombre, f.Apellidos,
         f.Correo, e.idEstado,e.NombreEstado,r.idRol,r.NombreRol FROM usuarios AS f INNER JOIN
          estado AS e ON f.IdEstado=e.IdEstado INNER JOIN rol AS r ON f.IdRol=r.idRol'*/
        $Sql = $Db->query("SELECT f.iddetalleproducto,f.idProducto,f.idinsumo,
        f.Cantidad,f.unidadMedida,i.idinsumo,i.nombreProducto
        FROM detalleproducto  AS f INNER JOIN insumos AS i ON f.idinsumo=i.idinsumo WHERE f.idProducto = $idProducto ");
        //$Sql = $Db->query("SELECT  * FROM detallecompra WHERE idcompra=:idcompra ");
        //$Sql->bindValue('idcompra',$idcompra);
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detalleproducto();
            $D->setiddetalleproducto($objeto['iddetalleproducto']);
            $D->setidProducto($objeto['idProducto']);
            $D->setidinsumo($objeto['idinsumo']);
            $D->setNombreInsumo($objeto['nombreProducto']);
            $D->setCantidad($objeto['Cantidad']);
            $D->setunidadMedida($objeto['unidadMedida']);
    
    
            $listadetalleproducto[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listadetalleproducto;
    
    
    }

    public function eliminardetalleproducto($iddetalleproducto){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('DELETE FROM `detalleproducto` WHERE 	iddetalleproducto =:iddetalleproducto');
        $Sql->bindValue('iddetalleproducto',$iddetalleproducto);

        try{

            $Sql->execute();
        }
        catch(Exception $e){
            $mensaje=$e->getMessage();
            
        }

        Db::cerrarconexion($Db);
        return $mensaje;
    }

    public function buscardetalleproducto($iddetalleproducto){
        //conectar ala DB
        $Db = Db::Conectar();
        //$listaUsuarios = [];
        //se define la consulta
        //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
        $Sql = $Db->prepare('SELECT * from detalleproducto where iddetalleproducto=:iddetalleproducto');
        $Sql->bindValue('iddetalleproducto',$iddetalleproducto);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $detallecompra){
            $I = new detalleproducto(); //crear un objeto de tipo usuario
            $I->setiddetalleproducto($detallecompra['iddetalleproducto']);
            $I->setidinsumo($detallecompra['idinsumo']);    
            $I->setunidadMedida($detallecompra['unidadMedida']);
            $I->setCantidad($detallecompra['cantidad']);
            
            
    
            //$listaUsuarios[]= $U;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $I;
    }







}    


?>    