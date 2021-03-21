<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" type="image/png" href="Img/hamburguer.png" />
  <link rel="icon" type="image/png" href="../Img/Hamburger_icon-icons.com_68741.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/estylelogin.css">
  <style>
    .pointer {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div id="logear">
    <div class="body"></div>
    <div class="grad"></div>
<<<<<<< HEAD
    <div>
      <div class="header">
        <div><strong>Slice<span>Blush</strong></span></div>
      </div>
      <br>
      <div class="login">
        <div id="formContent">
          <form action="Controlador/ControladorLogin.php" method="POST">
            <input type="text" placeholder="Correo" name="Correo" id="Correo"><br>
            <input type="password" placeholder="Contrasena" name="Contrasena" id="Contrasena"><br>
            <strong>
              <p class="message">No estas registrado? <a style="color: black;" class="pointer" href="Vista/RegistrarCliente1.php">Crea una cuenta</a>
            </strong></p>
            <br />
            <button type="submit" class="btn btn-dark" name="Acceder" value="Acceder">Acceder</button><br />
            <strong><a class="pointer" style="color:black" href="Vista/RecuperarContrasena.php">Olvide mi contraseña!</a></strong>
          </form>
          <br />
        </div>
=======
    <div class="header">
      <div><strong>Slice<span>Blush</strong></span></div>
    </div>
    <br>
    <div class="login">
      <div id="formContent">
      <form action="Controlador/ControladorLogin.php" method="POST">
        <input type="text" placeholder="Correo" name="Correo" id="Correo"><br>
        <input type="password" placeholder="Contraseña" name="Contrasena" id="Contrasena"><br>
        <strong><p class="message">No está registrado? <a  style="color: black;" class="pointer"  href="Vista/RegistrarCliente1.php">Crea una cuenta</a></strong></p>
        <br/>
        <button type="submit"  class="btn btn-dark" name="Acceder" value="Acceder">Acceder</button>
        <br/>
        <br/>
       <strong><a class="pointer" style="color:black" href="Vista/RecuperarContrasena.php">Olvidé mi contraseña!</a></strong>
        </form>
        <br/>
>>>>>>> 5b7b8a77aa9a993d6f4022c007854d55c3ea8b4f
      </div>
    </div>
  </div>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/navbar.js"></script>
<script>
  $(document).ready(() => {
    localStorage.clear();
  })
</script>

</html>