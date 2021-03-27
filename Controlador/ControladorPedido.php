<?php 
require_once("../Modelo/conexion.php");
require_once("../Modelo/clientes.php");
require_once("../Modelo/crudCliente.php");
require_once("../Modelo/pedido.php");
require_once("../Modelo/CRUDPedido.php");
require_once("../Modelo/producto.php");
require_once("../Modelo/CRUDproducto.php");
require_once("../Modelo/detallePedido.php");
require_once("../Modelo/CRUDdetallePedido.php");

session_start();

class ControladorPedido{

    public function _construct(){

    }

    public function listarClientes(){
        $CRUDcliente = new CRUDcliente();
        return $CRUDcliente->listarClientes();
    }
    
    public function listarProductos(){
        $CRUDproducto = new CRUDproducto();
        return $CRUDproducto->listarProductos();
    }


    public function ListarPedidos(){
        $CRUDPedido = new CRUDPedido();
        return $CRUDPedido->ListarPedidos();
    }

    public function RegistrarPedido()
    {
        $pedido = new pedido();
        $CRUDPedido = new CRUDPedido();
        $pedido->setidCliente($_POST["Cliente"]);

        return $CRUDPedido->RegistrarPedido($pedido);
    }

    public function RegistrarDetallePedido($idPedido)
    {
        $detallePedidos = new detallePedidos();
        $CRUDdetallePedido = new CRUDdetallePedido();
        $detallePedidos->setidPedido($idPedido);
        $detallePedidos->setidProducto($_POST["producto"]);
        $detallePedidos->setcantidad($_POST["cantidad"]);
        $detallePedidos->setprecio($_POST["valorDetalle"]);
        $CRUDdetallePedido->RegistrarDetallePedido($detallePedidos);
    }

    public function ListarDetallePedido($idPedido){
        $CRUDdetallePedido = new CRUDdetallePedido();
        $Lista = $CRUDdetallePedido->ListarDetallePedido($idPedido);
        return $Lista;
    }

    public function buscarPedido($idPedido){
        $Pedido = new Pedido();
        $CRUDPedido = new CRUDPedido();
        return $CRUDPedido->buscarPedido($idPedido);

    }

    public function buscaridcliente($Correo){
        $crudCliente = new crudCliente(); 
        return $crudCliente->buscaridcliente($Correo);
    
    }

    public function editarPedido(){

            $Pedido = new Pedido();
            $CRUDPedido = new CRUDPedido();
            $Pedido->setidPedido($_POST["idPedido"]);
            $Pedido->setidCliente($_POST["idCliente"]);
            $Pedido->setfechaRegistro($_POST["fechaRegistro"]);
            $Pedido->setIdEstadoPedido($_POST["IdEstadoPedido"]);
        
            $CRUDPedido->editarPedido($Pedido);
    
    
        }

        public function eliminarDetallePedido($idDetallePedido){

            $detallePedidos = new detallePedidos();
            $CRUDdetallePedido = new CRUDdetallePedido(); 
         return $CRUDdetallePedido->eliminarDetallePedido($idDetallePedido);
        
        
            }

        public function eliminarPedido($idPedido){

            $Pedido = new Pedido();
            $CRUDPedido = new CRUDPedido();
            $CRUDPedido->eliminarPedido($idPedido);
            
            
    }
    
   public function verdetallepedido($idPedido){
    $detallePedidos = new detallePedidos();
    $CRUDdetallePedido = new CRUDdetallePedido();
    return $CRUDdetallePedido->verdetallepedido($idPedido);
      
                
    }
    public function buscardetallepedido($idDetallePedido){
        $detallePedidos = new detallePedidos();
        $CRUDdetallePedido = new CRUDdetallePedido(); 
        return $CRUDdetallePedido->buscardetallepedido($idDetallePedido);
    
    }

