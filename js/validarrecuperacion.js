function validanDatos() {

    var correo = document.getElementsByName('Correo')[0].value;

    if ((correo == "")) { //COMPRUEBA CAMPOS VACIOS
        swal({
            icon: 'error',
            title: 'El campo correo es obligatorio'
        });
        return true;
    }
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    //var address = document.getElementById[email].value;
    if (reg.test(correo) == false) {
        swal('Correo invalido');
        return (false);
    } else {
        swal("Se envio un correo de recuperacion.", {
            button: "OK"
        }).then(function() {
            window.location.href = "../index.php"
        })
    }
}