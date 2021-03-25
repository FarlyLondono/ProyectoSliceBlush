<?php
require_once("../Modelo/conexion.php");
require_once("../Modelo/crudCliente.php");
require_once("../Modelo/clientes.php");
require_once("../Modelo/producto.php");
require_once("../Modelo/CRUDproducto.php");
require_once("../Modelo/rol.php");
require_once("../Modelo/crudrol.php");
require_once("../Modelo/estado.php");
require_once("../Modelo/CRUDestado.php");
require_once("../Modelo/Usuarios.php");
require_once("../Modelo/CRUDusuarios.php");
require_once("../Modelo/EstadoPedido.php");
require_once("../Modelo/CRUDestadopedido.php");





class controlador{

public function __construct(){}

public function listarRoles(){

    $Rol = new Rol();
    $CRUDrol = new CRUDrol();
    $listarRoles = $CRUDrol->listarRoles();

    return $listarRoles;

}
public function listarestados(){

    $Estado = new Estado();
    $CRUDestado = new CRUDestado();
    $listarestados = $CRUDestado->listarestados();

    return $listarestados;

}
public function listarestadopedido(){

    $EstadoPedido = new EstadoPedido();
    $CRUDestadopedido = new CRUDestadopedido();
    $listarestadospedido = $CRUDestadopedido->listarestadopedido();

    return $listarestadospedido;

}
public function listarUsuarios(){

    $Usuarios = new Usuarios();
    $CRUDusuario = new CRUDusuario();
    $listarUsuarios = $CRUDusuario->listarUsuarios();

    return $listarUsuarios;

}


public function RegistrarUsuario(){
    $salt = md5($_POST["Contrasena"]);
    $passwordencriptada = crypt($_POST["Contrasena"],$salt);

    $Usuarios = new Usuarios();
    $CRUDusuario = new CRUDusuario();
    $Usuarios->setNumeroDocumento($_POST["NumeroDocumento"]);
    $Usuarios->setNombre($_POST["Nombre"]);
    $Usuarios->setApellidos($_POST["Apellidos"]);
    $Usuarios->setCorreo($_POST["Correo"]);
    $Usuarios->setContrasena($passwordencriptada);
    $Usuarios->setIdEstado($_POST["IdEstado"]);
    $Usuarios->setIdRol($_POST["IdRol"]);
    
        //var_dump($Usuario);
    $CRUDusuario->RegistrarUsuario($Usuarios);
}

public function buscarusuario($IdUsuarios){
    $Usuarios = new Usuarios();
    $CRUDusuario = new CRUDusuario();
    return $CRUDusuario->buscarusuario($IdUsuarios);

}

public function editarusuario(){
    $salt = md5($_POST["Contrasena"]);
    $passwordencriptada = crypt($_POST["Contrasena"],$salt);
    $Usuarios = new Usuarios();
    $CRUDusuario = new CRUDusuario();
        $Usuarios->setIdUsuarios($_POST["IdUsuarios"]);
        $Usuarios->setNumeroDocumento($_POST["NumeroDocumento"]);
        $Usuarios->setNombre($_POST["Nombre"]);
        $Usuarios->setApellidos($_POST["Apellidos"]);
        $Usuarios->setCorreo($_POST["Correo"]);
        $Usuarios->setContrasena($passwordencriptada);
        $Usuarios->setIdEstado($_POST["IdEstado"]);
        $Usuarios->setIdRol($_POST["IdRol"]);
    
        
    var_dump($Usuarios);
    $CRUDusuario->editarusuario($Usuarios);


    }

public function eliminarUsuario($IdUsuarios){

    $Usuarios = new Usuarios();
    $CRUDusuario = new CRUDusuario();
    return $CRUDusuario->eliminarUsuario($IdUsuarios);
    

    }

public function listarClientes(){

    $Cliente = new Clientes();
    $CRUDcliente = new CRUDcliente();
    $listarClientes = $CRUDcliente->listarClientes();

    return $listarClientes;

}



public function registrarCliente(){    

    $salt = md5($_POST["Contrasena"]);
    $passwordencriptada = crypt($_POST["Contrasena"],$salt);
    

    $Clientes = new Clientes();
    $CRUDcliente = new CRUDcliente();
    $Clientes->setNombre($_POST["Nombre"]);
    $Clientes->setCorreo($_POST["Correo"]);
    $Clientes->setDireccion($_POST["Direccion"]);
    $Clientes->setTelefono($_POST["Telefono"]);
    $Clientes->setContrasena($passwordencriptada);
    
        //var_dump($Usuario);
    $CRUDcliente->registrarCliente($Clientes);
}




