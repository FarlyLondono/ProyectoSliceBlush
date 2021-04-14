$(document).ready(function() {
    $("#frmcompra").submit(function(event) {
        event.preventDefault();
        if ($("#usuario").val().length == 0 || $("#numerofactura").val().length == 0 || $("#proveedor").val().length == 0 || $("#insumo").val().length == 0 || $("#cantidad").val().length == 0) {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Apreciado Usuario Todos los campos son Obligatorios',
                showConfirmButton: true,
                //timer: 1000 
            })

            //alert("Apreciado usuario faltan campos por diligenciar");
        } else {
            let url = "../Controlador/ControladorCompra.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmcompra").serialize(),
                success: function(data) {
                    $("#idcompra").val(data);
                    Detallecompra();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Registro Exitoso',
                        showConfirmButton: true,
                        //timer: 1000
                    });
                }

            });
        }
    });
});

function Detallecompra() {
    var formData = new FormData();
    formData.append('Detallecompra', 'Detallecompra');
    formData.append('idcompra', $("#idcompra").val());
    $.ajax({
        url: '../Controlador/Controladordetallecompra.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != 0) {
                $("#listadoDetallecompra").html(response);
            }
        }
    });

}