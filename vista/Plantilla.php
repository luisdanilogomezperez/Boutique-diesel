<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pagina Web de Una Boutique.">
    <meta name="author" content="Alexander Peñaloza">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#5e72e4">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" type="image/jpg" href="vista/presentacion/img/logo.jpg">


    <!-- Plantilla CSS -->
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/lib/argon.css?v=1.0.1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/lib/nucleo.css">
    <!-- Fuente de letra -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/estilos.css">
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/tarjetas.css">
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/chat.css">
    <title>Boutique Diesel</title>
</head>

<body class="animated fadeIn">
    <?php

    session_start();
    include_once 'modulos/Header.php';
    $controlador = new Controlador();
    $controlador->generarVista();
    include_once 'modulos/Footer.php';

    ?>
    <script src="vista/presentacion/js/lib/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="vista/presentacion/js/lib/jquery.validate.js"></script>
    <script src="vista/presentacion/js/lib/alertas.js"></script>
    <script src="vista/presentacion/js/lib/bootstrap.min.js"></script>
    <script src="vista/presentacion/js/lib/bootstrap-datepicker.min.js"></script>
    <script src="vista/presentacion/js/lib/argon.min.js?v=1.0.1"></script>
    <script src="vista/presentacion/js/lib/headroom.min.js"></script>
    <script src="vista/presentacion/js/lib/html2pdf.js"></script>
    <script src="vista/presentacion/js/lib/jspdf.debug.js"></script>
    <script src="vista/presentacion/js/efectos.js"></script>
    <script src="vista/presentacion/js/cliente.js"></script>
    <script src="vista/presentacion/js/ingresar.js"></script>
    <script src="vista/presentacion/js/administrador.js"></script>
    <script src="vista/presentacion/js/producto.js"></script>
    <script src="vista/presentacion/js/carrito.js"></script>
    <script src="vista/presentacion/js/compra.js"></script>
    <script src="vista/presentacion/js/mensaje.js"></script>
    <script src="vista/presentacion/js/inventario.js"></script>
    <script src="vista/presentacion/js/reportes.js"></script>
</body>

</html> 