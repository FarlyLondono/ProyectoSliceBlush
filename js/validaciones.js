$("#registrarcompra").click(function() {


    $("#usuariorequerido").text("");
    if ($("#usuario").val() == "") {
        $("#usuariorequerido").text("usuario: * ");
        document.getElementById('usuariorequerido').style.color = "red";
    }
    $("#numerofacturarequerido").text("");
    if ($("#numerofactura").val() == "") {
        $("#numerofacturarequerido").text("numerofactura: * ");
        document.getElementById('numerofacturarequerido').style.color = "red";
    }
    $("#proveedorreuqerido").text("");
    if ($("#proveedor").val() == "") {
        $("#proveedorreuqerido").text("proveedor: * ");
        document.getElementById('proveedorreuqerido').style.color = "red";
    }
});

$("#RegistrarPedido").click(function() {


    $("#clienterequerido").text("");
    if ($("#Cliente").val() == "") {
        $("#clienterequerido").text("Cliente: * ");
        document.getElementById('clienterequerido').style.color = "red";
    }
    $("#numerofacturarequerido").text("");
    if ($("#numerofactura").val() == "") {
        $("#numerofacturarequerido").text("numerofactura: * ");
        document.getElementById('numerofacturarequerido').style.color = "red";
    }
    $("#proveedorreuqerido").text("");
    if ($("#proveedor").val() == "") {
        $("#proveedorreuqerido").text("proveedor: * ");
        document.getElementById('proveedorreuqerido').style.color = "red";
    }
});



