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
    

    public function eliminardetalleproducto($iddetalleproducto){

        $detalleproducto = new detalleproducto();
        $cruddetalleproducto = new cruddetalleproducto(); 
       return $cruddetalleproducto->eliminardetalleproducto($iddetalleproducto);
    
        }

        public function RegistrarDetalleProducto(){

            $detalleproducto = new detalleproducto();
            $cruddetalleproducto = new cruddetalleproducto();
            $detalleproducto->setiddetalleproducto($_POST["iddetalleproducto"]);
            $detalleproducto->setidinsumo($_POST["idinsumo"]);
            $detalleproducto->setidProducto($_POST["idProducto"]);
            $detalleproducto->setunidadMedida($_POST["unidadMedida"]);
            $detalleproducto->setcantidad($_POST["cantidad"]);
            
            //var_dump($Usuario);
            $cruddetalleproducto->RegistrarDetalleProducto($detalleproducto);
        
        
        }

        public function editardetalleproducto(){

            $detalleproducto = new detalleproducto();
            $cruddetalleproducto = new cruddetalleproducto();
            $detalleproducto->setiddetalleproducto($_POST["iddetalleproducto"]);
            $detalleproducto->setidinsumo($_POST["idinsumo"]);
            $detalleproducto->setidProducto($_POST["idProducto"]);
            $detalleproducto->setunidadMedida($_POST["unidadMedida"]);
            $detalleproducto->setcantidad($_POST["cantidad"]);
            
            //var_dump($Usuario);
            $cruddetalleproducto->editardetalleproducto($detalleproducto);
        
        
        }

    public function verdetalleproducto($idProducto){
        $detalleproducto = new detalleproducto();
        $cruddetalleproducto = new cruddetalleproducto();
        return $cruddetalleproducto->verdetalleproducto($idProducto);
    
    }

    public function buscardetalleproducto($iddetalleproducto){
        $detalleproducto = new detalleproducto();
        $cruddetalleproducto = new cruddetalleproducto();
        return $cruddetalleproducto->buscardetalleproducto($iddetalleproducto);
    
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
}elseif(isset($_GET["eliminardetalleproducto"])){
    $controladordetalleproducto->eliminardetalleproducto($_GET["iddetalleproducto"]);
  }


?>