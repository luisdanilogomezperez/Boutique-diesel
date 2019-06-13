$(document).ready(function () {

    $(cargarChat());

    $("#formContacto").validate({

        rules:
        {
            nombreMensaje: { required: true },
            correoMensaje: { required: true },
            asuntoMensaje: { required: true },
            textoMensaje: { required: true }
        },
        messages:
        {
            nombreMensaje: { required: '<p style="color:red;">✘</p>' },
            correoMensaje: { required: '<p style="color:red;">✘</p>' },
            asuntoMensaje: { required: '<p style="color:red;">✘</p>' },
            textoMensaje: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {

            var datos = {
                nombreMensaje: $("#nombreMensaje").val(),
                correoMensaje: $("#correoMensaje").val(),
                asuntoMensaje: $("#asuntoMensaje").val(),
                textoMensaje: $("#textoMensaje").val()
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
                        $("#nombreMensaje").val("");
                        $("#correoMensaje").val("");
                        $("#asuntoMensaje").val("");
                        $("#textoMensaje").val("");
                        exito("Listo!", "Pronto recibirás nuestra respuesta.");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error!", "Ya tiene un mensaje en tramite de respuesta.");
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

    function cargarChat() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarMensajes=true',
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                var cantidad = respuesta.length;
                if(cantidad < 1){
                    html = "<p>No tiene mensajes</p>";
                }else{
                    for (var i in respuesta) {
                        html += '<a target="_blank" href="mailto:' + respuesta[i].correo + '?subject=' + respuesta[i].asunto + '" class="chat-message clearfix">\n\
                        <img src="https://images.vexels.com/media/users/3/136497/isolated/preview/4a0c161a0b2cc3b23395675e5aaaf73c-icono-cuadrado-de-mensaje-abierto-by-vexels.png" alt="" width="32" height="32">\n\
                        <div class="chat-message-content clearfix">\n\
                          <span class="chat-time">'+ respuesta[i].fechacreacion + '</span>\n\
                          <h5>'+ respuesta[i].nombre + '</h5>\n\
                          <p style="color:black;">'+ respuesta[i].mensaje + '</p>\n\
                        </div>\n\
                      </a>\n\
                      <hr>';
                    }
                }
                document.getElementById('cantidadMensajes').innerHTML = cantidad;
                $("#historialMensajes").html(html);
            }
        });
    }

    $("#btnEliminarMensaje").click(function () {
        swal({
            title: "Esta seguro?",
            text: "Asegurese de haber contestado todos los mensajes, antes de eliminarlos!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: 'vista/modulos/Ajax.php?eliminarMensajes=true',
                        dataType: 'json',
                        success: function (respuesta) {
                            if (respuesta["exito"]) {
                                cargarChat();
                            } else if (!respuesta["exito"]) {
                                respuestaError("Error!", "No se pudierón eliminar los mensajes");
                            }
                        }
                    });
                } else {
                    swal("Ok!, Recuerde responder todos los mensajes antes de eliminarlos.");
                }
            });
    });

});