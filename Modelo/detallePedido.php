<?php 
class detallePedidos{
    private $idDetallePedido;
    private $idPedido;
    private $PrecioProducto;
    private $idProducto;
    private $NombreProducto;
    private $cantidad;
    private $precio;

    public function _construct(){

    }

    public function setidDetallePedido($idDetallePedido){
        $this->idDetallePedido = $idDetallePedido;   
    }

    public function getidDetallePedido(){
       return $this->idDetallePedido;
    }

    public function setidPedido($idPedido){
        $this->idPedido = $idPedido;   
    }

    public function getidPedido(){
       return $this->idPedido;
    }
    public function setPrecioProducto($PrecioProducto){
        $this->PrecioProducto = $PrecioProducto;   
    }

    public function getPrecioProducto(){
       return $this->PrecioProducto;
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

    public function setcantidad($cantidad){
        $this->cantidad=$cantidad;   
    }

    public function getcantidad(){
       return $this->cantidad;
    }

    public function setprecio($precio){
        $this->precio = $precio;
    }

    public function getprecio(){
        return $this->precio;
    }

}


?>