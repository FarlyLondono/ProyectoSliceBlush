<?php

class CRUDestado{
    public function __construct(){}

    public function listarestados(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listaestado = [];
        //se define la consulta
        /*$Sql = $Db->prepare('SELECT * FROM roles WHERE idrol:idrol');
        $Sql->binValue('idrol',$idrol);*/
        $Sql = $Db->prepare('SELECT * FROM estado');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Estado){
            $E = new Estado(); //crear un objeto de tipo usuario
            $E->setIdEstado($Estado['IdEstado']);
            $E->setNombreEstado($Estado['NombreEstado']);

            $listaestado[]=$E;
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listaestado;
    }

}


?>