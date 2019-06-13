$(document).ready(function () {

    $(cargarTallasCantidad());
    $("#formAñadirTalla").hide();

    function cargarTallasCantidad() {
        var id = $("#idProductoInventario").val();
        var datos = {
            idProductoInventario: id
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = "";
                for (var i = 0; i < respuesta.length; i++) {
                    var cantidad = respuesta[i].cantidad;
                    var clase = "success";
                    if (cantidad < 5) {
                        clase = "danger";
                    } else if (cantidad >= 5 && cantidad < 10) {
                        clase = "warning";
                    }
                    html += '<tr>\n\
                    <td>'+ respuesta[i].numerotalla + '</td>\n\
                    <td class="bg-'+ clase + '">\n\
                        <input min="0" style="width: 60px;" class="form-control mx-auto" name="nuevaCantidadInventario" data-id="'+ respuesta[i].idproductotalla + '" id="nuevaCantidadInventario" type="number" value="' + cantidad + '" required>\n\
                    </td>\n\
                </tr>';
                }
                $("#cargarTallasInventario").html(html);
            }
        });
    }

    $(document).on("change", "#nuevaCantidadInventario", function () {
        var tallaproductoInventario = $(this).data("id");
        var nuevaCantidadInventario = $(this).val();

        if (nuevaCantidadInventario < 0) {
            respuestaErrorConEspera("Error!", "Cantidad no valida");
        } else {
            var datos = {
                tallaproductoInventario: tallaproductoInventario,
                nuevaCantidadInventario: nuevaCantidadInventario
            }
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        cargarTallasCantidad();
                    } else if (!respuesta["exito"]) {
                        respuestaErrorConEspera("Error!", "Ocurrio un error");
                    }
                }
            });
        }

    });

    $("#btnTallasDisponibles").click(function () {
        $("#formAñadirTalla").show();
        var id = $("#idProductoInventario").val();
        var datos = {
            idProductoNuevaTalla: id
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = '';
                for (var i = 0; i < respuesta.length; i++) {
                    html += '<div class="custom-control custom-checkbox ml-3 mb-3">\n\
                    <input class="custom-control-input nuevaTallaInventario" name="tallas" value="'+ respuesta[i].idtalla + '" id="' + respuesta[i].idtalla + '" type="checkbox">\n\
                    <label class="custom-control-label text-white" for="'+ respuesta[i].idtalla + '">' + respuesta[i].numero + '</label>\n\
                </div>';
                }
                $("#cargarCheckboxTallas").html(html);
            }
        });
    });

    $("#btnFormNuevaTalla").click(function () {
        var tallasInventario = [];
        $(".nuevaTallaInventario").each(function () {
            if ($(this).is(':checked')) {
                tallasInventario.push($(this).val());
            }
        });

        var seleccionado = tallasInventario.length;

        if (seleccionado < 1) {
            respuestaError("Error!", "Seleccione las tallas que desea añadir");
        } else {

            var id = $("#idProductoInventario").val();
            var datos = {
                idProductoCrearTalla: id,
                tallasInventario: tallasInventario
            };

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        $("#formAñadirTalla").hide();
                        cargarTallasCantidad();
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error!", "Ocurrio un error");
                    }   
                }
            });
        }

    });

});