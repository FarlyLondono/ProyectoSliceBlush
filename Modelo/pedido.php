<?php 
class Pedido{
    private $idPedido;
    private $idCliente;
    private $fechaRegistro;
    private $IdEstadoPedido;
    private $NombreEstadoPedido;
    private $TotalPedido;


    public function _construct(){

    }

    public function setidPedido($idPedido){
        $this->idPedido=$idPedido;   
    }

    public function getidPedido(){
       return $this->idPedido;
    }

    public function setidCliente($idCliente){
        $this->idCliente=$idCliente;   
    }

    public function getidCliente(){
       return $this->idCliente;
    }

    public function setfechaRegistro($fechaRegistro){
        $this->fechaRegistro=$fechaRegistro;   
    }

    public function getfechaRegistro(){
       return $this->fechaRegistro;
    }

    public function setIdEstadoPedido($IdEstadoPedido){
        $this->IdEstadoPedido = $IdEstadoPedido;
    }

    public function getIdEstadoPedido(){
        return $this ->IdEstadoPedido;
    }
    public function setNombreEstadoPedido($NombreEstadoPedido){
        $this->NombreEstadoPedido = $NombreEstadoPedido;
    }

    public function getNombreEstadoPedido(){
        return $this ->NombreEstadoPedido;
    }
    public function setTotalPedido($TotalPedido){
        $this->TotalPedido = $TotalPedido;
    }

    public function getTotalPedido(){
        return $this ->TotalPedido;
    }
    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }

    public function getNombre(){
        return $this ->Nombre;
    }

}
 

?>