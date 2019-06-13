$(document).ready(function () {

    $("#formRegistrar").validate({

        rules:
        {
            registrarNombres: { required: true },
            registrarApellidos: { required: true },
            registrarDireccion: { required: true },
            registrarDocumento: { required: true, number: true },
            registrarCorreo: { required: true },
            registrarFechaNacimiento: { required: true },
            registrarContrasenia: { required: true }
        },
        messages:
        {
            registrarNombres: { required: '<p style="color:red;">✘</p>' },
            registrarApellidos: { required: '<p style="color:red;">✘</p>' },
            registrarDireccion: { required: '<p style="color:red;">✘</p>' },
            registrarDocumento: { required: '<p style="color:red;">✘</p>', number: '<p style="color:red;">✘</p>' },
            registrarCorreo: { required: '<p style="color:red;">✘</p>' },
            registrarFechaNacimiento: { required: '<p style="color:red;">✘</p>' },
            registrarContrasenia: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {

            var datos = {
                registrarNombres: $("#registrarNombres").val(),
                registrarApellidos: $("#registrarApellidos").val(),
                registrarDireccion: $("#registrarDireccion").val(),
                registrarDocumento: $("#registrarDocumento").val(),
                registrarCorreo: $("#registrarCorreo").val(),
                registrarFechaNacimiento: $("#registrarFechaNacimiento").val(),
                registrarContrasenia: $("#registrarContrasenia").val()
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Exito!", "Se creo una nueva Cuenta");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error!", "El Cliente ya existe");
                    }
                },

                error: function (jqXHR, estado, error) {
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });

        }

    });

    $("#formActualizar").validate({

        rules:
        {
            actualizarNombres: { required: true },
            actualizarApellidos: { required: true },
            actualizarDireccion: { required: true },
            actualizarDocumento: { required: true, number: true },
            actualizarCorreo: { required: true },
            actualizarFechaNacimiento: { required: true }
        },
        messages:
        {
            actualizarNombres: { required: '<p style="color:red;">✘</p>' },
            actualizarApellidos: { required: '<p style="color:red;">✘</p>' },
            actualizarDireccion: { required: '<p style="color:red;">✘</p>' },
            actualizarDocumento: { required: '<p style="color:red;">✘</p>', number: '<p style="color:red;">✘</p>' },
            actualizarCorreo: { required: '<p style="color:red;">✘</p>' },
            actualizarFechaNacimiento: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {

            var datos = {
                actualizarId: $("#actualizarId").val(),
                actualizarNombres: $("#actualizarNombres").val(),
                actualizarApellidos: $("#actualizarApellidos").val(),
                actualizarDireccion: $("#actualizarDireccion").val(),
                actualizarDocumento: $("#actualizarDocumento").val(),
                actualizarCorreo: $("#actualizarCorreo").val(),
                actualizarFechaNacimiento: $("#actualizarFechaNacimiento").val()
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Exito!", "Se actualizarón sus datos");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error!", "Ocurrio un Error");
                    }
                },

                error: function (jqXHR, estado, error) {
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });

        }

    });

    $("#formCambiarContrasenia").validate({

        rules:
        {
            contraseniaActual: { required: true },
            contraseniaNueva: { required: true }
        },
        messages:
        {
            contraseniaActual: { required: '<p style="color:red;">✘</p>' },
            contraseniaNueva: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {
            swal({
                title: "Esta seguro?",
                text: "Una vez que se cambie, ¡necesitara iniciar sesión nuevamente!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var datos = {
                            contraseniaActual: $("#contraseniaActual").val(),
                            contraseniaNueva: $("#contraseniaNueva").val()
                        }
                        $.ajax({
                            url: 'vista/modulos/Ajax.php',
                            method: 'post',
                            data: datos,
                            dataType: 'json',
                            beforeSend: function () {
                                respuestaInfoEspera("Espera un momento por favor.");
                            },
                            success: function (respuesta) {
                                if (respuesta["exito"]) {
                                    ingresoExitoso("Exito", "Inicie Sesión con su nueva contraseña");
                                } else if (!respuesta["exito"]) {
                                    respuestaError("Error", "No se puede cambiar la contraseña");
                                }
                            },

                            error: function (jqXHR, estado, error) {
                                console.log(estado);
                                console.log(error);
                                console.log(jqXHR);
                            }
                        });
                    } else {
                        swal("Su contraseña no se cambió");
                    }
                });
        }

    });

    $("#formRecuperar").validate({

        rules:
        {
            recordarCorreo: { required: true }
        },
        messages:
        {
            recordarCorreo: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {
            var datos = {
                recordarCorreo: $("#recordarCorreo").val()
            }
            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: 'json',
                beforeSend: function () {
                    respuestaInfoEspera('Un momento Por favor, estamos enviando un mensaje a su correo...');
                },
                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        $("#recordarCorreo").val("");
                        exito("Listo", "Revise la bandeja de entrada de su Correo Electronico");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error", "No hay un cliente vinculado a ese Correo");
                    }
                },

                error: function (jqXHR, estado, error) {
                    console.log(estado);
                    console.log(error);
                    console.log(jqXHR);
                }
            });
        }

    });

    $(document).on('change', 'input[type=file]', function (e) {
        var TmpPath = URL.createObjectURL(e.target.files[0]);
        ruta = TmpPath;
        var opcion = $(this).data("id");
        if (opcion === "cliente") {
            $("#fotoPerfilCliente").attr('src', TmpPath);
        } else if (opcion === "producto") {
            $("#fotoProducto").attr('src', TmpPath);
        }
    });

});