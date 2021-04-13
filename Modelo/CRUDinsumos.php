<?php
class crudinsumos{

public function __construct(){

}
public function listarinsumos(){
    $Db = Db::Conectar();
        $listainsumos = [];
        $Sql = $Db->query('SELECT * FROM insumos order by nombreProducto');
        $Sql->execute();
        foreach($Sql->fetchAll() as $insumos){
            $I = new insumos();
            $I->setidinsumo($insumos['idinsumo']);
            $I->setnombreProducto($insumos['nombreProducto']);
            $I->setunidadmedida($insumos['unidadmedida']);
            $I->setprecio($insumos['precio']);
            $I->setStock($insumos['Stock']);


            $listainsumos[]= $I;      
        }    
        Db::cerrarconexion($Db);
        return $listainsumos;
}
public function Registrarinsumo($insumo){
    $Db = Db::Conectar();
    $Sql = $Db->prepare('INSERT INTO insumos(nombreProducto,unidadmedida,precio)
     VALUES(:nombreProducto,:unidadmedida,:precio)');
    $Sql->bindValue('nombreProducto',$insumo->getnombreProducto());
    $Sql->bindValue('unidadmedida',$insumo->getunidadmedida());
    $Sql->bindValue('precio',$insumo->getprecio());
    //$Sql->bindValue('Stock',1);
    
    //var_dump($Sql);
    //var_dump($producto);

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
public function buscarinsumo($idinsumo){
    //conectar ala DB
    $Db = Db::Conectar();
    //$listaUsuarios = [];
    //se define la consulta
    //$Sql = $Db->query("SELECT * FROM ususarios WHERE idUsuarios=$idUsuarios");
    $Sql = $Db->prepare('SELECT * FROM insumos WHERE idinsumo=:idinsumo');
    $Sql->bindValue('idinsumo',$idinsumo);
    //se ejecuta la consulta
    $Sql->execute();
    foreach($Sql->fetchAll() as $insumo){
        $I = new insumos(); //crear un objeto de tipo usuario
        $I->setidinsumo($insumo['idinsumo']);
        $I->setnombreProducto($insumo['nombreProducto']);
        $I->setunidadmedida($insumo['unidadmedida']);
        $I->setprecio($insumo['precio']);
        //$I->setStock($insumo['Stock']);
        

        //$listaUsuarios[]= $U;//asignar ala lista el objeto.
    }
    Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    return $I;
}
public function editarinsumo($insumo){
    $Db = Db::Conectar();
    $Sql = $Db->prepare('UPDATE insumos SET
    nombreProducto=:nombreProducto,
    unidadmedida=:unidadmedida,
    precio=:precio
    WHERE idinsumo=:idinsumo');
    $Sql->bindValue('nombreProducto',$insumo->getnombreProducto());
    $Sql->bindValue('unidadmedida',$insumo->getunidadmedida());
    $Sql->bindValue('precio',$insumo->getprecio());
    //$Sql->bindValue('Stock',$insumo->getStock());
    $Sql->bindValue('idinsumo',$insumo->getidinsumo());
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
public function eliminarinsumo($idinsumo){
    $mensaje="";
    $Db = Db::Conectar();
    $Sql = $Db->prepare('DELETE FROM `insumos` WHERE idinsumo =:idinsumo ');
    $Sql->bindValue('idinsumo',$idinsumo);

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



}



?>