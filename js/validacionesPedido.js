$(document).ready(function() {
    $("#frmpedido").submit(function(event) {
        event.preventDefault();
        if ($("#Cliente").val().length == 0 || $("#producto").val().length == 0 || $("#cantidad").val().length == 0) {

            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'Apreciado Usuario Todos los campos son Obligatorios',
                showConfirmButton: true,
                //timer: 1000
            })

            //alert("Apreciado usuario faltan campos por diligenciar");

        } else {
            let url = "../Controlador/ControladorPedido.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#frmpedido").serialize(),
                success: function(data) {
                    $("#idPedido").val(data);
                    listarDetallePedido();
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

function listarDetallePedido() {
    var formData = new FormData();
    formData.append('ListarDetallePedido', 'ListarDetallePedido');
    formData.append('idPedido', $("#idPedido").val());
    $.ajax({
        url: '../Controlador/ControladorPedido.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != 0) {
                $("#ListadoDetallePedido").html(response);
            }
        }
    });

}