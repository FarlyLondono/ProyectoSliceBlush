<?php
	

class usuarios{
    //definicion de atributos
    private $IdUsuarios;
    private $NumeroDocumento;
    private $Nombre; 
    private $Apellidos;
    private $Correo;
    private $Contrasena;
    private $idEstado;
    private $NombreEstado;
    private $IdRol;
    private $NombreRol;
    private $Existe;
    
 
    public function __construct(){

    }
    public function setIdUsuarios($IdUsuarios){
        $this->IdUsuarios = $IdUsuarios;
    }

    public function getIdUsuarios(){
        return $this ->IdUsuarios;
    }
    public function setNumeroDocumento($NumeroDocumento){
        $this->NumeroDocumento = $NumeroDocumento;
    }

    public function getNumeroDocumento(){
        return $this ->NumeroDocumento;
    }

    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }

    public function getNombre(){
        return $this ->Nombre;
    }

    public function setApellidos($Apellidos){
        $this->Apellidos = $Apellidos;
    }

    public function getApellidos(){
        return $this ->Apellidos;
    }

    public function setCorreo($Correo){
        $this->Correo = $Correo;
    }

    public function getCorreo(){
        return $this ->Correo;
    }

    public function setContrasena($Contrasena){
        $this->Contrasena = $Contrasena;
    }

    public function getContrasena(){
        return $this ->Contrasena;
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
    public function setIdRol($IdRol){
        $this->IdRol = $IdRol;
    }

    public function getIdRol(){
        return $this ->IdRol;
    }
    public function setNombreRol($NombreRol){
        $this->NombreRol = $NombreRol;
    }

    public function getNombreRol(){
        return $this ->NombreRol;
    }

    public function setExiste($Existe){
        $this->Existe = $Existe;
    }

    public function getExiste(){
        return $this ->Existe;
    }


}


