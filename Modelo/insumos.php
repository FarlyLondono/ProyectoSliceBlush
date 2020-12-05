<?php

class insumos{
private $idinsumo;
private $nombreProducto;
private $unidadmedida;
private $precio;
private $Stock;

public function __construct(){

}
public function setidinsumo($idinsumo){
    $this->idinsumo = $idinsumo;
}

public function getidinsumo(){
    return $this ->idinsumo;
}
public function setnombreProducto($nombreProducto){
    $this->nombreProducto = $nombreProducto;
}

public function getnombreProducto(){
    return $this ->nombreProducto;
}
public function setunidadmedida($unidadmedida){
    $this->unidadmedida = $unidadmedida;
}

public function getunidadmedida(){
    return $this ->unidadmedida;
}
public function setprecio($precio){
    $this->precio = $precio;
}

public function getprecio(){
    return $this ->precio;
}
public function setStock($Stock){
    $this->Stock = $Stock;
}

public function getStock(){
    return $this ->Stock;
}




}

?>