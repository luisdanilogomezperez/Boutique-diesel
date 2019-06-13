$(document).ready(function () {

    $(peticionPayu());
    $(mostrarFacturas());

    function peticionPayu() {
        setTimeout(() => {
            var datos = {
                totalPagarPayu: $("#guardarTotalPagar").val()
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                success: function (respuesta) {
                    $("#merchan").val(respuesta["merchanId"]);
                    $("#account").val(respuesta["accountId"]);
                    $("#descripcion").val(respuesta["descripcion"]);
                    $("#referencia").val(respuesta["referenceCode"]);
                    $("#monto").val(respuesta["amount"]);
                    $("#tax").val(respuesta["tax"]);
                    $("#basetax").val(respuesta["taxReturnBase"]);
                    $("#moneda").val(respuesta["currency"]);
                    $("#signature").val(respuesta["signature"]);
                    $("#test").val(respuesta["test"]);
                    $("#correo").val(respuesta["buyerEmail"]);
                    $("#response").val(respuesta["responseUrl"]);
                    $("#confirmacion").val(respuesta["confirmationUrl"]);
                }
            });
        }, 1000);
    }


    function mostrarFacturas() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarfacturas=true',
            dataType: 'json',
            success: function (respuesta) {
                document.getElementById("cantidadCompras").innerHTML = respuesta.length;
                var html = "";
                for (var i in respuesta) {
                    html += '<div class="col-lg-4">\n\
                    <div class="comprado mt-2">\n\
                        <div class="front seleccion'+ respuesta[i].id + ' active">\n\
                            <div class="location">'+ respuesta[i].fecha + '</div>\n\
                            <div class="more" data-id="'+ respuesta[i].id + '">\n\
                                <i class="fas fa-arrow-circle-right"></i>\n\
                            </div>\n\
                            <div class="weather">\n\
                                <i class="fas fa-hand-holding-usd"></i>\n\
                                <h1>'+ respuesta[i].totalpagar + '<br><span>Ref: ' + respuesta[i].transaccion + '</span><br><span class="badge badge-primary" title="' + respuesta[i].estadodescripcion+ '">' + respuesta[i].estado + '</span></h1>\n\
                            </div>\n\
                            <ul class="forecast">\n\
                                <li>\n\
                                    <div class="day">'+ respuesta[i].tipopago + '</div>\n\
                                    <div class="temprature">\n\
                                        <i class="fas fa-credit-card"></i>\n\
                                    </div>\n\
                                </li>\n\
                                <li>\n\
                                    <div class="day">'+ respuesta[i].empresapago + '</div>\n\
                                    <div class="temprature">\n\
                                        <i class="fab fa-cc-mastercard"></i></div>\n\
                                </li>\n\
                            </ul>\n\
                        </div>\n\
                        <div class="back seleccion2'+ respuesta[i].id + ' mt-2">\n\
                            <div class="go-back" data-id="'+ respuesta[i].id + '">\n\
                                <i class="fas fa-arrow-circle-left"></i>\n\
                            </div>\n\
                            <ul class="forecast" id="mostrarProductosFactura'+ respuesta[i].id +'">\n\
                            </ul>\n\
                        </div>\n\
                    </div>\n\
                </div>';
                }
                $("#mostrarFacturas").append(html);
            }
        });
    }

    $(document).on("click", ".more", function () {
        factura = $(this).data("id");
        var datos = {
            idfactura: factura
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                html = "";
               var id ="mostrarProductosFactura"+factura;
               document.getElementById(id).innerHTML="";
               for (const x in respuesta) {
                html += '<li>\n\
                <div class="day"><a class="text-white" href="Producto='+ respuesta[x].producto + '">'+ respuesta[x].nombre + '</a></div>\n\
                    <div class="temprature">\n\
                        <i class="fas fa-tshirt"></i>\n\
                        '+ respuesta[x].talla + '<br><i class="fas fa-dollar-sign"></i>\n\
                        '+ respuesta[x].precio + ' <br>\n\
                        Cantidad: '+ respuesta[x].comprado + '</div>\n\
                </li>';
               }
               $("#"+id).append(html);
            }
        });
    });

});
