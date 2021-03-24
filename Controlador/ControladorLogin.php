<?php
require_once("../Modelo/conexion.php"); //Incluir la conexion
require_once("../Modelo/Usuarios.php");
require_once("../Modelo/CRUDusuarios.php");
require_once("../Modelo/clientes.php");
require_once("../Modelo/crudCliente.php");




class controladorlogin{



/*public function VerificarLogin($Correo,$Contrasena){
        $Clientes = new Clientes();
        $CRUDcliente = new CRUDcliente();
        $Clientes->setCorreo($Correo);
        $Clientes->setContrasena($Contrasena);
        $Clientes=$CRUDcliente->VerificarLogin($Clientes);
        
        if($Clientes->getExiste() == 1)
        {
            session_start();
            $_SESSION["idCliente"] = $Clientes->getidCliente();
            $_SESSION["Nombre"] = $Clientes->getNombre();

            header("Location:../menu.php");
        }
        else{
            header("Location:../index.php");
        }

    }
    */

    public function VerificarLogin($Correo,$Contrasena){

        //$salt = md5($Contrasena);
        //$password = crypt($Contrasena,$salt);

        //From Usuario
        $Usuario = new Usuarios();
        $CRUDUsuario = new CRUDusuario();
        $Usuario->setCorreo($Correo);
        $Usuario->setContrasena($Contrasena);
        $Usuario = $CRUDUsuario->VerificarLogin($Usuario);
        //From Cliente
        $Cliente = new Clientes();
        $CRUDCliente = new CRUDcliente();
        $Cliente->setCorreo($Correo);
        $Cliente->setContrasena($Contrasena);
        $Cliente = $CRUDCliente->VerificarLogin($Cliente);

          if($Usuario->getExiste()==1){
             //VARIABLES DE SESION
              session_start();
              //DEFINIR VARIABLES DE SESION
              $_SESSION["IdUsuarios"] = $Usuario->getIdUsuarios();
              $_SESSION["Nombre"] = $Usuario->getNombre();
              $_SESSION["Correo"] = $Usuario->getCorreo();
              $_SESSION["IdRol"] = $Usuario->getIdRol();

              header("Location:../menu.php");
          }
          elseif($Cliente->getExiste()==1){
              //VARIABLES DE SESION
               session_start();
               //DEFINIR VARIABLES DE SESION
               $_SESSION["idCliente"] = $Cliente->getidCliente();
               $_SESSION["Nombre"] = $Cliente->getNombre();
               $_SESSION["Correo"] = $Cliente->getCorreo();
               $_SESSION["IdRol"] = 0;
               header("Location:../menu.php");
           }
          else
          {
              ?>
              <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
              <script type="text/javascript">
              $(document).ready(function() {
                  Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: 'Usuario o Contraseña Incorrectas!!!',
                  showConfirButton: false,
                  timer: 2000
              }).then(function() {
                  window.location.href = "../index.php";
              })});
              </script>
              <?php
          }

  }

  public function DesplegarVista($ruta){
      require_once($ruta);
  }
  
}

$ControladorLogin = new controladorlogin();

if(isset($_POST["Acceder"])){
  $ControladorLogin->VerificarLogin($_POST["Correo"],$_POST["Contrasena"]);
}
if(isset($_POST["Registrarse"])){
  $ControladorLogin->DesplegarVista("../Vista/RegistrarCliente.php");
}

?>