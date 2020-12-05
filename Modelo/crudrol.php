<?php
class CRUDrol{
    public function __construct(){}

    public function listarRoles(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listaRoles = [];
        //se define la consulta
        /*$Sql = $Db->prepare('SELECT * FROM roles WHERE idrol:idrol');
        $Sql->binValue('idrol',$idrol);*/
        $Sql = $Db->prepare('SELECT * FROM rol');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Roles){
            $R = new Rol(); //crear un objeto de tipo usuario
            $R->setIdRol($Roles['IdRol']);
            $R->setNombreRol($Roles['NombreRol']);

            $listaRoles[]=$R;
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listaRoles;
    }

}

?>