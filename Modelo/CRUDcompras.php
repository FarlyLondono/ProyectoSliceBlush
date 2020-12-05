<?php

class crudcompras{

public function __construct(){

}

public function listarcompras(){
    $Db = Db::Conectar();
        $listacompras = [];
        $Sql = $Db->query("SELECT f.idcompra,f.IdUsuarios,f.proveedor, f.numerofactura, f.fechacompra,u.Nombre,sum(r.Total) as Totalcompra 
        FROM compras AS f INNER JOIN detallecompra AS r ON f.idcompra=r.idcompra INNER JOIN usuarios AS u ON f.IdUsuarios=u.IdUsuarios GROUP BY r.idcompra");
        //$Sql->bindValue('idcompra',$idcompra);
        $Sql->execute();
        foreach($Sql->fetchAll() as $compras){
            $C = new compras();
            $C->setidcompra($compras['idcompra']);
            $C->setIdUsuarios($compras['IdUsuarios']);
            $C->setNombre($compras['Nombre']);
            $C->setproveedor($compras['proveedor']);
            $C->setnumerofactura($compras['numerofactura']);
            $C->setfechacompra($compras['fechacompra']);
            $C->setTotal($compras['Totalcompra']);
           


            $listacompras[]= $C;      
        }    
        Db::cerrarconexion($Db);
        return $listacompras;


}
public function registrarcompra($compra){ 
    $Db = Db::Conectar();
    $idcompragenerado = -1;
    $Sql = $Db->prepare('INSERT INTO compras (
        IdUsuarios,numerofactura,proveedor,fechacompra
    ) VALUES ( :IdUsuarios,:numerofactura,:proveedor,NOW() )');
    $Sql->bindValue('IdUsuarios',$compra->getIdUsuarios());
    $Sql->bindValue('numerofactura',$compra->getnumerofactura());
    $Sql->bindValue('proveedor',$compra->getproveedor());
 
        
    try{
        $Sql->execute();
        $idcompragenerado = $Db->lastInsertId();//para obtener el ultimo id insertado

    }catch(Exception $e){
        echo $e->getMessage();
    }

    Db::cerrarconexion($Db);
    return $idcompragenerado;
}

public function eliminarcompra($idcompra){
    $mensaje="";
    $Db = Db::Conectar();
    $Sql = $Db->prepare('DELETE FROM `compras` WHERE idcompra =:idcompra ');
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

public function buscarcompra($idcompra){
    //conectar ala DB
    $Db = Db::Conectar();
    //$listaUsuarios = [];
    //se define la consulta
    //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
    $Sql = $Db->prepare('SELECT * FROM compras WHERE idcompra=:idcompra');
    $Sql->bindValue('idcompra',$idcompra);
    //se ejecuta la consulta
    $Sql->execute();
    foreach($Sql->fetchAll() as $compra){
        $c = new compras(); //crear un objeto de tipo usuario
        $c->setidcompra($compra['idcompra']);
        $c->setIdUsuarios($compra['IdUsuarios']);
        $c->setproveedor($compra['proveedor']);
        $c->setnumerofactura($compra['numerofactura']);
        $c->setfechacompra($compra['fechacompra']);
        

        //$listaUsuarios[]= $U;//asignar ala lista el objeto.
    }
    Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    return $c;

}
public function editarcompra($compra){
    $Db = Db::Conectar();
    $Sql = $Db->prepare('UPDATE compras SET
    IdUsuarios=:IdUsuarios,
    proveedor=:proveedor,
    numerofactura=:numerofactura,
    fechacompra=:fechacompra
    WHERE idcompra=:idcompra');
    $Sql->bindValue('IdUsuarios',$compra->getIdUsuarios());
    $Sql->bindValue('proveedor',$compra->getproveedor());
    $Sql->bindValue('numerofactura',$compra->getnumerofactura());
    $Sql->bindValue('fechacompra',$compra->getfechacompra());
    $Sql->bindValue('idcompra',$compra->getidcompra());
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