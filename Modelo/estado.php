<?php

class Estado{
 private $IdEstado;
 private $NombreEstado;

 public function __construct(){}

 public function setIdEstado($IdEstado){
    $this->IdEstado = $IdEstado;

}
public function getIdEstado(){
    return $this->IdEstado;
}

public function setNombreEstado($NombreEstado){
    $this->NombreEstado = $NombreEstado;

}
public function getNombreEstado(){
    return $this->NombreEstado;
}




}




?>