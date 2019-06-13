<div class="ir-arriba icon icon-shape rounded-circle">
<i class="fas fa-angle-up"></i>
</div>
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-5" href="Inicio">
                <h3 style="color: white;"><strong>Boutique Diesel</strong></h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="Inicio">
                                <img src="vista/presentacion/img/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                            <i class="fas fa-store d-lg-none"></i>
                            <span class="nav-link-inner--text">Catálogo</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl">
                            <div class="dropdown-menu-inner">
                                <a href="Hombres" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                        <i class="fas fa-male"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="heading text-primary mb-md-1">Hombres</h6>
                                        <p class="description d-none d-md-inline-block mb-0">Encontras gran variedad y lo ultimo en moda para Caballeros.</p>
                                    </div>
                                </a>
                                <a href="Mujeres" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-danger rounded-circle text-white">
                                        <i class="fas fa-female"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="heading text-primary mb-md-1">Mujeres</h6>
                                        <p class="description d-none d-md-inline-block mb-0">Encontras gran variedad y lo ultimo en moda para Damas.</p>
                                    </div>
                                </a>
                                <a href="Chicos" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="heading text-primary mb-md-1">Niños</h6>
                                        <p class="description d-none d-md-inline-block mb-0">Encontras gran variedad y lo ultimo en moda para Niños.</p>
                                    </div>
                                </a>
                                <a href="Carrito" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h5 class="heading text-warning mb-md-1">Carrito de Compras</h5>
                                        <p class="description d-none d-md-inline-block mb-0">Conoce los articulos que has añadido a tu pedido.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                            <i class="fab fa-html5 d-lg-none"></i>
                            <span class="nav-link-inner--text">Opciones</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="Inicio" class="dropdown-item">Inicio</a>
                            <a href="Nosotros" class="dropdown-item">Sobre Boutique</a>
                            <a href="Perfil#mostrarFacturas" class="dropdown-item">Mis Compras</a>
                        </div>
                    </li>
                    <?php
                    if (isset($_SESSION['Cliente'])) {
                        include 'modelo/dto/ClienteDTO.php';
                        include 'modelo/dto/AdministradorDTO.php';
                        $user = unserialize($_SESSION["Cliente"]);
                        if ($user instanceof ClienteDTO) {
                            echo '<li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                                <span class="nav-link-inner--text"><i class="fas fa-shopping-cart"></i></span><span class="badge" style="background:red;" id="productosEnCarrito"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl">
                                <div class="modal-header">
                                    <div style="float:left;">
                                        <h6 class="modal-title"><i class="fas fa-shopping-cart"></i> Carrito de compras</h6>
                                    </div>
                                    <div style="float:right;">
                                        <h6 class="modal-title">
                                            <p class="text-muted mb-0">Total a pagar: <strong class="text-primary" id="totalPagar"></strong>
                                        </h6>
                                    </div>
                                </div>
    
                                <div class="modal-body" id="mostrarCarrito" style="height: 250px;;overflow: scroll;overflow-x:hidden;">
    
                                    
    
                                </div>
    
                                <div class="modal-footer">
                                    <a href="Carrito" class="btn btn-primary btn-block">Ver mas</a>
                                </div>
                            </div>
                        </li>';
                        }
                    }
                    ?>
                </ul>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" title="Me gusta en Facebook">
                            <i class="fab fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" title="Síguenos en Instagram">
                            <i class="fab fa-instagram"></i>
                            <span class="nav-link-inner--text d-lg-none">Instagram</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" title="Síganos en Twitter">
                            <i class="fab fa-twitter-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Twitter</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" title="Danos una estrella en Github">
                            <i class="fab fa-github"></i>
                            <span class="nav-link-inner--text d-lg-none">Github</span>
                        </a>
                    </li>
                    <?php
                    if (!isset($_SESSION["Cliente"])) {
                        echo '<li class="nav-item d-lg-block ml-lg-4">
              <a href="Registrar" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon">
                <i class="fas fa-user-plus mr-2"></i>
                </span>
                <span class="nav-link-inner--text">Registrar</span>
              </a>
            </li>
            <li class="nav-item d-lg-block ml-lg-4">
              <a href="Ingresar" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon">
                <i class="fas fa-sign-in-alt mr-2"></i>
                </span>
                <span class="nav-link-inner--text">Iniciar Sesión</span>
              </a>
            </li>';
                    } else {
                        if ($user instanceof ClienteDTO) {
                            echo '<div class="dropdown">
                        <a href="#" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                            <img width=30 height=30 class="rounded-circle mr-2" src="' . $user->getFoto() . '" /> ' . $user->getNombres() . '
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <li>
                                <a class="dropdown-item" href="Inicio">
                                   Inicio
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="Perfil">
                                   Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="Carrito">
                                   Carrito de compras
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="Carrito#favoritos">
                                   Favoritos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="Nosotros">
                                   Sobre Boutique
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item" href="Salir">
                                   Cerrar Sesión
                                </a>
                            </li>
                        </ul>
                      </div>';
                        } else {
                            echo '<div class="dropdown">
                            <a href="#" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                                <img width=30 height=30 class="rounded-circle mr-2" src="vista/presentacion/assets/fotoadministrador.png" /> ' . $user->getNombres() . '
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                <li>
                                    <a class="dropdown-item" href="Inicio">
                                       Inicio
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="Administrador">
                                       Administrar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="Reportes">
                                       Reportes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="Nosotros">
                                       Sobre Boutique
                                    </a>
                                </li>
                                <div class="dropdown-divider"></div>
                                <li>
                                    <a class="dropdown-item" href="Salir">
                                       Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                          </div>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>