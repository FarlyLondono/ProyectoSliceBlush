$(document).ready(function() {
    $("#frmproducto").submit(function(event) {
        event.preventDefault();
        if ($("#PrecioProducto").val().length == 0 || $("#idEstado").val().length == 0) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Apreciado Usuario Todos los campos y son Obligatorios',
                showConfirmButton: true,
                //timer: 1000 
            })


        } else {



            var dataString = $('#frmproducto').serialize();
            $.post("../Controlador/controlador.php", dataString, function(response) {
                //alert(response); 
                $(document).ready(function() {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Actualización Exitosa!!!',
                        showConfirButton: true,
                        //timer: 2000
                    }).then(function() {
                        window.location.href = "../menu.php";
                    })
                });
            });



        }
    });
});

function Detalleproducto() {
    var formData = new FormData();
    formData.append('Detalleproducto', 'Detalleproducto');
    formData.append('idProducto', $("#idProducto").val());
    $.ajax({
        url: '../Controlador/ControladorProducto.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != 0) {
                $("#listadoDetalleProducto").html(response);
            }
        }
    });

}