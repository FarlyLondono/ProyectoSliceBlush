<?php



class cruddetalleproducto{

    public function __construct(){}

    public function RegistrarDetalleProducto($Detalleproducto){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO detalleproducto(
        idProducto,idinsumo,cantidad,UnidadMedida
        ) VALUES (:idProducto,:idinsumo,:cantidad,:UnidadMedida)');
        $Sql->bindValue('idProducto',$Detalleproducto->getidProducto());
        $Sql->bindValue('idinsumo',$Detalleproducto->getidinsumo());
        //$Sql->bindValue('NombreInsumo',$Detalleproducto->getNombreInsumo());
        $Sql->bindValue('cantidad',$Detalleproducto->getcantidad());
        $Sql->bindValue('UnidadMedida',$Detalleproducto->getunidadMedida());
    
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
        $Sql = $Db->query("SELECT f.iddetalleproducto,f.idProducto,f.idinsumo,f.Cantidad,
        f.UnidadMedida,i.idinsumo,i.nombreProducto
        FROM detalleproducto  AS f INNER JOIN insumos AS i ON f.idinsumo=i.idinsumo WHERE f.idProducto = $idProducto ");
        $Sql->execute();
        foreach($Sql->fetchAll() as $objeto){
            $D = new detalleproducto();
            $D->setiddetalleproducto($objeto['iddetalleproducto']);
            $D->setidProducto($objeto['idProducto']);
            $D->setidinsumo($objeto['idinsumo']);
            $D->setNombreInsumo($objeto['nombreProducto']);
            $D->setCantidad($objeto['Cantidad']);
            $D->setunidadMedida($objeto['UnidadMedida']);
            
    
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
        f.Cantidad,f.UnidadMedida,i.idinsumo,i.nombreProducto
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
            $D->setunidadMedida($objeto['UnidadMedida']);
    
    
            $listadetalleproducto[]= $D;      
        }    
        Db::cerrarconexion($Db);
        return $listadetalleproducto;
    
    
    }
    public function buscardetalleprodcuto($iddetalleproducto){
        //conectar ala DB
        $Db = Db::Conectar();
        //$listaUsuarios = [];
        //se define la consulta
        //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
        $Sql = $Db->prepare('SELECT iddetalleproducto,detalleproducto.idinsumo,Cantidad
        FROM `detalleproducto` join insumos on detalleproducto.idinsumo = insumos.idinsumo WHERE iddetalleproducto=:iddetalleproducto');
        $Sql->bindValue('iddetalleproducto',$iddetalleproducto);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $detallecompra){
            $I = new detalleproducto(); //crear un objeto de tipo usuario
            $I->setiddetalleproducto($detallecompra['iddetalleproducto']);
            $I->setidinsumo($detallecompra['idinsumo']);
            $I->setCantidad($detallecompra['Cantidad']);
            
            
    
            //$listaUsuarios[]= $U;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $I;
    }







}    


?>    