<?php

class EstadoPedido{
 private $IdEstadoPedido;
 private $NombreEstadoPedido;

 public function __construct(){}

 public function setIdEstadoPedido($IdEstadoPedido){
    $this->IdEstadoPedido = $IdEstadoPedido;

}
public function getIdEstadoPedido(){
    return $this->IdEstadoPedido;
}

public function setNombreEstadoPedido($NombreEstadoPedido){
    $this->NombreEstadoPedido = $NombreEstadoPedido;

}
public function getNombreEstadoPedido(){
    return $this->NombreEstadoPedido;
}




}




?>