


<title>Recuperar Contraseña</title>
<link rel="icon" type="image/png" href="../Img/hamburguer.png" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="../Css/stylerecu.css">
<div class="body"></div>
<div class="grad"></div>
<div class="header">
    <div><strong>Slice<span>Blush</strong></span></div>
</div>
</br>
<div class="login">
    <div id="formContent">
      <form name="frmRec" id="frmRec" >
        <input type="text" placeholder="Correo" name="Correo" id="Correo">
        <input type="hidden" name="recuperarContra" />
    </br>
    </br>
    <button type="submit" name="recuperarContra" id="recuperarContra" class="btn btn-success">Enviar</button>
        </form>
    </div>
</div>

<script src="../js/validarrecuperacion.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script >
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $("#recuperarContra").on('click', function(e) {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        e.preventDefault();
        //alert('A');
        //if(validanDatos()){    
        //alert('B');
        var dataString = $('#frmRec').serialize();
        $.post("../Controlador/Correo.php",dataString, function(response) { 
          alert(response); 
            $(document).ready(function() {
            Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Se le envio un correo de recuperacion!!!',
            showConfirButton: true,
            }).then(function() {
            window.location.href = "../index.php";
            })});
        }) 
        //}
    });    
});
</script>