function validarDatosInsumo() {

    var comprobacion = 0;
    if ($("#nombreProducto").val().length == 0) {
        swal("El campo nombreProducto esta vacio");
        comprobacion++;
    }
    if ($("#unidadmedida").val().length == 0) {
        swal("El campo unidadmedida esta vacio");
        comprobacion++;
    }
    if ($("#precio").val().length == 0) {
        swal("El campo Precio esta vacio");
        comprobacion++;
    }
    if ($("#Stock").val().length == 0) {
        swal("El campo Stock esta vacio");
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

$("#nombreProducto").on("keyup", function() {
    $("#nombreRequerido").text("nombreProducto: ");
    document.getElementById('nombreRequerido').style.color = "black";
});

$("#unidadmedida").on("keyup", function() {
    $("#unidadRequerido").text("unidadmedida: ");
    document.getElementById('unidadRequerido').style.color = "black";
});



$("#RegistrarInsumo").click(function() {


    $("#nombreRequerido").text("");
    if ($("#nombreProducto").val() == "") {
        $("#nombreRequerido").text("nombreProducto: * ");
        document.getElementById('nombreRequerido').style.color = "red";
    }
    $("#unidadRequerido").text("");
    if ($("#unidadmedida").val() == "") {
        $("#unidadRequerido").text("unidadmedida: * ");
        document.getElementById('unidadRequerido').style.color = "red";
    }
    $("#precioRequerido").text("");
    if ($("#precio").val() == "") {
        $("#precioRequerido").text("precio: * ");
        document.getElementById('precioRequerido').style.color = "red";
    }
    $("#StockRequerido").text("");
    if ($("#Stock").val() == "") {
        $("#StockRequerido").text("Stock: * ");
        document.getElementById('StockRequerido').style.color = "red";
    }

});

function validarDatoseditarusurio() {

    var comprobacion = 0;
    if ($("#NumeroDocumento").val().length == 0) {
        swal({ icon: 'error', text: "El campo Número Documento está vacío" });
        comprobacion++;
    }
    if ($("#Nombre").val().length == 0) {
        swal({ icon: 'error', text: "El campo Nombre está vacío" });
        comprobacion++;
    }
    if ($("#Apellidos").val().length == 0) {
        swal({ icon: 'error', text: "El campo Apellidos está vacío" });
        comprobacion++;
    }
    if ($("#Correo").val().length == 0) {
        swal({ icon: 'error', text: "El campo Correo está vacío" });
        comprobacion++;
    }
    if ($("#Contrasena").val().length == 0) {
        swal({ icon: 'error', text: "El campo Contraseña está vacío" });
        comprobacion++;
    }
    if ($("#Contrasena").val().length <= 6) {
        swal({ icon: 'error', text: "El campo Contraseña debe contener 7 caracteres" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }



}

function validarDatoseditarcliente() {

    var comprobacion = 0;
    if ($("#Nombre").val().length == 0) {
        swal({ icon: 'error', text: "El campo Nombre está vacío" });
        comprobacion++;
    }
    if ($("#Correo").val().length == 0) {
        swal({ icon: 'error', text: "El campo Correo está vacío" });
        comprobacion++;
    }
    if ($("#Direccion").val().length == 0) {
        swal({ icon: 'error', text: "El campo Dirección está vacío" });
        comprobacion++;
    }
    if ($("#Telefono").val().length == 0) {
        swal({ icon: 'error', text: "El campo Teléfono está vacío" });
        comprobacion++;
    }
    if ($("#Contrasena").val().length == 0) {
        swal({ icon: 'error', text: "El campo Contraseña está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatoseditarproducto() {

    var comprobacion = 0;
    if ($("#NombreProducto").val().length == 0) {
        swal({ icon: 'error', text: "El campo NombreProducto está vacío" });
        comprobacion++;
    }
    if ($("#DescripcionProducto").val().length == 0) {
        swal({ icon: 'error', text: "El campo DescripcionProducto está vacío" });
        comprobacion++;
    }
    if ($("#PrecioProducto").val().length == 0) {
        swal({ icon: 'error', text: "El campo PrecioProducto está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatoseditarpedido() {

    var comprobacion = 0;
    if ($("#IdEstadoPedido").val().length == 0) {
        swal({ icon: 'error', text: "El campo Estado pedido está vacío" });
        comprobacion++;
    }
    if ($("#idCliente").val().length == 0) {
        swal({ icon: 'error', text: "El campo Cliente está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatoseditarinsumo() {

    var comprobacion = 0;
    if ($("#nombreProducto").val().length == 0) {
        swal({ icon: 'error', text: "El campo nombreProducto está vacío" });
        comprobacion++;
    }
    if ($("#unidadmedida").val().length == 0) {
        swal({ icon: 'error', text: "El campo unidadmedida está vacío" });
        comprobacion++;
    }
    if ($("#precio").val().length == 0) {
        swal({ icon: 'error', text: "El campo precio está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatoseditarcompra() {

    var comprobacion = 0;
    if ($("#IdUsuarios").val().length == 0) {
        swal({ icon: 'error', text: "El campo nombreUsuario está vacío" });
        comprobacion++;
    }
    if ($("#proveedor").val().length == 0) {
        swal({ icon: 'error', text: "El campo proveedor está vacío" });
        comprobacion++;
    }
    if ($("#numerofactura").val().length == 0) {
        swal({ icon: 'error', text: "El campo número factura está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatosdetallecompra() {

    var comprobacion = 0;
    if ($("#idinsumo").val().length == 0) {
        swal({ icon: 'error', text: "El campo Insumo está vacío" });
        comprobacion++;
    }
    if ($("#Cantidad").val().length == 0) {
        swal({ icon: 'error', text: "El campo Cantidad está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}

function validarDatosdetallepedido() {

    var comprobacion = 0;
    if ($("#idProducto").val().length == 0) {
        swal({ icon: 'error', text: "El campo producto está vacío" });
        comprobacion++;
    }
    if ($("#cantidad").val().length == 0) {
        swal({ icon: 'error', text: "El campo Cantidad está vacío" });
        comprobacion++;
    }
    if (comprobacion > 0) {
        return false;
    } else {
        return true;
    }

}