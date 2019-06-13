$(document).ready(function () {

    var productosFavoritos = "";

    $.ajax({
        url: 'vista/modulos/Ajax.php?obtenerProductosFavoritos=true',
        dataType: 'text',
        success: function (respuesta) {
            productosFavoritos = respuesta;
        }
    });

    $(cargarFiltrosHombres());
    $(cargarFiltrosMujeres());
    $(cargarFiltrosNinos());
    $(cargarFiltrosNinas());
    $(cargarInformacionProducto());
    $(cargarTallasProducto());
    $(cargarGaleriaFotos());

    function buscarFavorito(id) {
        var favoritos = productosFavoritos;
        var split = favoritos.split(",");
        var exito = false;
        for (var i = 0; i < split.length; i++) {
            if (split[i] === id) {
                exito = true;
            }
        }
        return exito;
    }

    function cargarFiltrosHombres(filtro) {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosHombres=true&filtrohombre=' + filtro,
            dataType: 'json',
            success: function (respuesta) {
                if (respuesta.toString() === "") {
                    $("#CargarProductosHombres").html("");
                } else {
                    var cargar = '';
                    var clases = '';
                    for (var x = 0; x < respuesta.length; x++) {
                        clases = '';
                        if (buscarFavorito(respuesta[x].id)) {
                            clases = "like activado";
                        } else {
                            clases = "like";
                        }
                        cargar += '<div  class="col-lg-4">\n\
                        <div class="example-2 tarjeta">\n\
                            <div class="wrapper" style="background: url('+ respuesta[x].foto + ') center / cover no-repeat;">\n\
                               <a href="Producto='+ respuesta[x].id + '"> <div class="header" style="height:267px;">\n\
                                    <div class="date">\n\
                                        <span class="day">$'+ respuesta[x].precio + '</span>\n\
                                    </div>\n\
                                </div></a>\n\
                                <div class="data">\n\
                                    <div class="content">\n\
                                        <span class="badge badge-secondary">'+ respuesta[x].categoria + '</span>\n\
                                            <ul class="menu-content" >\n\
                                                <li>\n\
                                                    <div class="'+ clases + '" data-id="' + respuesta[x].id + '"><span>' + respuesta[x].likes + '</span></div>\n\
                                                </li>\n\
                                            </ul >\n\
                                        <h1 class="title"><a href="Producto='+ respuesta[x].id + '">' + respuesta[x].nombre + '</a></h1>\n\
                                        <p class="text">'+ respuesta[x].descripcion + '</p>\n\
                                        <a href="Producto='+ respuesta[x].id + '" class="button">Ver más</a>\n\
                                    </div >\n\
                                </div >\n\
                            </div >\n\
                        </div >\n\
                    </div> ';
                    }
                    $("#CargarProductosHombres").html(cargar);
                }
            }
        });
    }

    function cargarInformacionProducto() {
        var id = $("#idProductoMostrar").val();
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosTodos=true&filtro=todos',
            dataType: 'json',
            success: function (respuesta) {
                for (var x = 0; x < respuesta.length; x++) {
                    if (respuesta[x].id === id) {
                        $("#fotoProducto").attr("src", respuesta[x].foto);
                        $("#tituloProducto").append('<h4 class="display-3 font-weight-bold text-white">' + respuesta[x].nombre + '</h4>\n\
                            <p class="lead text-italic text-white">'+ respuesta[x].descripcion + '</p>');
                        document.getElementById("verPrecioProducto").innerHTML = "$" + respuesta[x].precio;
                        document.getElementById("verRefProducto").innerHTML = "<strong>Ref:</strong> " + respuesta[x].numero[0] + respuesta[x].numero[1] + respuesta[x].numero[2] + respuesta[x].numero[3] + respuesta[x].numero[4] + respuesta[x].numero[5];
                        document.getElementById("verColorProducto").innerHTML = "<strong>Color: </strong>" + respuesta[x].color;
                        document.getElementById("verDescripcionProducto").innerHTML = '<strong>Marca:</strong> ' + respuesta[x].marca + '<br><strong>Tela:</strong> ' + respuesta[x].tela + ' <br> <strong>Recomendaciones:</strong>' + respuesta[x].recomendaciones;
                        $("#productoFotoActual").val(respuesta[x].foto);
                        if (respuesta[x].genero === "niño" || respuesta[x].genero === "niña") {
                            $("#productoGenero").val("chicos");
                            $("#generoCargarFotos").val("chicos");
                            $("#volver").attr("href", "Chicos");
                        } else if (respuesta[x].genero === "hombres") {
                            $("#productoGenero").val(respuesta[x].genero);
                            $("#generoCargarFotos").val(respuesta[x].genero);
                            $("#volver").attr("href", "Hombres");
                        } else if (respuesta[x].genero === "mujeres") {
                            $("#productoGenero").val(respuesta[x].genero);
                            $("#generoCargarFotos").val(respuesta[x].genero);
                            $("#volver").attr("href", "Mujeres");
                        };

                    }
                }
            }
        });
    }

    function cargarFiltrosMujeres(filtro) {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosMujeres=true&filtromujer=' + filtro,
            dataType: 'json',
            success: function (respuesta) {
                if (respuesta.toString() === "") {
                    $("#CargarProductosMujeres").html("");
                } else {
                    var cargar = '';
                    var clases = '';
                    for (var x = 0; x < respuesta.length; x++) {
                        clases = '';
                        if (buscarFavorito(respuesta[x].id)) {
                            clases = "like activado";
                        } else {
                            clases = "like";
                        }
                        cargar += '<div class="col-lg-4">\n\
                        <div class="example-2 tarjeta">\n\
                            <div class="wrapper" style="background: url('+ respuesta[x].foto + ') center / cover no-repeat;">\n\
                                <a href="Producto='+ respuesta[x].id + '"> <div class="header" style="height:267px;">\n\
                                <div class="date">\n\
                                        <span class="day">$'+ respuesta[x].precio + '</span>\n\
                                    </div>\n\
                                </div></a>\n\
                                    <div class="data">\n\
                                    <div class="content">\n\
                                        <span class="badge badge-secondary">'+ respuesta[x].categoria + '</span>\n\
                                            <ul class="menu-content" >\n\
                                                <li>\n\
                                                    <div class="'+ clases + '" data-id="' + respuesta[x].id + '"><span>' + respuesta[x].likes + '</span></div>\n\
                                                </li>\n\
                                            </ul >\n\
                                        <h1 class="title"><a href="Producto='+ respuesta[x].id + '">' + respuesta[x].nombre + '</a></h1>\n\
                                        <p class="text">'+ respuesta[x].descripcion + '</p>\n\
                                        <a href="Producto='+ respuesta[x].id + '" class="button">Ver más</a>\n\
                                    </div >\n\
                                </div >\n\
                            </div >\n\
                        </div >\n\
                    </div > ';
                    }
                    $("#CargarProductosMujeres").html(cargar);
                }
            }
        });
    }

    function cargarFiltrosNinos(filtro) {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosNino=true&filtronino=' + filtro,
            dataType: 'json',
            success: function (respuesta) {
                if (respuesta.toString() === "") {
                    $("#CargarProductosNino").html("");
                } else {
                    var cargar = '';
                    var clases = '';
                    for (var x = 0; x < respuesta.length; x++) {
                        clases = '';
                        if (buscarFavorito(respuesta[x].id)) {
                            clases = "like activado";
                        } else {
                            clases = "like";
                        }
                        cargar += '<div class="col-lg-6">\n\
                        <div class="example-2 tarjeta">\n\
                            <div class="wrapper" style="background: url('+ respuesta[x].foto + ') center / cover no-repeat;">\n\
                            <a href="Producto='+ respuesta[x].id + '"> <div class="header" style="height:267px;">\n\
                            <div class="date">\n\
                                <span class="day">$'+ respuesta[x].precio + '</span>\n\
                            </div>\n\
                        </div></a>\n\
                                <div class="data">\n\
                                    <div class="content">\n\
                                        <span class="badge badge-secondary">'+ respuesta[x].categoria + '</span>\n\
                                            <ul class="menu-content" >\n\
                                                <li>\n\
                                                    <div class="'+ clases + '" data-id="' + respuesta[x].id + '"><span>' + respuesta[x].likes + '</span></div>\n\
                                                </li>\n\
                                            </ul >\n\
                                        <h1 class="title"><a href="Producto='+ respuesta[x].id + '">' + respuesta[x].nombre + '</a></h1>\n\
                                        <p class="text">'+ respuesta[x].descripcion + '</p>\n\
                                        <a href="Producto='+ respuesta[x].id + '" class="button">Ver más</a>\n\
                                    </div >\n\
                                </div >\n\
                            </div >\n\
                        </div >\n\
                    </div > ';
                    }
                    $("#CargarProductosNino").html(cargar);
                }
            }
        });
    }

    function cargarFiltrosNinas(filtro) {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosNina=true&filtronina=' + filtro,
            dataType: 'json',
            success: function (respuesta) {
                if (respuesta.toString() === "") {
                    $("#CargarProductosNina").html("");
                } else {
                    var cargar = '';
                    var clases = '';
                    for (var x = 0; x < respuesta.length; x++) {
                        clases = '';
                        if (buscarFavorito(respuesta[x].id)) {
                            clases = "like activado";
                        } else {
                            clases = "like";
                        }
                        cargar += '<div class="col-lg-6">\n\
                        <div class="example-2 tarjeta">\n\
                            <div class="wrapper" style="background: url('+ respuesta[x].foto + ') center / cover no-repeat;">\n\
                            <a href="Producto='+ respuesta[x].id + '"> <div class="header" style="height:267px;">\n\
                            <div class="date">\n\
                                <span class="day">$'+ respuesta[x].precio + '</span>\n\
                            </div>\n\
                        </div></a>\n\
                                <div class="data">\n\
                                    <div class="content">\n\
                                        <span class="badge badge-secondary">'+ respuesta[x].categoria + '</span>\n\
                                            <ul class="menu-content" >\n\
                                                <li>\n\
                                                    <div class="'+ clases + '" data-id="' + respuesta[x].id + '"><span>' + respuesta[x].likes + '</span></div>\n\
                                                </li>\n\
                                            </ul >\n\
                                        <h1 class="title"><a href="Producto='+ respuesta[x].id + '">' + respuesta[x].nombre + '</a></h1>\n\
                                        <p class="text">'+ respuesta[x].descripcion + '</p>\n\
                                        <a href="Producto='+ respuesta[x].id + '" class="button">Ver más</a>\n\
                                    </div >\n\
                                </div >\n\
                            </div >\n\
                        </div >\n\
                    </div > ';
                    }
                    $("#CargarProductosNina").html(cargar);
                }
            }
        });
    }

    function cargarTallasProducto() {
        var datos = {
            idProductoTallas: $("#idProductoMostrar").val()
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = "";
                var html2 = "";
                for (var i = 0; i < respuesta.length; i++) {
                    html += '<tr>\n\
                    <th scope="row">'+ respuesta[i].numerotalla + '</th>\n\
                    <td>'+ respuesta[i].pecho + '</td>\n\
                    <td>'+ respuesta[i].cintura + '</td>\n\
                    <td>'+ respuesta[i].cadera + '</td>\n\
                    </tr>';
                }
                $("#cargarTablaTallas").append(html);

                for (var i = 0; i < respuesta.length; i++) {
                    html2 += '<option data-id="' + respuesta[i].idproductotalla + '" value="' + respuesta[i].idproductotalla + '">' + respuesta[i].numerotalla + '</option>';
                }
                $("#seleccionarTalla").append(html2);
            }
        });
    }

    function cargarGaleriaFotos() {
        var id = $("#idProductoMostrar").val();
        var datos = {
            idProductoGaleria: id
        };

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = '';
                if (respuesta.length === 0) {
                    html = '<div class="carousel-item active">\n\
                    <img src="https://www.seg.com.ar/assets/images/sin-imagen.png" class="d-block w-100" alt="error" height="540">\n\
                    </div>';
                } else {
                    for (var i = 0; i < respuesta.length; i++) {
                        if (i === 0) {
                            html += '<div class="carousel-item active">\n\
                            <img src="'+ respuesta[i].ruta + '" class="d-block w-100" alt="error" height="540">\n\
                            </div>';
                        } else {
                            html += '<div class="carousel-item">\n\
                            <img src="'+ respuesta[i].ruta + '" class="d-block w-100" alt="error" height="540">\n\
                            </div>';
                        }
                    }
                }
                $("#cargarGaleriaFotos").append(html);
            }
        });
    }



    $(document).on('click', "#hombreCamisas", function () {
        cargarFiltrosHombres("camisas");
    });
    $(document).on('click', "#hombreCamisetas", function () {
        cargarFiltrosHombres("camisetas");
    });
    $(document).on('click', "#hombrePolos", function () {
        cargarFiltrosHombres("polos");
    });
    $(document).on('click', "#hombreBusos", function () {
        cargarFiltrosHombres("busos");
    });
    $(document).on('click', "#hombreShorts", function () {
        cargarFiltrosHombres("shorts");
    });
    $(document).on('click', "#hombrePantalones", function () {
        cargarFiltrosHombres("pantalones");
    });
    $(document).on('click', "#hombreDeportivos", function () {
        cargarFiltrosHombres("deportivo");
    });

    $(document).on('keyup', "#buscarProductoHombre", function () {
        var filtro = $(this).val();
        if (filtro != "") {
            cargarFiltrosHombres(filtro);
        } else {
            cargarFiltrosHombres();
        }
    });

    $(document).on('click', "#mujerTops", function () {
        cargarFiltrosMujeres("tops");
    });

    $(document).on('click', "#mujerBikini", function () {
        cargarFiltrosMujeres("bikini");
    });

    $(document).on('click', "#mujerVestidos", function () {
        cargarFiltrosMujeres("vestidos");
    });

    $(document).on('click', "#mujerShorts", function () {
        cargarFiltrosMujeres("shorts");
    });

    $(document).on('click', "#mujerBusos", function () {
        cargarFiltrosMujeres("busos");
    });

    $(document).on('click', "#mujerFaldas", function () {
        cargarFiltrosMujeres("faldas");
    });

    $(document).on('click', "#mujerPantalones", function () {
        cargarFiltrosMujeres("pantalones");
    });

    $(document).on('click', "#mujerCamisas", function () {
        cargarFiltrosMujeres("camisas");
    });

    $(document).on('keyup', "#buscarProductoMujer", function () {
        var filtro = $(this).val();
        if (filtro != "") {
            cargarFiltrosMujeres(filtro);
        } else {
            cargarFiltrosMujeres();
        }
    });

    $(document).on('click', ".like", function () {
        $(this).toggleClass('activado');
        var opcion = "";
        if ($(this).hasClass('activado')) {
            opcion = "añadir";
        } else {
            opcion = "eliminar";
        }
        var datos = {
            productoFavorito: $(this).data("id"),
            transaccion: opcion
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (!respuesta["exito"]) {
                    location.reload();
                } else {
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },

            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    });

});
