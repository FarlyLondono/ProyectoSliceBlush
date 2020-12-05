<?php

class detallecompra{

private $iddetallecompra;
private $idinsumo;
private $precio;
private $nombreProducto;
private $idcompra;
private $Cantidad;
private $Total;
private $observaciones;


public function __construct(){

}
public function setiddetallecompra($iddetallecompra){
    $this->iddetallecompra = $iddetallecompra;
}
public function getiddetallecompra(){
    return $this->iddetallecompra;
}
public function setidinsumo($idinsumo){
    $this->idinsumo = $idinsumo;
}
public function getidinsumo(){
    return $this->idinsumo;
}
public function setprecio($precio){
    $this->precio = $precio;
}
public function getprecio(){
    return $this->precio;
}
public function setnombreProducto($nombreProducto){
    $this->nombreProducto = $nombreProducto;
}
public function getnombreProducto(){
    return $this->nombreProducto;
}
public function setidcompra($idcompra){
    $this->idcompra = $idcompra;
}
public function getidcompra(){
    return $this->idcompra;
}
public function setCantidad($Cantidad){
    $this->Cantidad = $Cantidad;
}
public function getCantidad(){
    return $this->Cantidad;
}
public function setTotal($Total){
    $this->Total = $Total;
}
public function getTotal(){
    return $this->Total;
}
public function setobservaciones($observaciones){
    $this->observaciones = $observaciones;
}
public function getobservaciones(){
    return $this->observaciones;
}







}


?>