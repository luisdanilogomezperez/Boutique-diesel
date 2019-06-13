$(document).ready(function () {

  $("#opcionesActualizarFoto").hide();
  $("#botonesFotoProducto").hide();

  $("#fotoCliente").click(function () {
    $("#opcionesActualizarFoto").show();
  });

  $("#labelImagen").click(function () {
    $("#botonesFotoProducto").show();
  });

  $("#cancelarFotoProducto").click(function () {
    $("#botonesFotoProducto").hide();
    location.reload();
  });


  var mayusculas = new RegExp("^(?=.*[A-Z])");
  var minusculas = new RegExp("^(?=.*[a-z])");
  var numeros = new RegExp("^(?=.*[0-9])");
  var longitud = new RegExp("^(?=.{8,})");
  var especiales = new RegExp("^(?=.*[!@#$&.*])");

  $("#registrarContrasenia").on("keyup", function () {
    var contraseña = $("#registrarContrasenia").val();
    document.getElementById("alertaSeguridad").innerHTML = "";

    if (mayusculas.test(contraseña) && minusculas.test(contraseña) && numeros.test(contraseña) && longitud.test(contraseña) && especiales.test(contraseña)) {
      $("#alertaSeguridad").append('<small>seguridad de la contraseña:\n\
          <span class="text-success font-weight-700">Fuerte</span>\n\
        </small>');
    } else if (minusculas.test(contraseña) && numeros.test(contraseña) && longitud.test(contraseña)) {
      $("#alertaSeguridad").append('<small>seguridad de la contraseña:\n\
          <span class="text-warning font-weight-700">Medio</span>\n\
        </small>');
    } else {
      $("#alertaSeguridad").append('<small>seguridad de la contraseña:\n\
          <span class="text-danger font-weight-700">Debil</span>\n\
        </small>');
    }
  });

  $("#contraseniaNueva").on("keyup", function () {
    var contraseña = $("#contraseniaNueva").val();
    document.getElementById("alertaSeguridad2").innerHTML = "";

    if (mayusculas.test(contraseña) && minusculas.test(contraseña) && numeros.test(contraseña) && longitud.test(contraseña) && especiales.test(contraseña)) {
      $("#alertaSeguridad2").append('<small>seguridad de la contraseña:\n\
          <span class="text-success font-weight-700">Fuerte</span>\n\
        </small>');
    } else if (minusculas.test(contraseña) && numeros.test(contraseña) && longitud.test(contraseña)) {
      $("#alertaSeguridad2").append('<small>seguridad de la contraseña:\n\
          <span class="text-warning font-weight-700">Medio</span>\n\
        </small>');
    } else {
      $("#alertaSeguridad2").append('<small>seguridad de la contraseña:\n\
          <span class="text-danger font-weight-700">Debil</span>\n\
        </small>');
    }
  });

  var ver = false;
  $("#btnVerContrasenia").click(function () {
    if (!ver) {
      $("#registrarContrasenia").attr("type", "text");
      $("#iconoVer").removeClass("fa-eye").addClass("fa-eye-slash");
      ver = true;
    } else {
      $("#registrarContrasenia").attr("type", "password");
      $("#iconoVer").removeClass("fa-eye-slash").addClass("fa-eye");
      ver = false;
    }
  });

  $("#btnVerContrasenia2").click(function () {
    if (!ver) {
      $("#ingresarContrasenia").attr("type", "text");
      $("#iconoVer2").removeClass("fa-eye").addClass("fa-eye-slash");
      ver = true;
    } else {
      $("#ingresarContrasenia").attr("type", "password");
      $("#iconoVer2").removeClass("fa-eye-slash").addClass("fa-eye");
      ver = false;
    }
  });


  $(document).on("click", ".more", function () {
    var id = $(this).data("id");
    var back = ".seleccion2"+id;
    var front = ".seleccion"+id;
    $(back).addClass('active');
    $(front).removeClass('active');
  });

  $(document).on("click", ".go-back", function () {
    var id = $(this).data("id");
    var back = ".seleccion2"+id;
    var front = ".seleccion"+id;
    $(back).removeClass('active');
    $(front).addClass('active');
  });

  $('.ir-arriba').click(function () {
    $('body, html').animate({
        scrollTop: '0px'
    }, 1000);
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
        $('.ir-arriba').slideDown(500);
    } else {
        $('.ir-arriba').slideUp(500);
    }

});

if($("#ocultar").is(':visible')){
  $("header").hide();
  $("footer").hide();
}

if($("#bienvenida").is(':visible')){
  $("header").hide();
  $("footer").hide();
}

$('.chat').slideToggle(100, 'swing');
  $('.chat-message-counter').fadeToggle(100, 'swing');

$('#live-chat header').on('click', function() {
  $('.chat').slideToggle(300, 'swing');
  $('.chat-message-counter').fadeToggle(300, 'swing');
});

$('.chat-close').on('click', function(e) {

  e.preventDefault();
  $('#live-chat').fadeOut(300);

});

});