    public function editardetallepedido(){

        $detallePedidos = new detallePedidos();
        $CRUDdetallePedido = new CRUDdetallePedido();
        $detallePedidos->setidDetallePedido($_POST["idDetallePedido"]);
        $detallePedidos->setidPedido($_POST["idPedido"]);
        $detallePedidos->setidProducto($_POST["idProducto"]);
        $detallePedidos->setcantidad($_POST["cantidad"]);
        $detallePedidos->setprecio($_POST["valorDetalle"]);
        
        //var_dump($Usuario);
        $CRUDdetallePedido->editardetallepedido($detallePedidos);
    
    
    }

    public function dropdetallepedido($idPedido){

    $detallePedidos = new detallePedidos();
    $CRUDdetallePedido = new CRUDdetallePedido();          
    return $CRUDdetallePedido->dropdetallepedido($idPedido);


    }

    public function RegistrarPedidoCarrito()
    {
     $pedido = new pedido();
     $CRUDPedido = new CRUDPedido();
     $pedido->setidCliente($_POST["Cliente"]);

     return $CRUDPedido->RegistrarPedidoCarrito($pedido);
    }

    public function RegistrarDetallePedidoCarrito($idPedido)
    {
        
        $detallePedidos = new detallePedidos();
        $CRUDdetallePedido = new CRUDdetallePedido();
        $detallePedidos->setidPedido($idPedido);
        //
        foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $detallePedidos->setidProducto($producto["idProducto"]);
        $detallePedidos->setcantidad($producto["cantidad"]);
        $detallePedidos->setprecio($producto["precio"]);
        $CRUDdetallePedido->RegistrarDetallePedidoCarrito($detallePedidos);
        }
        $_SESSION['CARRITO'] = [];
    }



    public function DesplegarVista($url){
        require_once($url);
    }
    public function despliegarVista($ruta){
        header('Location: '.$ruta);
    }
    public function despliegarVista2($ruta){
        require_once($ruta);
    }

}

$ControladorPedido = new ControladorPedido();

if(isset($_GET["listarPedidos"])){
    $ControladorPedido->DesplegarVista("../Vista/ListarPedidos.php");
}
elseif(isset($_GET["RegistrarPedido"])){
    $ControladorPedido->despliegarVista("../Vista/RegistrarPedido.php");
} 
elseif(isset($_POST["RegistrarPedido"])){
    $idPedido = $_POST["idPedido"];
    if($idPedido==""){
        $idPedido= $ControladorPedido->RegistrarPedido();
    }
    echo $idPedido;
    $ControladorPedido->RegistrarDetallePedido($idPedido);
}
elseif(isset($_POST["ListarDetallePedido"])){
    $ControladorPedido->DesplegarVista("../Vista/ListarDetallePedido.php");
}
elseif(isset($_GET["verdetallepedido"])){

    $ControladorPedido->DesplegarVista("../Vista/verdetallepedido.php");

}
elseif(isset($_GET["editarPedido"])){
    //redireccionar hacia una pagina(vista)
    $ControladorPedido->DesplegarVista("../Vista/editarPedido.php");
}
elseif(isset($_GET["eliminarPedido"])){
    $ControladorPedido->eliminarPedido($_GET["idPedido"]);
    $ControladorPedido->dropdetallepedido($_GET["idPedido"]);  
}    
elseif(isset($_POST["editarPedido"])){
    //redireccionar hacia una pagina(vista)
    $ControladorPedido->editarPedido();
    $ControladorPedido->despliegarVista("../menu.php");
}elseif(isset($_GET["eliminarDetallePedido"])){
  $ControladorPedido->eliminarDetallePedido($_GET["idDetallePedido"]);
}elseif(isset($_POST["proceder"])){
    $idPedido = $_POST["idPedido"];
    if($idPedido==""){
        $idPedido= $ControladorPedido->RegistrarPedidoCarrito();
    }   
    $ControladorPedido->RegistrarDetallePedidoCarrito($idPedido);


}
?>

