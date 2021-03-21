<?php

class Clientes{

    private $idCliente;
    private $Nombre;
    private $Correo;
    private $Direccion;
    private $Telefono;
    private $Contrasena;
    private $IdEstado;
    private $Existe;
    
    

    public function __construct(){

    }

    public function setidCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function getidCliente(){
        return $this ->idCliente;
    }
    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }

    public function getNombre(){
        return $this ->Nombre;
    }

    public function setCorreo($Correo){
        $this->Correo = $Correo;
    }

    public function getCorreo(){
        return $this ->Correo;
    }

    public function setDireccion($Direccion){
        $this->Direccion = $Direccion;
    }

    public function getDireccion(){
        return $this ->Direccion;
    }

    public function setTelefono($Telefono){
        $this->Telefono = $Telefono;
    }

    public function getTelefono(){
        return $this ->Telefono;
    }

    public function setContrasena($Contrasena){
        $this->Contrasena = $Contrasena;
    }

    public function getContrasena(){
        return $this ->Contrasena;
    }
    public function setIdEstado($IdEstado){
        $this->IdEstado = $IdEstado;
    }

    public function getIdEstado(){
        return $this ->IdEstado;
    }
    public function setExiste($Existe){
        $this->Existe = $Existe;
    }

    public function getExiste(){
        return $this ->Existe;
    }

}



?>