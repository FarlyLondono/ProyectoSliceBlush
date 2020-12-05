<?php

class CRUDestadopedido{
    public function __construct(){}

    public function listarestadopedido(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listaestadopedido = [];
        //se define la consulta
        /*$Sql = $Db->prepare('SELECT * FROM roles WHERE idrol:idrol');
        $Sql->binValue('idrol',$idrol);*/
        $Sql = $Db->prepare('SELECT * FROM estadopedido');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Estado){
            $E = new EstadoPedido(); //crear un objeto de tipo usuario
            $E->setIdEstadoPedido($Estado['IdEstadoPedido']);
            $E->setNombreEstadoPedido($Estado['NombreEstadoPedido']);

            $listaestadopedido[]=$E;
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listaestadopedido;
    }

}


?>