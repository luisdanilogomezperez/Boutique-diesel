<?php

if (!isset($_SESSION["Cliente"])) {
    header("location:Ingresar");
} else {
    $user = unserialize($_SESSION['Cliente']);
    if ($user instanceof AdministradorDTO) {
        header("location:Administrador");
    }
}

?>

<main class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
        <!-- Circles background -->
        <div class="shape shape-style-1 shape-primary alpha-4">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="card card-profile shadow mt--300">
                <div class="px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">

                                <form action="cargarFotoPerfilCliente" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    <?php
                                    $user = unserialize($_SESSION["Cliente"]);
                                    echo '<input type="hidden" value="' . $user->getId() . '" name="idCliente" id="idCliente" />
                                <input type="hidden" value="' . $user->getFoto() . '" name="fotoActualCliente" id="fotoActualCliente" />
                                <label id="fotoCliente" for="imagen" data-toggle="tooltip" title="Cambiar Foto">
                               <img src="' . $user->getFoto() . '" id="fotoPerfilCliente" width="800" higth="800" class="rounded-circle fotoPerfilCliente">
                               </label>';
                                    ?>
                                    <input id="imagen" data-id="cliente" name="imagen" type="file" required />
                                    <div id="opcionesActualizarFoto">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <button type="submit" id="btnActualizarFotoCliente" class="btn btn-success ml-4"><i class="fas fa-check"></i></button>
                                        <a href="Perfil" id="btnCancelarActualizarFotoCliente" class="btn btn-danger ml-4"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                            <div class="card-profile-actions py-4 mt-lg-0">
                                <a href="#" class="btn btn-sm btn-info mr-4"><i class="fas fa-store mr-2"></i>Tienda</a>
                                <a href="Salir" class="btn btn-sm btn-default float-right"><i class="fas fa-power-off mr-2"></i> Salir</a>
                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-1">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading" id="cantidadFavoritos"></span>
                                    <span class="description">Favoritos</span>
                                </div>
                                <div>
                                    <span class="heading">5000</span>
                                    <span class="description">Puntos</span>
                                </div>
                                <div>
                                    <span class="heading" id="cantidadCompras"></span>
                                    <span class="description">Compras</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <?php
                        $año = date("Y");
                        $nacio = DateTime::createFromFormat('Y-m-d', $user->getFechaNacimiento());
                        $añoNacimiento = $nacio->format('Y');
                        if (strcmp($año, $añoNacimiento) == 0) {
                            $añoNacimiento--;
                        }
                        $edad = $año - $añoNacimiento;

                        echo '<h3>' . $user->getNombres() . ' ' . $user->getApellidos() . '
                        <span class="font-weight-light">, ' . $edad . '</span>
                        </h3>';
                        ?>
                        <?php
                        echo '<div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>'.$user->getDireccion().'</div>
                        <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>' . $user->getCorreo() . '</div>
                        <div><i class="ni education_hat mr-2"></i>Universidad Francisco de Paula Santander</div>';
                        ?>
                    </div>

                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-edit mr-2"></i>Actualizar Datos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-lock mr-2"></i>Cambiar Contraseña</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-shopping-cart mr-2"></i>Mis Compras</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade row" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="alert-inner--text"><strong>Información!</strong> Cambie los datos que desea actualizar, los cambios se reflejan al instante.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="col-lg-8 mx-auto">
                                        <form role="form" method="POST" id="formActualizar">
                                            <div class="form-group mb-3">
                                                <?php
                                                echo '<input type="hidden" name="actualizarId" id="actualizarId" value="' . $user->getId() . '">';
                                                ?>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarNombres" id="actualizarNombres" placeholder="Nombre" type="text" value="' . $user->getNombres() . '"  required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarApellidos" id="actualizarApellidos" placeholder="Apellidos" value="' . $user->getApellidos() . '" type="text" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarDireccion" id="actualizarDireccion" placeholder="Direccion" value="' . $user->getDireccion() . '" type="text" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarDocumento" id="actualizarDocumento" placeholder="Documento" value="' . $user->getDocumento() . '" type="number" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarCorreo" id="actualizarCorreo" placeholder="Correo" value="' . $user->getCorreo() . '" type="text" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control datepicker" name="actualizarFechaNacimiento" id="actualizarFechaNacimiento" placeholder="Fecha de Nacimiento" data-date-format="yyyy-mm-dd" value="' . $user->getFechaNacimiento() . '" type="text" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary my-4"><i class="fas fa-sync-alt mr-2"></i> Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="alert-inner--text"><strong>Información!</strong> Si olvido su contraseña, cambiela por una más segura y facil de recordar.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="col-lg-8 mx-auto">
                                        <form role="form" method="POST" id="formCambiarContrasenia">
                                            <div class="form-group mb-3">
                                                <?php
                                                echo '<input type="hidden" name="actualizarContraseniaId" id="actualizarContraseniaId" value="' . $user->getId() . '">';
                                                ?>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    </div>
                                                    <input class="form-control" name="contraseniaActual" id="contraseniaActual" placeholder="Contraseña Actual" type="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input class="form-control" name="contraseniaNueva" id="contraseniaNueva" placeholder="Contraseña Nueva" type="password" required>
                                                </div>
                                            </div>
                                            <div class="text-muted font-italic" id="alertaSeguridad2">
                                            </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4"><i class="fas fa-sync-alt mr-2"></i> Cambiar</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade show active" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                    <div class="row" id="mostrarFacturas">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 py-5 border-top text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <p>¡Gracias por preferinos y hacernos su visita! Estamos contentos de ayudar a que encuentre lo que está buscando. Nuestro objetivo es que siempre esté satisfecho, así que esperamos elevar su nivel de satisfacción. Esperamos volver a verle de nuevo. ¡Que tengas un gran día!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>