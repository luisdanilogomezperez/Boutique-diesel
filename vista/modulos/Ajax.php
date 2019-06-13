<?php

//CONTROLADORES
require_once '../../controlador/Controlador.php';
require_once '../../modelo/Negocio.php';
require_once '../../modelo/Conexion.php';

// DTO
require_once '../../modelo/dto/ClienteDTO.php';
require_once '../../modelo/dto/AdministradorDTO.php';
require_once '../../modelo/dto/ProductoDTO.php';
require_once '../../modelo/dto/MensajeDTO.php';
// DAO
require_once '../../modelo/dao/ClienteDAO.php';
require_once '../../modelo/dao/AdministradorDAO.php';
require_once '../../modelo/dao/ProductoDAO.php';
require_once '../../modelo/dao/MensajeDAO.php';

class Ajax
{

    public function registrarCliente($nombres, $apellidos,$direccion, $documento, $correo, $fechaNacimiento, $contrasenia)
    {
        $exito = false;
        try {
            $existe = $this->buscarCliente($documento, $correo, "registrar");
            if (is_null($existe)) {
                $controlador = $this->obtenerControlador();
                $ClienteDTO = new ClienteDTO($nombres, $apellidos,$direccion, $documento, $correo, $fechaNacimiento, $contrasenia, "vista/presentacion/assets/PerfilSinFoto.png");
                $exito = $controlador->registrarClienteControlador($ClienteDTO);
            } else {
                $exito = false;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "Ya se encuentra realizado en el sistema"));
        }
    }


    public function iniciarSesionCliente($correo, $contrasenia)
    {
        $exito = false;
        try {
            $existe = $this->buscarCliente($correo, $contrasenia, "iniciar");
            if (is_null($existe)) {
                $exito = false;
            } else {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            session_start();
            $_SESSION["Cliente"] = serialize($existe);
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    public function iniciarSesionAdministrador($correo, $contrasenia)
    {
        $exito = false;
        try {
            $existe = $this->buscarAdministrador($correo, $contrasenia);
            if (is_null($existe)) {
                $exito = false;
            } else {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            session_start();
            $_SESSION["Cliente"] = serialize($existe);
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    public function actualizarCliente($id, $nombres, $apellidos,$direccion, $documento, $correo, $fechaNacimiento)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $ClienteDTO = new ClienteDTO($nombres, $apellidos,$direccion, $documento, $correo, $fechaNacimiento, NULL, NULL);
            $exito = $controlador->actualizarClienteControlador($id, $ClienteDTO);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
                session_start();
                $cliente = unserialize($_SESSION['Cliente']);
                $cliente->setNombres($nombres);
                $cliente->setApellidos($apellidos);
                $cliente->setDireccion($direccion);
                $cliente->setDocumento($documento);
                $cliente->setCorreo($correo);
                $cliente->setFechaNacimiento($fechaNacimiento);
                $_SESSION['Cliente'] = serialize($cliente);
                echo json_encode(array("exito" => true));
            } else {
            echo json_encode(array("exito" => false, "error" => "No se encuentra el Usuario"));
        }
    }

    public function cambiarContrasenia($contraseniaActual, $contraseniaNueva)
    {
        $exito = false;
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $exito = $controlador->cambiarContraseniaControlador($contraseniaActual, $contraseniaNueva);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            session_destroy();
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    public function recordarContrasenia($correo)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $ClienteDTO = new ClienteDTO(NULL, NULL,NULL, NULL, $correo, NULL, "prueba", NULL);
            $existe = $controlador->recordarContraseniaControlador($ClienteDTO);
            if (is_null($existe)) {
                $exito = false;
            } else {
                $cliente = $existe;
                $email = new Mail();
                $exito = $email->enviarCorreoRecordarContraseña($correo, $cliente->getNombres(), $cliente->getApellidos(), $cliente->getContrasenia());
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    public function cargarGeneros()
    {
        try {
            $controlador = $this->obtenerControlador();
            $generos = $controlador->cargarGenerosControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        echo $generos;
    }

    public function cargarCategorias()
    {
        try {
            $controlador = $this->obtenerControlador();
            $categorias = $controlador->cargarCategoriasControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        echo $categorias;
    }

    public function cargarColores()
    {
        try {
            $controlador = $this->obtenerControlador();
            $colores = $controlador->cargarColoresControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        echo $colores;
    }

    public function cargarTelas()
    {
        try {
            $controlador = $this->obtenerControlador();
            $telas = $controlador->cargarTelasControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        echo $telas;
    }

    public function cargarTallas($genero)
    {
        try {
            $controlador = $this->obtenerControlador();
            $tallas = $controlador->cargarTallasControlador($genero);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        echo $tallas;
    }

    function crearProducto($nombre, $precio, $marca, $descripcion, $genero, $categoria, $color, $tela, $tallas)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $numero = sha1(rand(0000, 9999) . rand(00, 99));
            $ProductoDTO = new ProductoDTO($numero, $nombre, $descripcion, "vista/presentacion/assets/ProductoSinFoto.jpg", $precio, $marca, $categoria, $color, $genero, $tela);
            $exito = $controlador->crearProductoControlador($ProductoDTO, $tallas);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    function actualizarProducto($nombre, $precio, $marca, $descripcion, $categoria, $color, $tela, $id)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $ProductoDTO = new ProductoDTO(NULL, $nombre, $descripcion, NULL, $precio, $marca, $categoria, $color, NULL, $tela);
            $exito = $controlador->actualizarProductoControlador($ProductoDTO, $id);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el cliente"));
        }
    }

    public function mostrarTallasProducto($id,$tipo)
    {
        try {
            $controlador = $this->obtenerControlador();
            $tallas = $controlador->mostrarTallasProductoControlador($id,$tipo);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $tallas;
    }

    public function mostrarProductos($filtro, $genero)
    {
        try {
            $controlador = $this->obtenerControlador();
            $productos = $controlador->mostrarProductosControlador($filtro, $genero);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        return $productos;
    }

    public function gestionarFavoritos($producto, $opcion)
    {
        $exito = false;
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $exito = $controlador->gestionarFavoritosControlador($producto, $opcion);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se econtro el Producto"));
        }
    }

    public function obtenerProductosFavoritos()
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $favoritos = $controlador->obtenerProductosFavoritosControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $favoritos;
    }

    public function añadirCarrito($tallaProducto)
    {
        $exito = false;
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $exito = $controlador->añadirCarritoControlador($tallaProducto);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "Ya añadio el Producto"));
        }
    }

    public function eliminarProductoCarrito($producto)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->eliminarProductoCarritoControlador($producto);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "Ya añadio el Producto"));
        }
    }

    public function mostrarCarrito()
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $carrito = $controlador->mostrarCarritoControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $carrito;
    }

    public function cargarGaleriaProducto($producto)
    {
        try {
            $controlador = $this->obtenerControlador();
            $carrito = $controlador->cargarGaleriaProductoControlador($producto);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $carrito;
    }

    public function actualizarCantidadCarrito($carrito, $nuevaCantidad)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->actualizarCantidadCarritoControlador($carrito, $nuevaCantidad);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "Excedio la cantidad permitida"));
        }
    }

    public function peticionPayu($totalPagar)
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $peticion = $controlador->peticionPayuControlador($totalPagar);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $peticion;
    }

    public function mostrarFactura()
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $facturas = $controlador->mostrarFacturaControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $facturas;
    }

    public function mostrarProductosFactura($factura)
    {
        try {
            $controlador = $this->obtenerControlador();
            $productosFactura = $controlador->mostrarProductosFacturaControlador($factura);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $productosFactura;
    }

    public function mostrarProductosFavoritos()
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $productosFavoritos = $controlador->mostrarProductosFavoritosControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $productosFavoritos;
    }

    public function guardarMensaje($nombre, $correo, $asunto, $mensaje)
    {
        $exito = false;
        try {
            $MensajeDTO = new MensajeDTO($nombre, $correo, $asunto, $mensaje);
            $controlador = $this->obtenerControlador();
            $exito = $controlador->guardarMensajeControlador($MensajeDTO);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "Ya envio un mensaje"));
        }
    }

    public function eliminarMensajes()
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->eliminarMensajeControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pueden eliminar los mensajes"));
        }
    }

    public function mostrarMensajes()
    {
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $mensajes = $controlador->mostrarMensajesControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $mensajes;
    }

    public function cargarTallasInventario($idProducto){
        try {
            session_start();
            $controlador = $this->obtenerControlador();
            $tallas = $controlador->cargarTallasInventarioControlador($idProducto);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $tallas;
    }

    public function actualizarInventario($productoTalla, $nuevaCantidad)
    {
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->actualizarInventarioControlador($productoTalla, $nuevaCantidad);
         } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se puede actualizar"));
        }
    }

    public function añadirNuevasTalla($idProducto,$nuevasTallas){
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->añadirNuevasTallaControlador($idProducto,$nuevasTallas);
         } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se puede añadir"));
        }
    }

    public function cargarReportes($tipo){
        try {
            $controlador = $this->obtenerControlador();
            $reportes = $controlador->cargarReportesControlador($tipo);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $reportes;
    }

    public function cargarReportesFactura($tipo){
        try {
            $controlador = $this->obtenerControlador();
            $reportes = $controlador->cargarReportesFacturaControlador($tipo);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $reportes;
    }

    public function cargarProductosFactura($factura){
        try {
            $controlador = $this->obtenerControlador();
            $productos = $controlador->cargarProductosFacturaControlador($factura);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $productos;
    }

    public function cambiarEstadoFactura($factura,$nuevoEstado){
        $exito = false;
        try {
            $controlador = $this->obtenerControlador();
            $exito = $controlador->cambiarEstadoFacturaControlador($factura,$nuevoEstado);
         } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se puede añadir"));
        }
    }

    private function buscarCliente($a, $b, $uso)
    {
        $existe = null;
        try {
            $controlador = $this->obtenerControlador();
            $existe = $controlador->buscarClienteControlador($a, $b, $uso);
        } catch (Exception $exc) {
            throw new Exception("Se genero un error en la base de datos" . $exc);
        }
        return $existe;
    }

    private function buscarAdministrador($a, $b)
    {
        $existe = null;
        try {
            $controlador = $this->obtenerControlador();
            $existe = $controlador->buscarAdministradorControlador($a, $b);
        } catch (Exception $exc) {
            throw new Exception("Se genero un error en la base de datos" . $exc);
        }
        return $existe;
    }

    private function obtenerControlador()
    {
        $controlador = new Controlador();
        return $controlador;
    }
}

$ajax = new Ajax();

$registrarCliente = isset($_POST['registrarNombres'], $_POST['registrarApellidos'], $_POST['registrarDireccion'], $_POST['registrarDocumento'], $_POST['registrarCorreo'], $_POST['registrarFechaNacimiento'], $_POST['registrarContrasenia']);

$iniciaSesionCliente = isset($_POST['ingresarCorreo'], $_POST['ingresarContrasenia']);

$iniciaSesionAdministrador = isset($_POST['ingresarCorreoAdministrador'], $_POST['ingresarContraseniaAdministrador']);

$actualizarCliente = isset($_POST['actualizarId'], $_POST['actualizarNombres'], $_POST['actualizarApellidos'],$_POST['actualizarDireccion'], $_POST['actualizarDocumento'], $_POST['actualizarCorreo'], $_POST['actualizarFechaNacimiento']);

$cambiarContrasenia = isset($_POST['contraseniaActual'], $_POST['contraseniaNueva']);

$recordarContrasenia = isset($_POST['recordarCorreo']);

$cargarGeneros = isset($_GET['cargarGeneros']);

$cargarCategorias = isset($_GET['cargarCategorias']);

$cargarColores = isset($_GET['cargarColores']);

$cargarTelas = isset($_GET['cargarTelas']);

$cargarTallasGenero = isset($_POST['cargarTallasGenero']);

$crearProducto = isset($_POST['nombreProducto'], $_POST['precioProducto'], $_POST['marcaProducto'], $_POST['descripcionProducto'], $_POST['generoProducto'], $_POST['categoriaProducto'], $_POST['colorProducto'], $_POST['telasProducto'], $_POST['tallasProducto']);

$actualizarProducto = isset($_POST['nombreActualizarProducto'], $_POST['precioActualizarProducto'], $_POST['marcaActualizarProducto'], $_POST['descripcionActualizarProducto'], $_POST['categoriaActualizarProducto'], $_POST['colorActualizarProducto'], $_POST['telasActualizarProducto'], $_POST['idProductoActualizar']);

$mostrarProductosHombres = isset($_GET['mostrarProductosHombres']);
$mostrarProductosMujeres = isset($_GET['mostrarProductosMujeres']);
$mostrarProductosNino = isset($_GET['mostrarProductosNino']);
$mostrarProductosNina = isset($_GET['mostrarProductosNina']);
$mostrarProductosTodos = isset($_GET['mostrarProductosTodos']);

$mostrarTallasProducto = isset($_POST['idProductoTallas']);
$mostrarTallasInventario = isset($_POST['idProductoInventario']);

$gestionarFavoritos = isset($_POST['productoFavorito'], $_POST['transaccion']);

$obtenerProductosFavoritos = isset($_GET['obtenerProductosFavoritos']);

$añadirCarrito = isset($_POST['tallaProductoAñadirCarrito']);
$mostrarCarrito = isset($_GET['mostrarcarrito']);
$eliminarProductoCarrito = isset($_POST['ProductoEliminarCarrito']);
$actualizarCantidadCarrito = isset($_POST['carritoActualizar'], $_POST['cantidadActualizar']);

$cargarGaleriaProducto = isset($_POST['idProductoGaleria']);
$peticionPayu = isset($_POST['totalPagarPayu']);
$mostrarFactura = isset($_GET['mostrarfacturas']);
$mostrarProductosFactura = isset($_POST['idfactura']);
$mostrarProductosFavoritos = isset($_GET['mostrarProductosFavoritos']);
$guardarMensaje = isset($_POST['nombreMensaje'], $_POST['correoMensaje'], $_POST['asuntoMensaje'], $_POST['textoMensaje']);
$mostrarMensajes = isset($_GET['mostrarMensajes']);
$eliminarMensajes = isset($_GET['eliminarMensajes']);
$actualizarInventario = isset($_POST['tallaproductoInventario'], $_POST['nuevaCantidadInventario']);
$cargarTallaDisponibles = isset($_POST['idProductoNuevaTalla']);
$AñadirNuevasTallas = isset($_POST['idProductoCrearTalla'],$_POST['tallasInventario']);
$cargarReportes = isset($_POST['tipoReporte']);
$cargarReportesFactura = isset($_POST['tipoReporteFactura']);
$cargarProductosFactura = isset($_POST['idFacturaReporte']);
$cambiarEstadoFactura = isset($_POST['facturaNuevoEstado'],$_POST['nuevoEstado']);

if ($registrarCliente) {
    $ajax->registrarCliente($_POST['registrarNombres'], $_POST['registrarApellidos'], $_POST['registrarDireccion'], $_POST['registrarDocumento'], $_POST['registrarCorreo'], $_POST['registrarFechaNacimiento'], $_POST['registrarContrasenia']);
} else if ($iniciaSesionCliente) {
    $ajax->iniciarSesionCliente($_POST['ingresarCorreo'], $_POST['ingresarContrasenia']);
} else if ($iniciaSesionAdministrador) {
    $ajax->iniciarSesionAdministrador($_POST['ingresarCorreoAdministrador'], $_POST['ingresarContraseniaAdministrador']);
} else if ($actualizarCliente) {
    $ajax->actualizarCliente($_POST['actualizarId'], $_POST['actualizarNombres'], $_POST['actualizarApellidos'],$_POST['actualizarDireccion'], $_POST['actualizarDocumento'], $_POST['actualizarCorreo'], $_POST['actualizarFechaNacimiento']);
} else if ($cambiarContrasenia) {
    $ajax->cambiarContrasenia($_POST['contraseniaActual'], $_POST['contraseniaNueva']);
} else if ($recordarContrasenia) {
    $ajax->recordarContrasenia($_POST['recordarCorreo']);
} else if ($cargarGeneros && $_GET['cargarGeneros']) {
    $ajax->cargarGeneros();
} else if ($cargarCategorias && $_GET['cargarCategorias']) {
    $ajax->cargarCategorias();
} else if ($cargarColores && $_GET['cargarColores']) {
    $ajax->cargarColores();
} else if ($cargarTallasGenero) {
    $ajax->cargarTallas($_POST['cargarTallasGenero']);
} else if ($cargarTelas && $_GET['cargarTelas']) {
    $ajax->cargarTelas();
} else if ($crearProducto) {
    $ajax->crearProducto($_POST['nombreProducto'], $_POST['precioProducto'], $_POST['marcaProducto'], $_POST['descripcionProducto'], $_POST['generoProducto'], $_POST['categoriaProducto'], $_POST['colorProducto'], $_POST['telasProducto'], $_POST['tallasProducto']);
} else if ($mostrarProductosHombres && $_GET['mostrarProductosHombres']) {
    $ajax->mostrarProductos($_GET['filtrohombre'], "hombres");
} else if ($mostrarProductosMujeres && $_GET['mostrarProductosMujeres']) {
    $ajax->mostrarProductos($_GET['filtromujer'], "mujeres");
} else if ($mostrarProductosNino && $_GET['mostrarProductosNino']) {
    $ajax->mostrarProductos($_GET['filtronino'], "niño");
} else if ($mostrarProductosNina && $_GET['mostrarProductosNina']) {
    $ajax->mostrarProductos($_GET['filtronina'], "niña");
} else if ($mostrarProductosTodos && $_GET['mostrarProductosTodos']) {
    $ajax->mostrarProductos($_GET['filtro'], "todos");
} else if ($mostrarTallasProducto) {
    $ajax->mostrarTallasProducto($_POST['idProductoTallas'],"productos");
} else if ($mostrarTallasInventario) {
    $ajax->mostrarTallasProducto($_POST['idProductoInventario'],"inventario");
} else if ($gestionarFavoritos) {
    $ajax->gestionarFavoritos($_POST['productoFavorito'], $_POST['transaccion']);
} else if ($obtenerProductosFavoritos && $_GET['obtenerProductosFavoritos']) {
    $ajax->obtenerProductosFavoritos();
} else if ($añadirCarrito) {
    $ajax->añadirCarrito($_POST['tallaProductoAñadirCarrito']);
} else if ($mostrarCarrito && $_GET['mostrarcarrito']) {
    $ajax->mostrarCarrito();
} else if ($eliminarProductoCarrito) {
    $ajax->eliminarProductoCarrito($_POST['ProductoEliminarCarrito']);
} else if ($actualizarCantidadCarrito) {
    $ajax->actualizarCantidadCarrito($_POST['carritoActualizar'], $_POST['cantidadActualizar']);
} else if ($cargarGaleriaProducto) {
    $ajax->cargarGaleriaProducto($_POST['idProductoGaleria']);
} else if ($peticionPayu) {
    $ajax->peticionPayu($_POST['totalPagarPayu']);
} else if ($mostrarFactura && $_GET['mostrarfacturas']) {
    $ajax->mostrarFactura();
} else if ($mostrarProductosFactura) {
    $ajax->mostrarProductosFactura($_POST['idfactura']);
} else if ($mostrarProductosFavoritos && $_GET['mostrarProductosFavoritos']) {
    $ajax->mostrarProductosFavoritos();
} else if ($guardarMensaje) {
    $ajax->guardarMensaje($_POST['nombreMensaje'], $_POST['correoMensaje'], $_POST['asuntoMensaje'], $_POST['textoMensaje']);
} else if ($mostrarMensajes && $_GET['mostrarMensajes']) {
    $ajax->mostrarMensajes();
} else if ($eliminarMensajes && $_GET['eliminarMensajes']) {
    $ajax->eliminarMensajes();
} else if ($actualizarProducto) {
    $ajax->actualizarProducto($_POST['nombreActualizarProducto'], $_POST['precioActualizarProducto'], $_POST['marcaActualizarProducto'], $_POST['descripcionActualizarProducto'], $_POST['categoriaActualizarProducto'], $_POST['colorActualizarProducto'], $_POST['telasActualizarProducto'], $_POST['idProductoActualizar']);
} else if ($actualizarInventario) {
    $ajax->actualizarInventario($_POST['tallaproductoInventario'], $_POST['nuevaCantidadInventario']);
}else if($cargarTallaDisponibles){
    $ajax->cargarTallasInventario($_POST['idProductoNuevaTalla']);
}else if($AñadirNuevasTallas){
    $ajax->añadirNuevasTalla($_POST['idProductoCrearTalla'],$_POST['tallasInventario']);
}else if($cargarReportes){
    $ajax->cargarReportes($_POST['tipoReporte']);
}else if($cargarReportesFactura){
    $ajax->cargarReportesFactura($_POST['tipoReporteFactura']);
}else if($cargarProductosFactura){
    $ajax->cargarProductosFactura($_POST['idFacturaReporte']);
}else if($cambiarEstadoFactura){
    $ajax->cambiarEstadoFactura($_POST['facturaNuevoEstado'],$_POST['nuevoEstado']);
}
