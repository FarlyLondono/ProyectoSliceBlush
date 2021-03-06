<?php

class CRUDcliente{
    
    public function __construct(){}


    public function cambiarEstadoC($Cliente){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE clientes SET
        idEstado=:idEstado     
        WHERE idCliente=:idCliente');
        $Sql->bindValue('idEstado',$Cliente->getidEstado());
        $Sql->bindValue('idCliente',$Cliente->getidCliente());
        
         
         

        try{

            $Sql->execute();
            //echo "Actualizacion exitosa";
        }
        catch(Exception $e){
            //echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);
    }



    public function VerificarLogin($Clientes)
    {
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM clientes
        WHERE Correo=:Correo AND
        Contrasena=:Contrasena');
          $Sql->bindValue('Correo',$Clientes->getCorreo());
          $Sql->bindValue('Contrasena',$Clientes->getContrasena());

          
          $Sql->execute();
          $C = new Clientes();
          if($Sql->rowCount()>0)
          {
              $DatosCliente = $Sql->fetch();
              $C->setidCliente($DatosCliente['idCliente']);
              $C->setNombre($DatosCliente['Nombre']);
              $C->setCorreo($DatosCliente['Correo']);
              $C->setidEstado($DatosCliente['idEstado']);
              $C->setExiste(1);
          }
          else{
              $C->setExiste(0);
          }
          Db::cerrarconexion($Db);
          return $C;
        }


    public function listarClientes(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listarClientes = [];
        //se define la consulta
        $Sql = $Db->query('SELECT f.idEstado,f.idCliente,f.Nombre,f.Correo,f.Direccion,f.Telefono,e.idEstado,e.NombreEstado FROM clientes AS f INNER JOIN estado AS e ON f.idEstado=e.idEstado');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $cliente){
            $C = new Clientes(); //crear un objeto de tipo usuario
            $C->setidCliente($cliente['idCliente']);
            $C->setNombre($cliente['Nombre']);
            $C->setCorreo($cliente['Correo']);
            $C->setDireccion($cliente['Direccion']);
            $C->setTelefono($cliente['Telefono']);
            $C->setContrasena($cliente['Contrasena']);
            $C->setidEstado($cliente['idEstado']);
            $C->setNombreEstado($cliente['NombreEstado']);
            
          
            /*echo "<p>".$Usuario['idUsuarios']."</p>";
            echo "<p>".$Usuario['tipodocumento']."</p>";*/

            $listarClientes[]= $C;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listarClientes;//retornar el array de objetos.
    }

  

    public function registrarCliente($Clientes){


            

        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO clientes(Nombre,Correo,Direccion,Telefono,Contrasena,idEstado)
         VALUES(:Nombre,:Correo,:Direccion,:Telefono,:Contrasena,:idEstado)');
        $Sql->bindValue('Nombre',$Clientes->getNombre());
        $Sql->bindValue('Correo',$Clientes->getCorreo());
        $Sql->bindValue('Direccion',$Clientes->getDireccion());
        $Sql->bindValue('Telefono',$Clientes->getTelefono());
        $Sql->bindValue('Contrasena',$Clientes->getContrasena());
        $Sql->bindValue('idEstado',$Clientes->getidEstado());

        //var_dump($Usuario);

        try{

            $Sql->execute();
            
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    }

    public function editarCliente($Clientes){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE clientes SET
        Nombre=:Nombre,
        Correo=:Correo,
        Direccion=:Direccion,
        Telefono=:Telefono,
        Contrasena=:Contrasena
        WHERE idCliente=:idCliente');
        $Sql->bindValue('Nombre',$Clientes->getNombre());
        $Sql->bindValue('Correo',$Clientes->getCorreo());
        $Sql->bindValue('Direccion',$Clientes->getDireccion());
        $Sql->bindValue('Telefono',$Clientes->getTelefono());
        $Sql->bindValue('Contrasena',$Clientes->getContrasena());
        $Sql->bindValue('idCliente',$Clientes->getidCliente());
        
        
        //var_dump($Sql);
        //var_dump($Usuario);

        try{

            $Sql->execute();
            echo "Actualizacion exitosa";
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    }

  
    public function buscarCliente($idCliente){
        //conectar ala DB
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM clientes WHERE idCliente=:idCliente');
        $Sql->bindValue(':idCliente',$idCliente);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Cliente){
            $passwordesencriptada = base64_decode($Cliente['Contrasena']); 
            $C = new Clientes(); //crear un objeto de tipo cliente
            $C->setidCliente($Cliente['idCliente']);
            $C->setNombre($Cliente['Nombre']);
            $C->setCorreo($Cliente['Correo']);
            $C->setDireccion($Cliente['Direccion']);
            $C->setTelefono($Cliente['Telefono']);
            $C->setContrasena($passwordesencriptada);
            $C->setidEstado($Cliente['idEstado']);
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $C;


    }


    public function buscaridcliente($Correo){
        //conectar ala DB
        $Db = Db::Conectar();
        //$$listarClientes = [];
        $Sql = $Db->prepare('SELECT idCliente FROM clientes WHERE Correo=:Correo');
        $Sql->bindValue(':Correo',$Correo);
        //se ejecuta la consulta
        try{ 
            $Sql->execute();
            $resultado = $Sql->fetchColumn();
            echo("iD = $resultado\n");
            return $resultado;
        }
        catch(Exception $e){
            echo $e->getMessage();
            die();
        }

    }
    
    
    public function buscarCorreoCliente($Correo)
    {
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM clientes
        WHERE Correo=:Correo');
          $Sql->bindValue('Correo',$Correo);
          
          $Sql->execute();
          $var = 0;
          if($Sql->rowCount()>0)
          {
              $var=1;
          }
          else{
              $var=0;
          }
          Db::cerrarconexion($Db);
          return $var;
        }
    
    public function buscarContrasena($Correo)
    {
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM clientes where Correo=:Correo');
        $Sql->bindValue(':Correo',$Correo);
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Cliente){
            $C = new Clientes(); //crear un objeto de tipo cliente
            $C->setContrasena($Cliente['Contrasena']);
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $C->getContrasena();
    }

   
}


?>
