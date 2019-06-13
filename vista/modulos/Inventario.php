<?php
if (!isset($_SESSION["Cliente"])) {
    header("location:Ingresar");
} else {
    $user = unserialize($_SESSION['Cliente']);
    if ($user instanceof ClienteDTO) {
        header("location:Perfil");
    }
    $id = htmlentities($_GET['id']);
    echo '<input type="hidden" id="idProductoInventario" value="' . $id . '">
    ';
}
?>
<section class="section pb-6 bg-gradient-warning">
    <br>
    <br>
    <div class="container">
        <h1 class="text-white">Controlar Inventario <i class="fas fa-dolly-flatbed"></i></h1>
        <hr>
        <div class="row row-grid align-items-center m-2">
            <div class="col-lg-6 order-lg-2 ml-lg-auto">
                <div class="position-relative pl-md-5">
                    <img src="vista/presentacion/img/ill-2.svg" class="img-center img-fluid">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <button class="btn btn-default mb-2" id="btnTallasDisponibles"><i class="fas fa-tshirt mr-2"></i>Añadir talla</button>
                <a href="Administrador" class="btn btn-default mb-2"><i class="fas fa-undo-alt mr-2"></i>Volver</a>

                <form method="POST" id="formAñadirTalla">
                    <div class="row" id="cargarCheckboxTallas">
                    </div>
                    <button type="button" id="btnFormNuevaTalla" class="btn btn-success mb-2">Crear Tallas</button>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-dark text-center">
                        <thead>
                            <tr>
                                <th scope="col">Talla</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="cargarTallasInventario">

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div data-toggle="tooltip" data-original-title="Hay suficiente cantidad en el stock" class="col-lg-4 bg-success">
                        <h5 class=" tex-center text-white text-uppercase">Alta</h5>
                    </div>
                    <div data-toggle="tooltip" data-original-title="Quedan menos de 10 Productos en el Stock" class="col-lg-4 bg-warning">
                        <h5 class=" tex-center text-white text-uppercase">Medio</h5>
                    </div>
                    <div data-toggle="tooltip" data-original-title="Quedan menos de 5 Productos en el Stock" class="col-lg-4 bg-danger">
                        <h5 class=" tex-center text-white text-uppercase">Baja</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>