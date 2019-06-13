
function ingresoExitoso(titulo, mensaje) {
    swal({
        title: titulo,
        text: mensaje,
        icon: "success",
        button: "Continuar"
    });
    window.setTimeout(function () {
        location.reload();
    }, 1000);
}

function exito(titulo, mensaje) {
    swal({
        title: titulo,
        text: mensaje,
        icon: "success",
        button: "Continuar"
    });
}

function respuestaInfoEspera(mensaje) {
    swal({
        text: mensaje,
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        icon: "info"
    });
}

function respuestaError(titulo, mensaje) {
    swal({
        title: titulo,
        text: mensaje,
        icon: "error"
    });
}

function respuestaErrorConEspera(titulo, mensaje) {
    swal({
        title: titulo,
        text: mensaje,
        icon: "error"
    });
    window.setTimeout(function () {
        location.reload();
    }, 1800);
}

function preguntar(pregunta,boton1,boton2){
    swal ( pregunta , { 
  botones : [ boton1 , boton2 ] ,  
} ) ;
}
