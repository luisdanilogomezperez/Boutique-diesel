<?php
if (!isset($_SESSION["Cliente"])) {
    header("location:Ingresar");
} else {
    $user = unserialize($_SESSION['Cliente']);
    $id = htmlentities($_GET['id']);
    echo '<input type="hidden" id="idProductoMostrar" value="' . $id . '">
    ';
}
?>
<section class="section" style="background:#adb5bd">
    <br>
    <br>
    <br>
    <div class="container bg-secondary">
        <div class="row row-grid align-items-center border-0">
            <div class="col-md-6 border-0">
                <div class="card bg-default shadow border-0">


                    <?php
                    if ($user instanceof AdministradorDTO) {
                        echo '<form action="cargarFotoPerfilProducto" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="idProductoCargarFoto"     name="idProductoCargarFoto" value="' . $id . '">
                            <input type="hidden" id="productoFotoActual" name="productoFotoActual" value="">
                            <input type="hidden" id="productoGenero" name="productoGenero" value="">
                            <label id="labelImagen" for="imagen"><img src="" id="fotoProducto" data-toggle="tooltip" title="Cambiar Foto" alt="Error al cargar imagen" class="card-img-top fotoPerfilCliente"></label>
                            <input id="imagen" data-id="producto" class="hide" name="imagen" type="file" required />
    
                            <div id="botonesFotoProducto" class="text-center mt-2">
                                <button type="submit" class="btn btn-success" style="z-index:555555;"><i class="fas fa-check"></i></button>
                                <button type="button" id="cancelarFotoProducto" style="z-index:555555;" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
                            </div>
                        </form>';
                    } else {
                        echo '<img src="" id="fotoProducto" alt="Error al cargar imagen" class="card-img-top">';
                    }
                    ?>

                    <blockquote class="card-blockquote" id="saltoAdministrador">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="svg-bg">
                            <polygon points="0,52 583,95 0,95" class="fill-default" />
                            <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default" />
                        </svg>
                        <div id="tituloProducto">

                        </div>
                        <?php
                        if ($user instanceof AdministradorDTO) {
                            echo '<form action="cargarFotosProductos" method="post" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="productoCargarFotos" value="' . $id . '" id="productoCargarFotos">
                            <input type="hidden" id="generoCargarFotos" name="generoCargarFotos" value="">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-images"></i></span>
                                    </div>
                                    <input class="form-control" name="imagenesProducto[]" data-id="fotos" id="imagenesProducto" type="file" multiple required>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                </div>
                            </div>
                        </form>';
                        }
                        ?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#mostrarGaleria">Ver Galeria</button>
                    </blockquote>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pl-md-5">
                    <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle mb-5">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <a href="" id="volver" class="btn btn-default ml-2"><i class="fas fa-undo-alt mr-2"></i>Volver</a>
                    <a href="Carrito" class="btn btn-default ml-2"><i class="fas fa-undo-alt mr-2"></i>Ir al Carrito</a>
                    <h1 id="verPrecioProducto"></h1>
                    <p class="lead" id="verRefProducto"></p>
                    <p class="lead" id="verColorProducto"></p>
                    <?php
                    if ($user instanceof ClienteDTO) {
                        echo ' <form method="post" id="formAñadirCarrito">
                        <div class="row">
                            <div class="col-lg-4">
                                <select class="form-control" name="seleccionarTalla" id="seleccionarTalla" required>
                                    <option value="" disabled selected>Talla</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default m-2"><i class="fas fa-cart-plus mr-2"></i>Añadir al carrito</button>
                        <svg id="successAnimation" class="" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70">
                        <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z" />
                        <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent" />
                        <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent" />
                    </svg>
                    </form>';
                    }
                    ?>
                    <hr>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-default btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Cual es mi Talla
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="lead">Guia de Tallas disponibles para este Producto.</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-dark text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Talla</th>
                                                    <th scope="col">Pecho(cm)</th>
                                                    <th scope="col">Cintura(cm)</th>
                                                    <th scope="col">Cadera(cm)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cargarTablaTallas">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-default btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Descripción y cuidados
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body" id="verDescripcionProducto">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-default btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Cambios y Garantias
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Nosotros pagamos todos los gastos de envío.<br>
                                    <strong>Cambios:</strong> Tienes 30 días desde que llega tu ropa para hacer el cambio. <br>
                                    <strong>Garantias:</strong> Tienes 60 días desde que llega tu ropa para hacer la garantía
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="mostrarGaleria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-gradient-ligth">
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" id="cargarGaleriaFotos">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>