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
<section class="section section-lg bg-gradient-default">
    <div class="row m-2">
        <div class="col-lg-2 border-right rounded-left" style="background: #1b2431;">
            <a href="Salir" class="btn btn-primary btn-block mt-4"><i class="fas fa-power-off mr-2"></i>Cerrar Sesión</a></div>
        <div class="col-lg-10 rounded-right" style="background: #1b2431;">
            <div class="row m-4">
                <div class="col-sm-3" style="cursor: pointer;" id="btnDiario">
                    <div class="rounded text-white card-lift--hover" style="background: #007bff">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="lead m-2">Diario</p>
                                <h3 class="m-2 text-white" id="totaldiario"></h3>
                            </div>
                            <div class="col-lg-6">
                                <p class="lead m-2"><i class="fas fa-download m-2" style="float: right;"></i></p>
                            </div>
                        </div>
                        <hr class="m-2 p-0 bg-white">
                        <p class="text-white m-2" id="deficitdiario">
                        </p>
                    </div>
                </div>
                <div class="col-sm-3" style="cursor: pointer;" id="btnSemanal">
                    <div class="rounded text-white card-lift--hover" style="background: #28a745">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="lead m-2">Semanal</p>
                                <h3 class="m-2 text-white" id="totalsemanal"></h3>
                            </div>
                            <div class="col-lg-6">
                                <p class="lead m-2"><i class="fas fa-download m-2" style="float: right;"></i></p>
                            </div>
                        </div>
                        <hr class="m-2 p-0 bg-white">
                        <p class="text-white m-2" id="deficitsemanal">

                        </p>
                    </div>
                </div>
                <div class="col-sm-3" style="cursor: pointer;" id="btnMensual">
                    <div class="rounded text-white card-lift--hover" style="background: #fd7e14">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="lead m-2">Mensual</p>
                                <h3 class="m-2 text-white" id="totalmensual"></h3>
                            </div>
                            <div class="col-lg-6">
                                <p class="lead m-2"><i class="fas fa-download m-2" style="float: right;"></i></p>
                            </div>
                        </div>
                        <hr class="m-2 p-0 bg-white">
                        <p class="text-white m-2" id="deficitmensual">
                        </p>
                    </div>
                </div>
                <div class="col-sm-3" style="cursor: pointer;" id="btnTotal">
                    <div class="rounded text-white card-lift--hover" style="background: #dc3545">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="lead m-2">Total</p>
                                <h3 class="m-2 text-white" id="totaltotal"></h3>
                            </div>
                            <div class="col-lg-6">
                                <p class="lead m-2"><i class="fas fa-download m-2" style="float: right;"></i></p>
                            </div>
                        </div>
                        <hr class="m-2 p-0 bg-white">
                        <p class="text-white m-2">
                            <strong>Ganancias</strong> en ventas
                        </p>
                    </div>
                </div>
            </div>
            <hr style="background: white;">
            <div id="descargarPDF" class="m-4">
                <div style="background:#313d4f;">
                    <div class="row m-2">
                        <h1 class="text-white" id="tipoReporte"></h1>
                        <button class="btn btn-danger btn-sm m-2" id="btnGenerarReporte"><i class="fas fa-file-pdf mr-2"></i>Descargar</button>
                    </div>
                    <hr class="bg-white p-0 m-0">
                    <div style="height: 250px;overflow-y: scroll;overflow-x: hidden;" id="mostrarReporteFactura">

                    </div>
                </div>
                <hr style="background: white;">
            </div>

            <div class="row text-white m-2">
                <h2 class="text-white">Ordenes</h2>
                <p id="sinEntregar"></p>
            </div>
            <button class="btn btn-primary m-2" id="btnEntregadas">Ver Entregadas</button>
            <button class="btn btn-primary m-2" id="btnSinEntregar">Ver sin Entregar</button>
            <div class="table-responsive">
                <table class="table table-hover table-borderless text-white" style="background: #313d4f;">
                    <thead class="bg-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Tipo Pago</th>
                            <th scope="col">Empresa Pago</th>
                            <th scope="col">Total Pagado</th>
                            <th scope="col">Fecha Compra</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="mostrarFacturasSinEntregar">

                    </tbody>
                </table>
                <div class="modal fade" id="modalProductosFactura" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                    <div style="width: 800px;" class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                        <div style="width: 700px;" class="modal-content bg-gradient-danger">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-notification">Productos Solicitados</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="table-responsive">
                                <table class="table table-hover table-dark">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Genero</th>
                                            <th>Categoria</th>
                                            <th>Talla</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productosFacturaModal">
                                    </tbody>
                                </table>
                                </div>
                                <input type="hidden" id="idFacturaModal" name="idFacturaModal" required>
                                <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                                </div>
                                                <select class="form-control" name="nuevoEstado" id="nuevoEstado" required>
                                                    <option value="" disabled selected>Seleccione un Estado</option>
                                                    <option value="1">PENDIENTE</option>
                                                    <option value="2">ATENDIDA</option>
                                                    <option value="3">ENTREGADA</option>
                                                </select>
                                            </div>
                                        </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>