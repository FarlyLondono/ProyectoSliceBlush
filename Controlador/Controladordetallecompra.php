<?php
require_once("../Modelo/conexion.php");
require_once("../Modelo/CRUDdetallecompra.php");
require_once("../Modelo/detallecompra.php");

class controladordetallecompra{

    public function __construct(){}

    public function registrardetallecompra($idcompra){
        $detallecompra = new detallecompra();
        $cruddetallecompra = new cruddetallecompra();
        $detallecompra->setidcompra($idcompra);
        $detallecompra->setidinsumo($_POST["insumo"]);
        $detallecompra->setCantidad($_POST["cantidad"]);
        $detallecompra->setTotal($_POST["valortotal"]);
        $detallecompra->setobservaciones($_POST["observaciones"]);
        $cruddetallecompra->registrardetallecompra($detallecompra);


}

public function listardetallecompra($idcompra){
    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra();
    $listardetallecompra = $cruddetallecompra->listardetallecompra($idcompra);
    return $listardetallecompra;

}
public function verdetallecompra($idcompra){
    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra();
    return $cruddetallecompra->verdetallecompra($idcompra);

}
public function eliminardetallecompra($iddetallecompra){

    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra();           
    return $cruddetallecompra->eliminardetallecompra($iddetallecompra);


 }
 public function dropdetallecompra($idcompra){

    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra();           
    return $cruddetallecompra->dropdetallecompra($idcompra);


 }
 public function buscardetallecompra($iddetallecompra){
    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra(); 
    return $cruddetallecompra->buscardetallecompra($iddetallecompra);

}
public function editardetallecompra(){

    $detallecompra = new detallecompra();
    $cruddetallecompra = new cruddetallecompra();
    $detallecompra->setiddetallecompra($_POST["iddetallecompra"]);
    $detallecompra->setidinsumo($_POST["idinsumo"]);
    $detallecompra->setidcompra($_POST["idcompra"]);
    $detallecompra->setCantidad($_POST["Cantidad"]);
    $detallecompra->setTotal($_POST["Total"]);
    $detallecompra->setobservaciones($_POST["observaciones"]);
    
    //var_dump($Usuario);
    $cruddetallecompra->editardetallecompra($detallecompra);


}


public function despliegarVista($ruta){
    require_once($ruta);
}




}

$controladordetallecompra = new controladordetallecompra();

if(isset($_POST["Detallecompra"])){
    $controladordetallecompra->despliegarVista("../Vista/Detallecompra.php");
}elseif(isset($_GET["verdetallecompra"])){
    $controladordetallecompra->despliegarVista("../Vista/verdetallecompra.php");
}elseif(isset($_GET["eliminardetallecompra"])){
    $controladordetallecompra->eliminardetallecompra($_GET["iddetallecompra"]);
}
?>