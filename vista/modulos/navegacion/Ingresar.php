<?php

if (isset($_SESSION["Cliente"])) {
  header("location:Bienvenida");
}

?>

<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 bg-gradient-default">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container pt-lg-md">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-white pb-5">
                        <div class="text-muted text-center mb-3">
                            <small>Inicia Sesión con</small>
                        </div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon">
                                    <img src="http://tese.edu.mx/imagenes2004/4989_COJOBPS.png">
                                </span>
                                <span class="btn-inner--text">Facebook</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon">
                                    <img src="https://files.merca20.com/uploads/2015/09/Captura-de-pantalla-2015-09-07-a-las-3.23.28-p.m..png">
                                </span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>O Inicia Sesión con credenciales</small>
                        </div>
                        <form role="form" method="POST" id="formIngresar">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control" name="ingresarCorreo" id="ingresarCorreo" placeholder="Correo" type="email" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Contraseña" type="password" name="ingresarContrasenia" id="ingresarContrasenia" value="" required>
                                    <button type="button" class="btn btn-outline-light" id="btnVerContrasenia2" name="btnVerContrasenia"><i id="iconoVer2" class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span>Recordarme</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4"><i class="fas fa-sign-in-alt mr-2"></i>Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="#" class="text-light" data-toggle="modal" data-target="#modal-notification">
                            <small>Olvido su Contraseña?</small>
                        </a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="Registrar" class="text-light">
                            <small>Crear una nueva cuenta</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="col-md-4">
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <form method="POST" id="formRecuperar" class="modal-content bg-gradient-danger">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Se requiere su atención.
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="fas fa-bell" style="font-size:50px;"></i>
                        <h4 class="heading mt-4">Ha olvidado su contraseña!</h4>
                        <p>Le enviaremos la contraseña a su correo electronico, recuerde cambiar la desde nuestra plataforma para una mayor seguridad.</p>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="form-control" name="recordarCorreo" id="recordarCorreo" placeholder="Correo Electronico" type="email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-white"><i class="fas fa-bullhorn mr-2"></i>Recuperar</button>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal"><i class="fas fa-times-circle mr-2"></i>Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div> 