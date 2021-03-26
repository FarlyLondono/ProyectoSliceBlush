<?php
//session_start();

$mensaje="";
require_once("../Modelo/config.php");
//require_once("../Modelo/producto.php");
//$Productos = new Productos();


if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){

        case 'Agregar':
            if(is_numeric(openssl_decrypt($_POST['idProducto'],COD,KEY))){
                $idProducto=openssl_decrypt($_POST['idProducto'],COD,KEY);
                $mensaje.="OK ID correcto".$idProducto."</br>";
            }else{

                $mensaje.="error.. ID incorrecto".$idProducto."</br>";
            }
            if(is_string( openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="OK NOMBRE correcto".$NOMBRE."</br>";
            }else{

                $mensaje.="error.. NOMBRE incorrecto".$NOMBRE."</br>";
            }
            if(is_numeric( openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $cantidad=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="OK CANTIDAD correcto".$cantidad."</br>";
            }else{

                $mensaje.="error.. CANTIDAD incorrecto".$cantidad."</br>";
            }
            if(is_numeric( openssl_decrypt($_POST['precio'],COD,KEY))){
                $precio=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="OK PRECIO correcto".$precio."</br>";
            }else{

                $mensaje.="error.. PRECIO incorrecto".$precio."</br>";
            }

            if(!isset($_SESSION['CARRITO'])){
                $producto=array(
                    'idProducto'=>$idProducto,
                    'NOMBRE'=>$NOMBRE,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio,                     
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje= "Producto agregado al carrito";


            }
            else{
                $idProductos=array_column($_SESSION['CARRITO'],"idProducto");
                if(in_array($idProducto,$idProductos)){
                    echo "<script>alert('El producto ya ha sido seleccionado..')</script>";
                    $mensaje="";
                }else{
                
                $Numeroproductos=count($_SESSION['CARRITO']);
                $producto=array(
                    'idProducto'=>$idProducto,
                    'NOMBRE'=>$NOMBRE,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio,                     
                );

                $_SESSION['CARRITO'][$Numeroproductos]=$producto;
                $mensaje= "<strong>Producto agregado al carrito</strong>";
            } 

            }

            //$mensaje= print_r($_SESSION,true);
            

        break;
<<<<<<< HEAD
            case "Eliminar":
                if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                    $ID=openssl_decrypt($_POST['id'],COD,KEY);
                    //$mensaje.="OK ID correcto".$ID."</br>";
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){
                        if($producto['idProducto']==$ID){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert('Elemento eliminado...')</script>";
                        }
=======
        case "Eliminar":
            if(is_numeric( openssl_decrypt($_POST['idProducto'],COD,KEY))){
                $ID=openssl_decrypt($_POST['idProducto'],COD,KEY);
                //$mensaje.="OK ID correcto".$ID."</br>";
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if($producto['idProducto']==$ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        //echo "<script>alert('Elemento eliminado...')</script>";
>>>>>>> 25d5c2196f0339c45f4d9b23b683cb9eb7bfa1fe
                    }
                }else{
    
                    $mensaje.="error.. ID incorrecto".$ID."</br>";
                }
        break;
    }



}


?>
