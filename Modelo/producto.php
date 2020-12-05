<?php

class Productos{
    //definicion de atributos
    private $idProducto;
    private $NombreProducto;
    private $DescripcionProducto;
    private $PrecioProducto;
    private $idEstado;
    private $NombreEstado;


    public function __construct(){

    }

    public function setidProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function getidProducto(){
        return $this ->idProducto;
    }
    
    public function setNombreProducto($NombreProducto){
        $this->NombreProducto = $NombreProducto;
    }

    public function getNombreProducto(){
        return $this ->NombreProducto;
    }
    public function setDescripcionProducto($DescripcionProducto){
        $this->DescripcionProducto = $DescripcionProducto;
    }

    public function getDescripcionProducto(){
        return $this ->DescripcionProducto;
    }

    public function setPrecioProducto($PrecioProducto){
        $this->PrecioProducto = $PrecioProducto;
    }

    public function getPrecioProducto(){
        return $this ->PrecioProducto;
    }

    public function setidEstado($idEstado){
        $this->idEstado = $idEstado;
    }

    public function getidEstado(){
        return $this ->idEstado;
    }
    public function setNombreEstado($NombreEstado){
        $this->NombreEstado = $NombreEstado;
    }

    public function getNombreEstado(){
        return $this ->NombreEstado;
    }


}


?>