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

<div class="position-relative">

    <section class="section section-lg section-shaped pb-250">
        <div class="shape shape-style-1 shape-primary">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container">
            <div class="card">
                <div class="row m-2">
                    <div class="col-lg-8 text-center">
                        <h3>Carrito de Compras</h3>
                        <hr>
                        <div class="table-responsive" style="height: 400px;overflow: scroll;overflow-x:hidden;">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Talla</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="cargarTablaCarrito">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 border-left text-center">
                        <h3>Informe de pago</h3>
                        <hr>
                        <div class="card card-lift--hover shadow border-0">
                            <div class="card-body py-5">
                                <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                    <i class="fas fa-cash-register"></i>
                                </div>
                                <input type="hidden" id="guardarTotalPagar">
                                <h3 class="text-primary text-uppercase">Total a Pagar</h3>
                                <h4 class="text-primary text-uppercase" id="mostrarTotalPagar"></h4>
                                <p class="description mt-3"><strong>Para terminar la compra y disfrutar su ropa, seleccione el metodo de pago disponible que sea de su preferencia.</strong></p>
                                <div>
                                    <span class="badge badge-pill badge-primary">Rapido</span>
                                    <span class="badge badge-pill badge-primary">Seguro</span>
                                    <span class="badge badge-pill badge-primary">Confiable</span>
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-primary" style="float:left"><i class="fas fa-dot-circle mr-2"></i>PUNTOS</button>
                                    <?php
                                    if ($user instanceof ClienteDTO) {
                                        echo '<form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                                            <input name="merchantId" id="merchan" type="hidden">
                                            <input name="accountId" id="account" type="hidden">
                                            <input name="description" id="descripcion" type="hidden">
                                            <input name="referenceCode" id="referencia" type="hidden">
                                            <input name="amount" id="monto" type="hidden">
                                            <input name="tax" id="tax" type="hidden">
                                            <input name="taxReturnBase" id="basetax" type="hidden">
                                            <input name="currency" id="moneda" type="hidden">
                                            <input name="signature" id="signature" type="hidden">
                                            <input name="test" id="test" type="hidden">
                                            <input name="buyerEmail" id="correo" type="hidden">
                                            <input name="responseUrl" id="response" type="hidden">
                                            <input name="confirmationUrl" id="confirmacion" type="hidden">
                                            <input name="Submit" class="btn btn-primary" type="submit" value="Pagar">
                                        </form>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="favoritos"></div>
            <br>
            <div class="card">
                <div class="container m-2 text-center">
                    <h3>Productos marcados como favortios</h3>
                    <hr>
                    <div class="row" style="height: 460px;overflow: scroll;overflow-x:hidden;margin:0;padding: 0;" id="mostrarFavoritos">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>