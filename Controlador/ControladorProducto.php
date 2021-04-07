<?php
require_once("../Modelo/conexion.php");
require_once("../Modelo/CRUDdetalleproducto.php");
require_once("../Modelo/detalleproducto.php");

class controladordetalleproducto{

    public function __construct(){}

    public function listardetalleproducto($idProducto){
        $detalleproducto = new detalleproducto();
        $cruddetalleproducto = new cruddetalleproducto();
        $listardetalleproducto = $cruddetalleproducto->listardetalleproducto($idProducto);
        return $listardetalleproducto;
    
    }
    
    public function verdetalleproducto($idProducto){
        $detalleproducto = new detalleproducto();
        $cruddetalleproducto = new cruddetalleproducto();
        return $cruddetalleproducto->verdetalleproducto($idProducto);
    
    }
  


public function despliegarVista($ruta){
    require_once($ruta);
}


}




$controladordetalleproducto = new controladordetalleproducto();

if(isset($_POST["Detalleproducto"])){
    $controladordetalleproducto->despliegarVista("../Vista/Detalleproducto.php");
}
elseif(isset($_GET["verdetalleproducto"])){
    $controladordetalleproducto->despliegarVista("../Vista/verdetalleproducto.php");
}


?>