    public function editarCliente(){

        $salt = md5($_POST["Contrasena"]);
        $passwordencriptada = crypt($_POST["Contrasena"],$salt);

    $Clientes = new Clientes();
    $CRUDcliente = new CRUDcliente();
    $Clientes->setidCliente($_POST["idCliente"]);
        $Clientes->setNombre($_POST["Nombre"]);
        $Clientes->setCorreo($_POST["Correo"]);
        $Clientes->setDireccion($_POST["Direccion"]);
        $Clientes->setTelefono($_POST["Telefono"]);
        $Clientes->setContrasena($passwordencriptada);
    
        
            //var_dump($Usuario);
    $CRUDcliente->editarCliente($Clientes);


    }


    public function eliminarCliente($idCliente){

        $Clientes = new Clientes();
        $CRUDcliente = new CRUDcliente();
        return $CRUDcliente->eliminarCliente($idCliente);
        
    
        }

        public function registrarProducto(){

            $Productos = new Productos();
            $CRUDproducto = new CRUDproducto();
            $Productos->setNombreProducto($_POST["NombreProducto"]);
            $Productos->setDescripcionProducto($_POST["DescripcionProducto"]);
            $Productos->setPrecioProducto($_POST["PrecioProducto"]);
            $Productos->setidEstado($_POST["idEstado"]);
            
                //var_dump($Usuario);
            $CRUDproducto->registrarProducto($Productos);
        
        
            }

    public function buscarCliente($idCliente){
        $Clientes = new Clientes();
        $CRUDcliente = new CRUDcliente();
        return $CRUDcliente->buscarCliente($idCliente);

    }
    public function buscarProducto($idProducto){
        $Productos = new Productos();
        $CRUDproducto = new CRUDproducto();
        return $CRUDproducto->buscarProducto($idProducto);

    }

    public function eliminarProducto($idProductos){

        $Productos = new Productos();
        $CRUDproducto = new CRUDproducto(); 
       return $CRUDproducto->eliminarProducto($idProductos);
    
    
        }

        public function editarProducto(){

            $Productos = new Productos();
            $CRUDproducto = new CRUDproducto(); 
                $Productos->setidProducto($_POST["idProducto"]);
                $Productos->setNombreProducto($_POST["NombreProducto"]);
                $Productos->setDescripcionProducto($_POST["DescripcionProducto"]);
                $Productos->setPrecioProducto($_POST["PrecioProducto"]);
                $Productos->setidEstado($_POST["idEstado"]);
            
                
                    //var_dump($Usuario);
            $CRUDproducto->editarProducto($Productos);
        
        
            }
    
    public function listarProductos(){ 

        $Productos = new Productos();
        $CRUDproducto = new CRUDproducto();
        $listarProductos = $CRUDproducto-> listarProductos();
    
        return $listarProductos;
    
        }


    

}

$controlador = new controlador();


if(isset($_GET["eliminarCliente"])){
    $controlador->eliminarCliente($_GET["idCliente"]);
}
elseif(isset($_GET["eliminarProducto"])){
    $controlador->eliminarProducto($_GET["idProducto"]);
}
elseif(isset($_GET["eliminarUsuario"])){
    $controlador->eliminarUsuario($_GET["IdUsuarios"]);
}elseif(isset($_POST["editarUsuario"])){
    //$controlador->editarusuario();
    //desplegarVista("../menu.php");
}
