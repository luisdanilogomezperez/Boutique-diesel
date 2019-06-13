<div id="ocultar"></div>
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
    <?php
    $peticion = $_SERVER["REQUEST_URI"];
    $respuesta = explode("&", $peticion);
    $resultadoTransaccion = $respuesta[5][17];
    $idTransaccion = explode("=", $respuesta[9])[1];
    $empresaPago = explode("=", $respuesta[24])[1];
    $tipoPago = explode("=", $respuesta[26])[1];
    $totalPagado = explode("=", $respuesta[28])[1];
    $fechaPago = explode("=", $respuesta[39])[1];

    if ($resultadoTransaccion == 4) {
        echo '<div class="container card">
        <div class="row row-grid align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="vista/presentacion/img/promo-1.png" class="img-fluid floating">
            </div>
            <div class="col-md-6 order-md-1">
                <div class="pr-md-5">
                    <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5">
                    <i class="fas fa-check"></i>
                    </div>
                    <h3>Compra Exitosa</h3>
                    <p>Gracias por preferirnos, en un plazo maximo de 3 dias podrá disfrutar de su nueva compra. En caso de no ser así, por favor comuniquese con nosotros. <a href="Nosotros#comunicarse">Aquí</a></p>
                    <ul class="list-unstyled mt-5">
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="badge badge-circle badge-primary mr-3">
                                    <i class="fas fa-credit-card"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">Tipo de Pago: ' . $tipoPago . '</h6>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="badge badge-circle badge-primary mr-3">
                                    <i class="fab fa-cc-mastercard"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">Empresa: ' . $empresaPago . '</h6>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="badge badge-circle badge-primary mr-3">
                                    <i class="fas fa-hand-holding-usd"></i>                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">Total Pagado: $' . $totalPagado . '</h6>
                                </div>
                            </div>
                        </li>
                        <a href="Perfil#mostrarFacturas" class="btn btn-primary mt-2">Ver Compras</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>';

    require_once $_SERVER["DOCUMENT_ROOT"].'/App_Boutique/modelo/Conexion.php';
    $user = unserialize($_SESSION["Cliente"]);
    $id = $user->getId();
    $conexion = Conexion::crearConexion();
    /* CONSULTA PARA ACTUALIZAR INVENTARIO */
    $consulta = $conexion->prepare('UPDATE productotalla SET productotalla.cantidad = (SELECT subconsulta.sobra FROM (SELECT productotalla.id AS productotalla,(productotalla.cantidad-carrito.cantidadllevar) AS sobra FROM carrito INNER JOIN productotalla ON carrito.productotalla = productotalla.id WHERE carrito.cliente = ?)AS subconsulta WHERE productotalla.id = subconsulta.productotalla) WHERE productotalla.id IN (SELECT carrito.productotalla FROM carrito WHERE carrito.cliente = ?);');
    $consulta->bindParam(1, $id, PDO::PARAM_INT);
    $consulta->bindParam(2, $id, PDO::PARAM_INT);
    $consulta->execute();
    /* CONSULTAS PARA CREAR NUEVA FACTURA */
    $consulta2 = $conexion->prepare("SELECT * FROM factura WHERE idtransaccion = ?");
    $consulta2->bindParam(1, $idTransaccion, PDO::PARAM_STR);
    $consulta2->execute();
    $filas = $consulta2->rowCount();
    if($filas<1){
    $consulta3 = $conexion->prepare("INSERT INTO factura (cliente,idtransaccion,tipopago,empresapago,fecha,total,estado) VALUES(?,?,?,?,?,?,1);");
    $consulta3->bindParam(1, $id, PDO::PARAM_INT);
    $consulta3->bindParam(2, $idTransaccion, PDO::PARAM_STR);
    $consulta3->bindParam(3, $tipoPago, PDO::PARAM_STR);
    $consulta3->bindParam(4, $empresaPago, PDO::PARAM_STR);
    $consulta3->bindParam(5, $fechaPago, PDO::PARAM_STR);
    $consulta3->bindParam(6, intval($totalPagado), PDO::PARAM_INT);
    $consulta3->execute();
    /* CONSULTAS PARA CREAR NUEVA COMPRA Y ELIMINAR CARRITO */
    $consulta4 = $conexion->prepare("SELECT carrito.productotalla AS producto,carrito.cantidadllevar AS comprado FROM carrito WHERE carrito.cliente = ?;");
    $consulta4->bindParam(1, $id, PDO::PARAM_INT);
    $consulta4->execute();
    $consulta5 = $conexion->prepare("SELECT id AS id FROM factura WHERE idtransaccion = ?");
    $consulta5->bindParam(1, $idTransaccion, PDO::PARAM_STR);
    $consulta5->execute();
    $respuesta = $consulta5->fetch();
    $consulta7 = $conexion->prepare("DELETE FROM carrito WHERE carrito.cliente = ?");
    $consulta7->bindParam(1, $id, PDO::PARAM_INT);
    $consulta7->execute();
    $factura = $respuesta["id"];
    $sql = "";
    while($respuesta2 = $consulta4->fetch()){
        $sql .= 'INSERT INTO compra (productotalla,cantidad,factura) VALUES('.$respuesta2["producto"].','.$respuesta2["comprado"].','.$factura.');';
    }
    $consulta6 = $conexion->prepare($sql);
    $consulta6->execute();
    }else{
        header('location:Perfil');
    }
    } else {
        header('location:Carrito');
    }

    //5-10-24-26-28 ->FALLA
    //5-10-24-26-28-39 ->FUNCIONA
    //5130218133680652 288
    ?>
</section>