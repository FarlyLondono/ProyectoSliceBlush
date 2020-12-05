<?php

class compras{

private $idcompra;
private $IdUsuarios;
private $Nombre;
private $proveedor;
private $numerofactura;
private $fechacompra;
private $Total;


public function __construct(){

}
public function setidcompra($idcompra){
    $this->idcompra = $idcompra;
}

public function getidcompra(){
    return $this ->idcompra;
}
public function setIdUsuarios($IdUsuarios){
    $this->IdUsuarios = $IdUsuarios;
}
public function getIdUsuarios(){
    return $this->IdUsuarios;
}
public function setNombre($Nombre){
    $this->Nombre = $Nombre;
}
public function getNombre(){
    return $this->Nombre;
}

public function setproveedor($proveedor){
    $this->proveedor = $proveedor;
}

public function getproveedor(){
    return $this ->proveedor;
}
public function setnumerofactura($numerofactura){
    $this->numerofactura = $numerofactura;
}

public function getnumerofactura(){
    return $this ->numerofactura;
}
public function setfechacompra($fechacompra){
    $this->fechacompra = $fechacompra;
}
public function getfechacompra(){
    return $this->fechacompra;
}
public function setTotal($Total){
    $this->Total = $Total;
}
public function getTotal(){
    return $this->Total;
}



}


?>