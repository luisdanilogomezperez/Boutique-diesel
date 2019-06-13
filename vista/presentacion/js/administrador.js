$(document).ready(function(){

    $(cargarSelectGenero());
    $(cargarSelectCategoria());
    $(cargarSelectColores());
    $(cargarSelectTelas());

    function cargarSelectGenero(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?cargarGeneros=true',
            dataType: "json",
            
            success: function (respuesta)
            {
                for(var i in respuesta){
                    $("#generoProducto").append('<option data-id="'+respuesta[i].id+'" value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                }
            },
            
            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    function cargarSelectCategoria(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?cargarCategorias=true',
            dataType: "json",
            
            success: function (respuesta)
            {
                for(var i in respuesta){
                    $("#categoriaProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                    $("#categoriaActualizarProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                }
            },
            
            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    function cargarSelectColores(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?cargarColores=true',
            dataType: "json",
            
            success: function (respuesta)
            {
                for(var i in respuesta){
                    $("#colorProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                    $("#colorActualizarProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                }
            },
            
            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    function cargarSelectTelas(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?cargarTelas=true',
            dataType: "json",
            
            success: function (respuesta)
            {
                for(var i in respuesta){
                    $("#telasProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                    $("#telasActualizarProducto").append('<option value="'+respuesta[i].id+'">'+respuesta[i].nombre+'</option>');
                }
            },
            
            error: function(jqXHR,estado,error){
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    $("#generoProducto").on('click', function(){
        var generoSeleccionado = $(this).find(':selected').data('id');
        if(generoSeleccionado !== undefined){
            var datos = {
                cargarTallasGenero : generoSeleccionado
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data : datos,
                dataType: "json",
                
                success: function (respuesta)
                {
                    document.getElementById("tallasProducto").innerHTML="";
                    for(var i in respuesta){
                        $("#tallasProducto").append('<div class="custom-control custom-checkbox ml-3 mb-3">\n\
                        <input class="custom-control-input obtenerTalla" name="tallas" value="'+respuesta[i].id+'" id="'+respuesta[i].id+'" type="checkbox">\n\
                        <label class="custom-control-label" for="'+respuesta[i].id+'">'+respuesta[i].numero+'</label>\n\
                    </div>');
                    }
                },
                
                error: function(jqXHR,estado,error){
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            }); 
        }
    });

    $("#formCrearProducto").validate({
        rules:
        {
          nombreProducto:{required:true},
          precioProducto:{required:true},
          marcaProducto:{required:true},
          generoProducto:{required:true},
          categoriaProducto:{required:true},
          colorProducto:{required:true},
          telasProducto:{required:true},
          descripcionProducto:{required:true}
        },
        messages:
        {
          nombreProducto:{required:'<p style="color:red;">✘</p>'},
          precioProducto:{required:'<p style="color:red;">✘</p>'},
          marcaProducto:{required:'<p style="color:red;">✘</p>'},
          generoProducto:{required:'<p style="color:red;">✘</p>'},
          categoriaProducto:{required:'<p style="color:red;">✘</p>'},
          colorProducto:{required:'<p style="color:red;">✘</p>'},
          descripcionProducto:{required:'<p style="color:red;">✘</p>'},
          telasProducto:{required:'<p style="color:red;">✘</p>'}
        },
    
        submitHandler:function(){
    
            var tallas = [];
            $(".obtenerTalla").each(function(){
                if($(this).is(':checked')){
                    tallas.push($(this).val());
                }
            });

            if(tallas.length<1){
                respuestaError("Error!", "Debe Seleccionar al menos una Talla");
            }else{
                
            var datos = {
                nombreProducto: $("#nombreProducto").val(),
                precioProducto: $("#precioProducto").val(),
                marcaProducto: $("#marcaProducto").val(),
                descripcionProducto: $("#descripcionProducto").val(),
                generoProducto: $("select[name=generoProducto]").val(),
                categoriaProducto: $("select[name=categoriaProducto]").val(), 
                colorProducto: $("select[name=colorProducto]").val(), 
                telasProducto: $("select[name=telasProducto]").val(),
                tallasProducto:tallas
            }
    
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",
               
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },
                
                success: function (respuesta)
                {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Exito!","Se ha creado un nuevo Producto");
                    } else if(!respuesta["exito"]) {
                        respuestaError("Error!", "Ya existe el Producto");
                    }
                },
                
                error: function(jqXHR,estado,error){
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });
            }
    
        }
    
    });

    $("#filtrarMujeres").click(filtrarMujeres("undefined"));

    $("#filtrarHombres").click(function(){
        filtrarHombres('undefined');
    });

    $("#filtrarChicos").click(function(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosNino=true&filtronino=undefined',
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                for (var i in respuesta) {
                    html += '<tr>\n\
                    <th scope="row">'+(i+1)+'</th>\n\
                    <td>'+respuesta[i].nombre+'</td>\n\
                    <td>'+respuesta[i].precio+'</td>\n\
                    <td>\n\
                        <button type="button" data-toggle="modal" data-target="#actualizarProducto" id="btnActualizarProducto" data-id="'+respuesta[i].id+'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>\n\
                        <a href="Inventario='+respuesta[i].id+'" data-toggle="tooltip" data-original-title="Inventario" class="btn btn-warning btn-sm"><i class="fas fa-dolly-flatbed"></i></a>\n\
                        <a href="Producto='+respuesta[i].id+'#saltoAdministrador" data-toggle="tooltip" data-original-title="Fotos" class="btn btn-success btn-sm"><i class="fas fa-images"></i></a>\n\
                        <button class="btn btn-danger btn-sm"><i class="fas fa-percent"></i></button>\n\
                    </td>\n\
                </tr>';
                }
                 $("#cargarProductoChicosAdmin").html(html);
            }
        });
    });

    $("#filtrarChicas").click(function(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosNina=true&filtronina=undefined',
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                for (var i in respuesta) {
                    html += '<tr>\n\
                    <th scope="row">'+(i+1)+'</th>\n\
                    <td>'+respuesta[i].nombre+'</td>\n\
                    <td>'+respuesta[i].precio+'</td>\n\
                    <td>\n\
                        <button type="button" data-toggle="modal" data-target="#actualizarProducto" id="btnActualizarProducto" data-id="'+respuesta[i].id+'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>\n\
                        <a href="Inventario='+respuesta[i].id+'" data-toggle="tooltip" data-original-title="Inventario" class="btn btn-warning btn-sm"><i class="fas fa-dolly-flatbed"></i></a>\n\
                        <a href="Producto='+respuesta[i].id+'#saltoAdministrador" data-toggle="tooltip" data-original-title="Fotos" class="btn btn-success btn-sm"><i class="fas fa-images"></i></a>\n\
                        <button class="btn btn-danger btn-sm"><i class="fas fa-percent"></i></button>\n\
                    </td>\n\
                </tr>';
                }
                 $("#cargarProductoChicasAdmin").html(html);
            }
        });
    });

    function filtrarMujeres(filtro){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosMujeres=true&filtromujer='+filtro,
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                if(respuesta.length<1){
                    html = "<p>No se encontrarón productos</p>";
                }else{
                    for (var i in respuesta) {
                        html += '<tr>\n\
                        <th scope="row">'+(i+1)+'</th>\n\
                        <td>'+respuesta[i].nombre+'</td>\n\
                        <td>'+respuesta[i].precio+'</td>\n\
                        <td>\n\
                            <button type="button" data-toggle="modal" data-target="#actualizarProducto" id="btnActualizarProducto" data-id="'+respuesta[i].id+'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>\n\
                            <a href="Inventario='+respuesta[i].id+'" data-toggle="tooltip" data-original-title="Inventario" class="btn btn-warning btn-sm"><i class="fas fa-dolly-flatbed"></i></a>\n\
                            <a href="Producto='+respuesta[i].id+'#saltoAdministrador" data-toggle="tooltip" data-original-title="Fotos" class="btn btn-success btn-sm"><i class="fas fa-images"></i></a>\n\
                            <button class="btn btn-danger btn-sm"><i class="fas fa-percent"></i></button>\n\
                        </td>\n\
                    </tr>';
                    }
                }
                $("#cargarProductoMujeresAdmin").html(html);
            }
        });
    }

    function filtrarHombres(filtro){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosHombres=true&filtrohombre='+filtro,
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                if(respuesta.length<1){
                    html = "<p>No se encontrarón productos</p>";
                }else{
                    for (var i in respuesta) {
                        html += '<tr>\n\
                        <th scope="row">'+(i+1)+'</th>\n\
                        <td>'+respuesta[i].nombre+'</td>\n\
                        <td>'+respuesta[i].precio+'</td>\n\
                        <td>\n\
                            <button type="button" data-toggle="modal" data-target="#actualizarProducto" id="btnActualizarProducto" data-id="'+respuesta[i].id+'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>\n\
                            <a href="Inventario='+respuesta[i].id+'" data-toggle="tooltip" data-original-title="Inventario" class="btn btn-warning btn-sm"><i class="fas fa-dolly-flatbed"></i></a>\n\
                            <a href="Producto='+respuesta[i].id+'#saltoAdministrador" data-toggle="tooltip" data-original-title="Fotos" class="btn btn-success btn-sm"><i class="fas fa-images"></i></a>\n\
                            <button class="btn btn-danger btn-sm"><i class="fas fa-percent"></i></button>\n\
                        </td>\n\
                    </tr>';
                    }
                }
                $("#cargarProductoHombresAdmin").html(html);
            }
        });
    }

    $(document).on('keyup', "#filtrarMujeresAdministrador", function () {
        var filtro = $(this).val();
        if (filtro != "") {
            filtrarMujeres(filtro);
        } else {
            filtrarMujeres("undefined");
        }
    });

    $(document).on('keyup', "#filtrarHombresAdministrador", function () {
        var filtro = $(this).val();
        if (filtro != "") {
            filtrarHombres(filtro);
        } else {
            filtrarHombres("undefined");
        }
    });

    $(document).on('click', "#btnActualizarProducto", function () {
        var idProducto = $(this).data("id");
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarProductosTodos=true&filtro=todos',
            dataType: 'json',
            success: function (respuesta) {
                for(var i=0;i<respuesta.length;i++){
                    if(respuesta[i].id == idProducto){
                        $("#idProductoActualizar").val(respuesta[i].id);
                        $("#nombreActualizarProducto").val(respuesta[i].nombre);
                        $("#precioActualizarProducto").val(respuesta[i].precio);
                        $("#marcaActualizarProducto").val(respuesta[i].marca);
                        document.getElementById("descripcionActualizarProducto").innerHTML = respuesta[i].descripcion;
                        $("#categoriaActualizarProducto option[value="+ respuesta[i].idcategoria +"]").attr("selected",true);
                        $("#colorActualizarProducto option[value="+ respuesta[i].idcolor +"]").attr("selected",true);
                        $("#telasActualizarProducto option[value="+ respuesta[i].idtela +"]").attr("selected",true);
                    }
                }
            }
        });
    });

    $("#formActualizarProducto").validate({
        rules:
        {
          nombreActualizarProducto:{required:true},
          precioActualizarProducto:{required:true},
          marcaActualizarProducto:{required:true},
          categoriaActualizarProducto:{required:true},
          colorActualizarProducto:{required:true},
          telasActualizarProducto:{required:true},
          descripcionActualizarProducto:{required:true}
        },
        messages:
        {
          nombreActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          precioActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          marcaActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          categoriaActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          colorActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          descripcionActualizarProducto:{required:'<p style="color:red;">✘</p>'},
          telasActualizarProducto:{required:'<p style="color:red;">✘</p>'}
        },
    
        submitHandler:function(){
    
            var datos = {
                idProductoActualizar: $("#idProductoActualizar").val(),
                nombreActualizarProducto: $("#nombreActualizarProducto").val(),
                precioActualizarProducto: $("#precioActualizarProducto").val(),
                marcaActualizarProducto: $("#marcaActualizarProducto").val(),
                descripcionActualizarProducto: $("#descripcionActualizarProducto").val(),
                categoriaActualizarProducto: $("select[name=categoriaActualizarProducto]").val(), 
                colorActualizarProducto: $("select[name=colorActualizarProducto]").val(), 
                telasActualizarProducto: $("select[name=telasActualizarProducto]").val()
            }
    
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",
               
                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },
                
                success: function (respuesta)
                {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Exito!","Se ha actualizado el Producto");
                    } else if(!respuesta["exito"]) {
                        respuestaError("Error!", "No se pudo actualizar el producto");
                    }
                },
                
                error: function(jqXHR,estado,error){
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });
    
        }
    
    });


});