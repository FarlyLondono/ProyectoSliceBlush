<?php error_reporting (E_ALL ^ E_NOTICE); 
class Db{
    private static $conexion=null;
    private function __construct (){}

    public static function Conectar(){
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$conexion = new PDO('mysql: host=localhost;dbname=proyecto slice blush','root','',$pdo_options);
        return self::$conexion;
    
    }
    
    static function cerrarconexion(&$conexion){//cerrar conexion
        $conexion=null;

       
    }

}

$Db=Db::Conectar();


/*mysqli
mysql
pdo
*/


?>