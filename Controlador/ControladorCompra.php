<?php 
require_once("../Modelo/conexion.php");
require_once("../Modelo/Compras.php");
require_once("../Modelo/CRUDcompras.php");
require_once("../Controlador/Controladordetallecompra.php");

class ControladorCompra{

    public function _construct(){
    }

    public function listarcompras(){
        $compras=new compras();
        $crudcompras = new crudcompras();
        $listarcompras = $crudcompras->listarcompras();
        return $listarcompras; 
    }

    public function registrarcompra(){
        $compras=new compras();
        $crudcompras = new crudcompras();
        $compras->setIdUsuarios($_POST["usuario"]);
        $compras->setproveedor($_POST["proveedor"]);
        $compras->setnumerofactura($_POST["numerofactura"]);
        return $crudcompras->registrarcompra($compras);
    }

    public function eliminarcompra($idcompra){

        $compras=new compras();
        $crudcompras = new crudcompras();           
        return $crudcompras->eliminarcompra($idcompra);
    
    
     }
     public function buscarcompra($idcompra){
        $compras=new compras();
        $crudcompras = new crudcompras();  
        return $crudcompras->buscarcompra($idcompra);

    }
    public function editarcompra(){

        $compras=new compras();
        $crudcompras = new crudcompras();
        $compras->setidcompra($_POST["idcompra"]);
        $compras->setIdUsuarios($_POST["IdUsuarios"]);
        $compras->setproveedor($_POST["proveedor"]);
        $compras->setnumerofactura($_POST["numerofactura"]);
        $compras->setfechacompra($_POST["fechacompra"]);
        
        //var_dump($Usuario);
        $crudcompras->editarcompra($compras);
    
    
    }



}

$ControladorCompra = new ControladorCompra();
$Controladordetallecompra = new controladordetallecompra();


if(isset($_GET["registrarcompra"])){
    $controlador->despliegarVista("../Vista/registrarcompra.php");
}elseif(isset($_POST["registrarcompra"])){
    $idcompra = $_POST["idcompra"];
    if($idcompra==""){
        $idcompra = $ControladorCompra->registrarcompra();
    }
    echo $idcompra;
    $Controladordetallecompra->registrardetallecompra($idcompra);

}elseif(isset($_GET["eliminarcompra"])){
    $ControladorCompra->eliminarcompra($_GET["idcompra"]);
    $Controladordetallecompra->dropdetallecompra($_GET["idcompra"]); 
}




?>