<?php

if (isset($_SESSION['Cliente'])) {
  $user = unserialize($_SESSION["Cliente"]);
  if ($user instanceof AdministradorDTO) { 
    echo '<div id="live-chat">
    <header class="clearfix">
      <a href="#" class="chat-close">x</a>
      <h4 class="text-white">Mensajes</h4>
      <span class="chat-message-counter" id="cantidadMensajes"></span>
    </header>
    <div class="chat">
      <div class="chat-history" id="historialMensajes">
        
      </div>
      <div class="container pb-2 pt-2" style="background: #1b2126;">
      <button class="btn btn-danger btn-block" id="btnEliminarMensaje" ><i class="fas fa-broom mr-2"></i>Borrar Historial</button>
      </div>
    </div>
  </div>
  ';
  }
}

?>

<footer class="footer has-cards">
  <div class="row">
    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
      <div class="px-4">
        <img src="vista/presentacion/img/edyson.png" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
        <div class="pt-4 text-center">
          <h5 class="title">
            <span class="d-block mb-1">Integrante 1</span>
            <small class="h6 text-muted">Lider Proyecto</small>
          </h5>
          <div class="mt-3">
            <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
      <div class="px-4">
        <img src="vista/presentacion/img/duvan.png" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
        <div class="pt-4 text-center">
          <h5 class="title">
            <span class="d-block mb-1">Integrante 2</span>
            <small class="h6 text-muted">Documentador</small>
          </h5>
          <div class="mt-3">
            <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
      <div class="px-4">
        <img src="vista/presentacion/img/leonel.png" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
        <div class="pt-4 text-center">
          <h5 class="title">
            <span class="d-block mb-1">Integrante 3</span>
            <small class="h6 text-muted">Desarrollador Web</small>
          </h5>
          <div class="mt-3">
            <a href="#" class="btn btn-success btn-icon-only rounded-circle">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="btn btn-success btn-icon-only rounded-circle">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-success btn-icon-only rounded-circle">
              <i class="fab fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row row-grid align-items-center my-md">
      <div class="col-lg-6">
        <h3 class="text-primary font-weight-light mb-2">¡Gracias por apoyarnos!</h3>
        <h4 class="mb-0 font-weight-light">Pongámonos en contacto con cualquiera de estas plataformas.</h4>
      </div>
      <div class="col-lg-6 text-lg-center btn-wrapper">
        <a target="_blank" href="#" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip" data-original-title="Síganos en Twitter">
          <i class="fab fa-twitter"></i>
        </a>
        <a target="_blank" href="#" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" data-original-title="Me gusta en Facebook">
          <i class="fab fa-facebook-square"></i>
        </a>
        <a target="_blank" href="#" class="btn btn-neutral btn-icon-only btn-instagram btn-lg btn-round" data-toggle="tooltip" data-original-title="Síguenos en Instagram">
          <i class="fab fa-instagram"></i>
        </a>
        <a target="_blank" href="#" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip" data-original-title="Danos una estrella en Github">
          <i class="fab fa-github"></i>
        </a>
      </div>
    </div>
    <hr>
    <div class="row align-items-center justify-content-md-between">
      <div class="col-md-6">
        <div class="copyright">
          &copy; 2019
          <a href="#" target="_blank">Edyson Leal</a>.
        </div>
      </div>
      <div class="col-md-6">
      </div>
    </div>
  </div>
</footer>