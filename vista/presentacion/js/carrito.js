$(document).ready(function () {

    $(cargarCarrito());
    $(cargarProductosFavoritos());
    $("#successAnimation").hide();
    $("#formAñadirCarrito").validate({

        rules:
        {
            seleccionarTalla: { required: true }
        },
        messages:
        {
            seleccionarTalla: { required: '<p style="color:red;">Seleccione la Talla</p>' }
        },

        submitHandler: function () {
            var datos = {
                tallaProductoAñadirCarrito: $("#seleccionarTalla").val()
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        $("#successAnimation").removeClass('animated');
                        cargarCarrito();
                        $("#successAnimation").show();
                        $("#successAnimation").addClass('animated');
                    } else if (!respuesta["exito"]) {
                        $("#successAnimation").hide();
                        $("#successAnimation").removeClass('animated');
                        respuestaError("Error!", "Ya existe el Producto en el carrito, ajuste la cantidad para llevar más unidades de este producto");
                    }
                }
            });
        }

    });

    function cargarCarrito() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarcarrito=true',
            dataType: 'json',
            success: function (respuesta) {
                var cargarVentana = '';
                var cargarTabla = '';
                var total = 0;
                document.getElementById("productosEnCarrito").innerHTML = respuesta.length;

                if (respuesta.length === 0) {
                    cargarVentana = '<h6>El carrito de compras esta vacio</h6>';
                } else {
                    for (var x = 0; x < respuesta.length; x++) {
                        let cantidad = respuesta[x].cantidadllevar;
                        total = (parseInt(total) + (parseInt(respuesta[x].precio) * parseInt(cantidad)));
                        cargarVentana += '<div class="row mt-2">\n\
                        <div class="col-lg-4 text-center">\n\
                            <a href="Producto='+ respuesta[x].idproducto + '"><img src="' + respuesta[x].foto + '" width="60" height="80"></a>\n\
                        </div>\n\
                        <div class="col-lg-8 text-center">\n\
                            <h6 class="text-uppercase">'+ respuesta[x].nombre + '</h6>\n\
                            <div style="font-size:17.4px;">\n\
                                <span class="badge badge-pill badge-success"><i class="fas fa-money-bill-alt"></i> '+ respuesta[x].precio + '</span>\n\
                                <span class="badge badge-pill badge-primary">Talla: '+ respuesta[x].talla + '</span>\n\
                                <span class="badge badge-pill badge-info"><i class="fas fa-list-ol"></i> '+ respuesta[x].cantidadllevar + '</span>\n\
                                <button type="button" id="btnQuitarCarrito" data-id="'+ respuesta[x].carrito + '" style="border:none;cursor:pointer;" class="badge badge-pill badge-danger"><i class="fas fa-times"></i></button>\n\
                            </div>\n\
                        </div>\n\
                    </div>';
                        cargarTabla += '<tr>\n\
                    <th><a href="Producto='+ respuesta[x].idproducto + '"><img src="' + respuesta[x].foto + '" alt="error" height="50" width="40"></a></th>\n\
                    <td class="text-uppercase">'+ respuesta[x].nombre + '</td>\n\
                    <td>'+ respuesta[x].talla + '</td>\n\
                    <td>$'+ respuesta[x].precio + '</td>\n\
                    <td><input type="number" style="width:50px;" value="'+ respuesta[x].cantidadllevar + '"  min="1" max="' + respuesta[x].cantidad + '" name="unidadesComprar" data-id="' + respuesta[x].carrito + '"  id="unidadesComprar"></td>\n\
                    <td><button class="btn btn-danger" id="btnQuitarCarrito" data-id="'+ respuesta[x].carrito + '" ><i class="fas fa-trash-alt"></i></button></td>\n\
                </tr>';
                    }
                }
                document.getElementById("totalPagar").innerHTML = "$ " + total;
                $("#guardarTotalPagar").val(total);
                $("#mostrarCarrito").html(cargarVentana);
                $("#cargarTablaCarrito").html(cargarTabla);
                document.getElementById("mostrarTotalPagar").innerHTML = "$ " + total;
            }
        });
    }

    $(document).on("click", "#btnQuitarCarrito", function () {
        var id = $(this).data("id");
        var datos = {
            ProductoEliminarCarrito: id
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                if (respuesta["exito"]) {
                    cargarCarrito()
                } else if (!respuesta["exito"]) {
                    respuestaError("Error!", "No se encuentro el Producto");
                }
            }
        });
    })

    $(document).on("change", "#unidadesComprar", function () {
        var carrito = $(this).data("id");

        var unidadesComprar = $(this).val();
        if(unidadesComprar<1){
            respuestaErrorConEspera("Error!","La cantidad ingresada no es valida");
        }else{
            var datos = {
                carritoActualizar: carrito,
                cantidadActualizar: unidadesComprar
            }
    
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",
    
                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        cargarCarrito();
                    } else if (!respuesta["exito"]) {
                        respuestaErrorConEspera("Error!", "No tenemos esa cantidad en nuestro Stock");
                    }
                }
            });
        }
    });

    function cargarProductosFavoritos() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosFavoritos=true',
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                if(respuesta.length < 1){
                    html ="<p>No ha indicado un producto como Favorito</p>";
                }else{
                    for (let i = 0; i < respuesta.length; i++) {
                        html += '<div class="col-lg-4 mt-2">\n\
                        <a href="Producto='+respuesta[i].idproducto+'">\n\
                            <div class="libreta" style="background-image: url('+respuesta[i].foto+');background-repeat: no-repeat;background-size: cover;">\n\
                            </div>\n\
                        </a>\n\
                        </div>';
                    }
                }
                $("#mostrarFavoritos").html(html);
                document.getElementById('cantidadFavoritos').innerHTML=respuesta.length;
            }
        });
    }


});

/*

 UPDATE productotalla SET productotalla.cantidad = (SELECT culo.sobra FROM (SELECT productotalla.id AS productotalla,(productotalla.cantidad-carrito.cantidadllevar) AS sobra FROM carrito INNER JOIN productotalla ON carrito.productotalla = productotalla.id WHERE carrito.cliente = 1)AS culo WHERE productotalla.id = culo.productotalla) WHERE productotalla.id IN (SELECT carrito.productotalla FROM carrito WHERE carrito.cliente = 1);
*/