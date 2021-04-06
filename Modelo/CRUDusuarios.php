<?php

class CRUDusuario{
    public function __construct(){}

    public function VerificarLogin($Usuario)
    {

        //echo  
        $Usuario->getContrasena();
        $Db = Db::Conectar();
        $Sql = $Db->prepare("SELECT * FROM usuarios where Correo=:Correo AND
        Contrasena=:Contrasena");
        $Sql->bindvalue('Correo',$Usuario->getCorreo());
        $Sql->bindvalue('Contrasena',$Usuario->getContrasena());
        $Sql->execute();
        $C = new Usuarios();
        if($Sql->rowCount() > 0){
            //echo "Existe";
            $DatosCliente = $Sql->fetch();
            $C->setIdUsuarios($DatosCliente['IdUsuarios']);
            $C->setNombre($DatosCliente['Nombre']);
            $C->setCorreo($DatosCliente['Correo']);
            $C->setIdRol($DatosCliente['IdRol']);
            $C->setidEstado($DatosCliente['idEstado']);
            $C->setExiste(1);
        }
        else{
    
            $C->setExiste(0);
        }
        return $C;
    }

    public function listarUsuarios(){
        //conectar ala DB
        $Db = Db::Conectar();
        $listaUsuarios = [];
        //se define la consulta
        $Sql = $Db->query('SELECT f.idEstado,f.IdRol,f.IdUsuarios, f.NumeroDocumento, f.Nombre, f.Apellidos, f.Correo, e.idEstado,e.NombreEstado,r.idRol,r.NombreRol FROM usuarios AS f INNER JOIN estado AS e ON f.idEstado=e.idEstado INNER JOIN rol AS r ON f.IdRol=r.idRol');
        //se ejecuta la consulta
        $Sql->execute();
        foreach($Sql->fetchAll() as $Usuario){
            $U = new Usuarios(); //crear un objeto de tipo usuario
            $U->setIdUsuarios($Usuario['IdUsuarios']);
            $U->setNumeroDocumento($Usuario['NumeroDocumento']);
            $U->setNombre($Usuario['Nombre']);
            $U->setApellidos($Usuario['Apellidos']);
            $U->setCorreo($Usuario['Correo']);
            $U->setNombreEstado($Usuario['NombreEstado']);
            $U->setNombreRol($Usuario['NombreRol']);
            
            /*echo "<p>".$Usuario['idUsuarios']."</p>";
            echo "<p>".$Usuario['tipodocumento']."</p>";*/

            $listaUsuarios[]= $U;//asignar ala lista el objeto.
        }
        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
        return $listaUsuarios;//retornar el array de objetos.
    }
 
    public function RegistrarUsuario($Usuario){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('INSERT INTO usuarios(NumeroDocumento,Nombre,Apellidos,Correo,Contrasena,Estado,IdRol)
         VALUES(:NumeroDocumento,:Nombre,:Apellidos,:Correo,:Contrasena,:Estado,:IdRol)');
        $Sql->bindValue('NumeroDocumento',$Usuario->getNumeroDocumento());
        $Sql->bindValue('Nombre',$Usuario->getNombre());
        $Sql->bindValue('Apellidos',$Usuario->getApellidos());
        $Sql->bindValue('Correo',$Usuario->getCorreo());
        $Sql->bindValue('Contrasena',$Usuario->getContrasena());
        $Sql->bindValue('Estado',$Usuario->getEstado());
        $Sql->bindValue('IdRol',$Usuario->getIdRol());
        


        try{

            $Sql->execute();
            //echo "registro exitoso";
        }
        catch(Exception $e){
            //echo $e->getMessage();
            die();
        }

        Db::cerrarconexion($Db);//llamar el metodo para cerrar la conexion.
    }
    public function buscarusuario($IdUsuarios){
        //conectar ala DB

        
        $Db = Db::Conectar();
        $Sql = $Db->prepare('SELECT * FROM usuarios WHERE IdUsuarios=:IdUsuarios');
        $Sql->bindValue(':IdUsuarios',$IdUsuarios);
        $Sql->execute();
        foreach($Sql->fetchAll() as $Usuario){

            
            $passwordesencriptada = base64_decode($Usuario['Contrasena']);

            $U = new Usuarios();
            $U->setIdUsuarios($Usuario['IdUsuarios']);
            $U->setNumeroDocumento($Usuario['NumeroDocumento']);
            $U->setNombre($Usuario['Nombre']);
            $U->setApellidos($Usuario['Apellidos']);
            $U->setCorreo($Usuario['Correo']);
            $U->setContrasena($passwordesencriptada);
            $U->setidEstado($Usuario['idEstado']);
            $U->setIdRol($Usuario['IdRol']);

            
        }
        Db::cerrarconexion($Db);
        return $U;


    }

    public function editarusuario($Usuario){
        $Db = Db::Conectar();
        $Sql = $Db->prepare('UPDATE usuarios SET
        NumeroDocumento=:NumeroDocumento,
        Nombre=:Nombre,
        Apellidos=:Apellidos,
        Correo=:Correo,
        Contrasena=:Contrasena,
        Estado=:Estado,
        IdRol=:IdRol
        WHERE IdUsuarios=:IdUsuarios');
        $Sql->bindValue('NumeroDocumento',$Usuario->getNumeroDocumento());
        $Sql->bindValue('Nombre',$Usuario->getNombre());
        $Sql->bindValue('Apellidos',$Usuario->getApellidos());
        $Sql->bindValue('Correo',$Usuario->getCorreo());
        $Sql->bindValue('Contrasena',$Usuario->getContrasena());
        $Sql->bindValue('Estado',$Usuario->getEstado());
        $Sql->bindValue('IdRol',$Usuario->getIdRol());
        $Sql->bindValue('IdUsuarios',$Usuario->getIdUsuarios());
       
        
        

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


    



}
