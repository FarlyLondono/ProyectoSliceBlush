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