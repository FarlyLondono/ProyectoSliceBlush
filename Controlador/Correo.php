<?php
require_once("../Controlador/controlador.php");
$crudcliente = new CRUDcliente();
if(isset($_POST['recuperarContra'])){
    if(!empty($_POST['Correo'])){
    $Correo = $_POST['Correo'];
    $NombreCorreo = $crudcliente->buscarCorreoCliente($Correo);
        if ($NombreCorreo == 1){
            $Contrasena = $crudcliente->buscarContrasena($Correo);
            if($Contrasena <> ""){
                $para = $Correo;
                $titulo = 'recuperacion contra';
                $mensaje = base64_decode($Contrasena);
                $cabeceras = 'From: sliceblushtest@gmail.com' . "\r\n" .
                         'Reply-To: sliceblushtest@gmail.com' . "\r\n" .
                         'X-Mailer: PHP/' . phpversion();
                         
                ini_set("SMTP","smtp.gmail.com");         
                ini_set('sendmail_from','SliceBlushTest@gmail.com');
                mail($para,$titulo,$mensaje,$cabeceras);
                echo "Realizado";
            }else{
                echo "Ha ocurrido un error!"; 
                "<script src='https://code.jquery.com/jquery-3.5.1.js'></script>";
    "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>";
    echo "<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Problemas...'
    });
    </script>";
            }
        }else{
            echo "<h2>Este correo NO se ha registrado!</h2>";
            "<script src='https://code.jquery.com/jquery-3.5.1.js'></script>";
    "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>";
    echo "<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Problemas...'
    });
    </script>";
        }
    }
}

?>