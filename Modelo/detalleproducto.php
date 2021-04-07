<?php
						
class detalleproducto{
    
    private $iddetalleproducto;
    private $idProducto;
    private $idinsumo;
    private $NombreInsumo;
    private $cantidad;
    private $unidadMedida;
   
    public function _construct(){

    }

    public function setiddetalleproducto($iddetalleproducto){
        $this->iddetalleproducto = $iddetalleproducto;   
    }

    public function getiddetalleproducto(){
       return $this->iddetalleproducto;
    }
    public function setidProducto($idProducto){
        $this->idProducto = $idProducto;
    }
    public function getidProducto(){
        return $this ->idProducto;
    }
    public function setidinsumo($idinsumo){
        $this->idinsumo = $idinsumo;   
    }
    public function getidinsumo(){
       return $this->idinsumo;
    } 
    public function setNombreInsumo($NombreInsumo){
        $this->NombreInsumo = $NombreInsumo;
    }
    public function getNombreInsumo(){
        return $this ->NombreInsumo;
    }
    public function setcantidad($cantidad){
        $this->cantidad=$cantidad;   
    }
    public function getcantidad(){
       return $this->cantidad;
    }
    public function setunidadMedida($unidadMedida){
        $this->unidadMedida = $unidadMedida;
    }
    public function getunidadMedida(){
        return $this->unidadMedida;
    }

}


?>