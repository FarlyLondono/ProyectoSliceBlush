<?php

class Estado{
 private $idEstado;
 private $NombreEstado;

 public function __construct(){}

 public function setidEstado($idEstado){
    $this->idEstado = $idEstado;

}
public function getidEstado(){
    return $this->idEstado;
}

public function setNombreEstado($NombreEstado){
    $this->NombreEstado = $NombreEstado;

}
public function getNombreEstado(){
    return $this->NombreEstado;
}




}




?>