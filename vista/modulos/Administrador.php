<?php
if (!isset($_SESSION["Cliente"])) {
    header("location:Ingresar");
} else {
    $user = unserialize($_SESSION['Cliente']);
    if ($user instanceof ClienteDTO) {
        header("location:Perfil");
    }
}
?>
<section class="section pb-6 bg-gradient-warning">
    <br>
    <br>
    <div class="container">
        <h1 class="text-white">Gestionar Productos <i class="fas fa-tools"></i></h1><hr>
        <div class="row row-grid align-items-center m-2">
            <div class="col-lg-4 order-lg-2 ml-lg-auto">
                <div class="position-relative pl-md-5">
                    <img src="vista/presentacion/img/ill-2.svg" class="img-center img-fluid">
                </div>
            </div>
            <div class="col-lg-8 order-lg-1 accordion" id="accordionExample">
                <div class="card shadow shadow-lg--hover">
                    <div class="card-body">
                        <div class="container m-0 p-0">
                            <div>
                                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <button class="btn btn-link display-2 title text-success" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Crear producto
                                </button>
                            </div>
                            <div style="margin:0;padding:0;">
                                <div id="collapseOne" class="collapse m-0 p-0" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <p>Diligencie los datos para añadir un nuevo producto, todos los datos son necesarios.</p>
                                    <form id="formCrearProducto" method="post">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tshirt"></i></span>
                                                </div>
                                                <input class="form-control" name="nombreProducto" id="nombreProducto" placeholder="Nombre" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                <input class="form-control" name="precioProducto" id="precioProducto" placeholder="Precio" type="number" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-award"></i></span>
                                                </div>
                                                <input class="form-control" name="marcaProducto" id="marcaProducto" placeholder="Marca" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <select class="form-control" name="generoProducto" id="generoProducto" required>
                                                    <option value="" disabled selected>Seleccione un Género</option>
                                                </select>
                                            </div>
                                        </div>
                                        <p>Tallas disponibles:</p>
                                        <div class="row" id="tallasProducto">

                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                </div>
                                                <select name="categoriaProducto" id="categoriaProducto" class="form-control" required>
                                                    <option value="" disabled selected>Seleccione una Categoria</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                                </div>
                                                <select name="colorProducto" id="colorProducto" class="form-control" required>
                                                    <option value="" disabled selected>Seleccione un Color</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-toilet-paper"></i></span>
                                                </div>
                                                <select name="telasProducto" id="telasProducto" class="form-control" required>
                                                    <option value="" disabled selected>Seleccione una Tela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                </div>
                                                <textarea class="form-control" id="descripcionProducto" rows="3" name="descripcionProducto" placeholder="Descripción" required></textarea>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-plus mr-2"></i>Crear Producto</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow shadow-lg--hover mt-2">
                        <div class="card-body">
                            <div class="container m-0 p-0">
                                <div>
                                    <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                    <button class="btn btn-link display-3 title text-success" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Ver Productos
                                    </button>
                                </div>
                                <div class="margin:0;padding:0;">
                                    <div id="collapseTwo" class="collapse m-0 p-0" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body mt-2"><br>
                                            <div class="nav-wrapper">
                                                <ul class="nav nav-pills nav-pills-circle flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                                    <li data-toggle="tooltip" data-original-title="Mujeres" class="nav-item">
                                                        <a class="nav-link rounded-circle mb-sm-3 mb-md-0 active" id="filtrarMujeres" data-toggle="tab" href="#mujeres" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-venus"></i></a>
                                                    </li>
                                                    <li data-toggle="tooltip" data-original-title="Hombres" class="nav-item">
                                                        <a class="nav-link mb-sm-3 mb-md-0" id="filtrarHombres" data-toggle="tab" href="#hombres" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-mars"></i></a>
                                                    </li>
                                                    <li data-toggle="tooltip" data-original-title="Niños" class="nav-item">
                                                        <a class="nav-link mb-sm-3 mb-md-0" id="filtrarChicos" data-toggle="tab" href="#nino" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-child"></i></a>
                                                    </li>
                                                    <li data-toggle="tooltip" data-original-title="Niñas" class="nav-item">
                                                        <a class="nav-link mb-sm-3 mb-md-0" id="filtrarChicas" data-toggle="tab" href="#nina" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-female"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="mujeres" role="tabpanel" aria-labelledby="filtrarMujeres">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-alternative">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text  bg-default"><i class="fas fa-search"></i></span>
                                                                    </div>
                                                                    <input data-toggle="tooltip" data-original-title="Filtrar Productos" class="form-control bg-default" name="filtrarMujeresAdministrador" id="filtrarMujeresAdministrador" placeholder="Buscar" type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive w-100 m-0 p-0" style="height: 350px;">
                                                                <table class="table table-hover table-light">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nombre</th>
                                                                            <th scope="col">Precio</th>
                                                                            <th scope="col">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="cargarProductoMujeresAdmin">

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="hombres" role="tabpanel" aria-labelledby="filtrarHombres">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-alternative">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text  bg-default"><i class="fas fa-search"></i></span>
                                                                    </div>
                                                                    <input data-toggle="tooltip" data-original-title="Filtrar Productos" class="form-control bg-default" name="filtrarHombresAdministrador" id="filtrarHombresAdministrador" placeholder="Buscar" type="text" required>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive w-100 m-0 p-0" style="height: 350px;">
                                                                <table class="table table-hover table-light">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nombre</th>
                                                                            <th scope="col">Precio</th>
                                                                            <th scope="col">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="cargarProductoHombresAdmin">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nino" role="tabpanel" aria-labelledby="filtrarChicos">
                                                            <div class="table-responsive w-100 m-0 p-0" style="height: 350px;">
                                                                <table class="table table-hover table-light">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nombre</th>
                                                                            <th scope="col">Precio</th>
                                                                            <th scope="col">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="cargarProductoChicosAdmin">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nina" role="tabpanel" aria-labelledby="filtrarChicas">
                                                            <div class="table-responsive w-100 m-0 p-0" style="height: 350px;">
                                                                <table class="table table-hover table-light">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Nombre</th>
                                                                            <th scope="col">Precio</th>
                                                                            <th scope="col">Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="cargarProductoChicasAdmin">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="actualizarProducto" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card bg-secondary shadow border-0">
                                                            <div class="card-header bg-white pb-5">
                                                                <div class="card-body py-lg-5">
                                                                    <div class="text-center text-muted mb-4">
                                                                        <h4>Actualizar Producto <i class="fas fa-sync-alt fa-spin"></i></h4>
                                                                    </div>
                                                                    <form role="form" method="POST" id="formActualizarProducto">
                                                                    <input name="idProductoActualizar" id="idProductoActualizar" type="hidden" required>
                                                                        <div class="form-group mb-3">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-tshirt"></i></span>
                                                                                </div>
                                                                                <input class="form-control" name="nombreActualizarProducto" id="nombreActualizarProducto" placeholder="Nombre" type="text" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                                </div>
                                                                                <input class="form-control" name="precioActualizarProducto" id="precioActualizarProducto" placeholder="Precio" type="number" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-award"></i></span>
                                                                                </div>
                                                                                <input class="form-control" name="marcaActualizarProducto" id="marcaActualizarProducto" placeholder="Marca" type="text" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                                                </div>
                                                                                <select name="categoriaActualizarProducto" id="categoriaActualizarProducto" class="form-control" required>
                                                                                    <option value="" disabled selected>Seleccione una Categoria</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-tint"></i></span>
                                                                                </div>
                                                                                <select name="colorActualizarProducto" id="colorActualizarProducto" class="form-control" required>
                                                                                    <option value="" disabled selected>Seleccione un Color</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-toilet-paper"></i></span>
                                                                                </div>
                                                                                <select name="telasActualizarProducto" id="telasActualizarProducto" class="form-control" required>
                                                                                    <option value="" disabled selected>Seleccione una Tela</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="input-group input-group-alternative">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                                                </div>
                                                                                <textarea class="form-control" id="descripcionActualizarProducto" rows="3" name="descripcionActualizarProducto" placeholder="Descripción" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-primary my-4"><i class="fas fa-sync-alt mr-2"></i>Actualizar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>