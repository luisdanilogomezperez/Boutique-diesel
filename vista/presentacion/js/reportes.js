$(document).ready(function () {

    $(cargarReportes("diario"));
    $(cargarReportes("semanal"));
    $(cargarReportes("mensual"));
    $(cargarReportes("total"));
    $(cargarFacturasSinEntregar("sinEntregar"));
    $("#descargarPDF").hide();
    $("#btnSinEntregar").hide();

    function descargarPDF(contenido, nombreArchivo) {
        var contenido = contenido;
        var nombre = nombreArchivo;
        var pdf = new jsPDF('p', 'pt', 'letter');
        html = $('#' + contenido).html();
        specialElementHandlers = {
            '#bypassme': function (element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(html, margins.left, margins.top, {
            'width': margins.width,
            'elementHandlers': specialElementHandlers
        }, function (dispose) {
            pdf.save(nombre + '.pdf');
        }, margins);
    }

    $("#btnGenerarReporte").click(function () {
        var f = new Date();
        var hoy = f.getDate() + "/" + (f.getMonth()+1) + "/" + f.getFullYear();
        var nombrePDF = "Reporte" + "_" + hoy;
        descargarPDF("descargarPDF", nombrePDF);
    });


    function cargarReportes(tipo) {
        var datos = {
            tipoReporte: tipo
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var totalActual = respuesta[0].totalcompras;
                if (tipo === "total") {
                    document.getElementById('total' + tipo).innerHTML = "$" + totalActual;
                } else {
                    var totalAnterior = respuesta[1].totalcompras;
                    var division = totalAnterior;
                    var resultado = "Decremento";
                    if (totalAnterior == 0) {
                        division = totalActual;
                    }
                    var deficit = ((totalActual - totalAnterior) / division) * 100;
                    if (deficit >= 0) {
                        resultado = "Incremento";
                    }
                    document.getElementById('total' + tipo).innerHTML = "$" + totalActual;
                    $('#deficit' + tipo).html('<strong >' + Math.round(deficit) + '%</strong> ' + resultado);
                }
            }
        });
    }

    $("#btnDiario").click(function () {
        cargarReportesFactura("diario");
    });

    $("#btnSemanal").click(function () {
        cargarReportesFactura("semanal");
    });

    $("#btnMensual").click(function () {
        cargarReportesFactura("mensual");
    });

    $("#btnTotal").click(function () {
        cargarReportesFactura("total");
    });

    function cargarReportesFactura(tipo) {
        var datos = {
            tipoReporteFactura: tipo
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = "";
                var cantidad = respuesta.length;
                if(cantidad==0){
                    $("#descargarPDF").show();
                    $("#btnGenerarReporte").hide();
                    document.getElementById('tipoReporte').innerHTML = "Reporte " + tipo;
                    html = '<br><p class="text-white m-2 lead">No se han realizado compras</p>';
                }else{
                    $("#descargarPDF").show();
                    $("#btnGenerarReporte").show();
                document.getElementById('tipoReporte').innerHTML = "Reporte " + tipo;
                for (var i = 0; i < respuesta.length; i++) {
                    html += '<div class="row">\n\
                    <div class="col-lg-6">\n\
                        <div style="margin-top:10px;">\n\
                            <h4 style="color:white;" class="ml-4">Factura '+ (i + 1) + '</h4>\n\
                            <p class="lead">\n\
                                <ul style="list-style: none;" class="text-white">\n\
                                    <li><strong>Cliente:</strong> '+ respuesta[i].nombres + ' ' + respuesta[i].apellidos + '</li>\n\
                                    <li><strong>Tipo Pago: </strong>'+ respuesta[i].tipopago + '</li>\n\
                                    <li><strong>Empresa Pago: </strong>'+ respuesta[i].empresapago + '</li>\n\
                                    <li><strong>Total Pago: </strong>$'+ respuesta[i].total + '</li>\n\
                                    <li><strong>Fecha Compra: </strong>'+ respuesta[i].fecha + '</li>\n\
                                </ul>\n\
                            </p>\n\
                        </div>\n\
                    </div>\n\
                    <div class="col-lg-6">\n\
                        <div class="table-responsive mt-2">\n\
                            <table class="table table-hover table-dark">\n\
                                <thead>\n\
                                    <tr>\n\
                                        <th scope="col">Nombre</th>\n\
                                        <th scope="col">Precio</th>\n\
                                        <th scope="col">Genero</th>\n\
                                        <th scope="col">Categoria</th>\n\
                                        <th scope="col">Talla</th>\n\
                                        <th scope="col">Cantidad</th>\n\
                                    </tr>\n\
                                </thead>\n\
                                <tbody>';
                    var productos = cargarProductosReporteFactura(respuesta[i].id);
                    html += productos;
                    html += '</tbody>\n\
                            </table>\n\
                        </div>\n\
                    </div>\n\
                </div>';
                }
                }
                $("#mostrarReporteFactura").html(html);
            }
        });
    }

    function cargarProductosReporteFactura(factura) {
        var productos = "";
        var datos = {
            idFacturaReporte: factura
        };

        $.ajax({
            async: false,
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = "";
                for (var i = 0; i < respuesta.length; i++) {
                    html += '<tr>\n\
                    <td>'+ respuesta[i].nombre + '</td>\n\
                    <td>'+ respuesta[i].precio + '</td>\n\
                    <td>'+ respuesta[i].genero + '</td>\n\
                    <td>'+ respuesta[i].categoria + '</td>\n\
                    <td>'+ respuesta[i].talla + '</td>\n\
                    <td>'+ respuesta[i].cantidad + '</td>\n\
                </tr>';
                }
                productos = (html);
            }
        });
        return productos;
    }

    function cargarFacturasSinEntregar(tipo) {
        var datos = {
            tipoReporteFactura: "total"
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = "";
                var contador = 0;
                for (var i = 0; i < respuesta.length; i++) {
                    var id = respuesta[i].idestado;
                    var clase = "danger";
                    if (tipo === "sinEntregar") {
                        if (id != 3) {
                            if (id == 2) {
                                clase = "primary";
                            }
                            contador++;

                            html += ' <tr>\n\
                    <th scope="row">'+ (i + 1) + '</th>\n\
                    <td>'+ respuesta[i].nombres + ' ' + respuesta[i].apellidos + '</td>\n\
                    <td>'+ respuesta[i].direccion + '</td>\n\
                    <td>'+ respuesta[i].tipopago + '</td>\n\
                    <td>'+ respuesta[i].empresapago + '</td>\n\
                    <td>'+ respuesta[i].total + '</td>\n\
                    <td>'+ respuesta[i].fecha + '</td>\n\
                    <td>\n\
                    <button data-toggle="modal" data-target="#modalProductosFactura" data-id="' + respuesta[i].id + '" id="btnMostrarProdutosModal" title="' + respuesta[i].estadodescripcion + '" class="btn btn-' + clase + '">' + respuesta[i].nombreestado + ' <i class="fas fa-people-carry"></i></button>\n\
                    </td>\n\
                </tr>';
                mostrarTipo = "Sin Entregar"
                        }
                    } else {
                        clase = "success";
                        if (id == 3) {
                            html += ' <tr>\n\
                    <th scope="row">'+ (i + 1) + '</th>\n\
                    <td>'+ respuesta[i].nombres + ' ' + respuesta[i].apellidos + '</td>\n\
                    <td>'+ respuesta[i].direccion + '</td>\n\
                    <td>'+ respuesta[i].tipopago + '</td>\n\
                    <td>'+ respuesta[i].empresapago + '</td>\n\
                    <td>'+ respuesta[i].total + '</td>\n\
                    <td>'+ respuesta[i].fecha + '</td>\n\
                    <td>\n\
                    <button data-toggle="modal" data-target="#modalProductosFactura" data-id="' + respuesta[i].id + '" id="btnMostrarProdutosModal" title="' + respuesta[i].estadodescripcion + '" class="btn btn-' + clase + '">' + respuesta[i].nombreestado + ' <i class="fas fa-people-carry"></i></button>\n\
                    </td>\n\
                </tr>';
                contador++;
                mostrarTipo = "Entregadas"
                        }
                    }

                }
                $("#mostrarFacturasSinEntregar").html(html);
                document.getElementById("sinEntregar").innerHTML = "| " + contador + " "+mostrarTipo;
            }
        });
    }

    $(document).on("click", "#btnMostrarProdutosModal", function () {
        var id = $(this).data("id");
        var html = cargarProductosReporteFactura(id);
        $("#productosFacturaModal").html(html);
        $("#idFacturaModal").val(id);
        var datos = {
            tipoReporteFactura: "total"
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                for (var i = 0; i < respuesta.length; i++) {
                    var idFactura = respuesta[i].id;
                    if (idFactura == id) {
                        $("#nuevoEstado option[value=" + respuesta[i].idestado + "]").attr("selected", true);
                    }
                }
            }
        });
    });

    $(document).on("change", "#nuevoEstado", function () {
        var factura = $("#idFacturaModal").val();
        var nuevoEstado = $("#nuevoEstado").val();
        var datos = {
            facturaNuevoEstado: factura,
            nuevoEstado: nuevoEstado
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                if (respuesta['exito']) {
                    $("#btnSinEntregar").hide();
                    $("#btnEntregadas").show();
                    cargarFacturasSinEntregar("sinEntregar");
                }
            }
        });
    });

    $("#btnEntregadas").click(function(){
        $("#btnEntregadas").hide();
        $("#btnSinEntregar").show();
        cargarFacturasSinEntregar("entregadas");
    });

    $("#btnSinEntregar").click(function(){
        $("#btnSinEntregar").hide();
        $("#btnEntregadas").show();
        cargarFacturasSinEntregar("sinEntregar");
    });

});