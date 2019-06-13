<?php

    if(isset($_SESSION["Cliente"])){
        header("location:Perfil");
    }

?>


<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 bg-gradient-warning">
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
                            <small>Registrarte con</small>
                        </div>
                        <div class="text-center">
                            <a href="#" class="btn btn-neutral btn-icon mr-4">
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
                            <small>O regístrate con credenciales</small>
                        </div>
                        <form role="form" method="POST" id="formRegistrar">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarNombres" id="registrarNombres" placeholder="Nombres" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarApellidos" id="registrarApellidos" placeholder="Apellidos" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarDireccion" id="registrarDireccion" placeholder="Direccion" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarDocumento" id="registrarDocumento" placeholder="Documento" type="number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarCorreo" id="registrarCorreo" placeholder="Correo" type="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                    </div>
                                    <input class="form-control datepicker" name="registrarFechaNacimiento" id="registrarFechaNacimiento" placeholder="Fecha de Nacimiento"  data-date-format="yyyy-mm-dd" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input class="form-control" name="registrarContrasenia" id="registrarContrasenia" placeholder="Contraseña" type="password" required>
                                    <button type="button" class="btn btn-outline-light" id="btnVerContrasenia" name="btnVerContrasenia"><i id="iconoVer" class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="text-muted font-italic" id="alertaSeguridad">

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4" id="btnCrearCuenta" name="btnCrearCuenta"><i class="fas fa-user-plus mr-2"></i>Crear cuenta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 