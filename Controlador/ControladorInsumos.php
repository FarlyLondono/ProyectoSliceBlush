<?php
require_once("../Modelo/conexion.php");
require_once("../Modelo/insumos.php");
require_once("../Modelo/CRUDinsumos.php");


class ControladorInsumo{

    public function _construct(){
    }

    public function listarinsumos(){

        $insumos = new insumos();
        $crudinsumos = new crudinsumos();
        $listarinsumos = $crudinsumos->listarinsumos();
        return $listarinsumos;        
    }
    public function Registrarinsumo(){

        $insumos = new insumos();
        $crudinsumos = new crudinsumos();
        $insumos->setnombreProducto($_POST["nombreProducto"]);
        $insumos->setunidadmedida($_POST["unidadmedida"]);
        $insumos->setprecio($_POST["precio"]);
        //$insumos->setStock($_POST["Stock"]);
        
        //var_dump($producto);
        $crudinsumos->Registrarinsumo($insumos);
    
    
    }
    public function buscarinsumo($idinsumo){
        $insumos = new insumos();
        $crudinsumos = new crudinsumos();
        return $crudinsumos->buscarinsumo($idinsumo);
    
    }
    public function editarinsumo(){

        $insumos = new insumos();
        $crudinsumos = new crudinsumos();
        $insumos->setidinsumo($_POST["idinsumo"]);
        $insumos->setnombreProducto($_POST["nombreProducto"]);
        $insumos->setunidadmedida($_POST["unidadmedida"]);
        $insumos->setprecio($_POST["precio"]);
        //$insumos->setStock($_POST["Stock"]);
        
        //var_dump($Usuario);
        $crudinsumos->editarinsumo($insumos);
    
    
    }
    public function eliminarinsumo($idinsumo){

        $insumos = new insumos();
        $crudinsumos = new crudinsumos();           
        return $crudinsumos->eliminarinsumo($idinsumo);
    
    
     }




}


$ControladorInsumo = new ControladorInsumo();

if(isset($_POST["RegistrarInsumo"])){
    $ControladorInsumo->Registrarinsumo();
}elseif(isset($_POST["editarinsumo"])){
    $ControladorInsumo->editarinsumo();
}elseif(isset($_GET["eliminarinsumo"])){
    $ControladorInsumo->eliminarinsumo($_GET["idinsumo"]);
}


?>