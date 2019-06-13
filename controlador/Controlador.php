<?php

class Controlador
{

    private $negocio;

    // Constructor
    public function __construct()
    {
        $this->negocio = new Negocio();
    }

    public function generarPlantilla()
    {
        return Negocio::generarPlantilla();
    }

    public function generarVista()
    {
        $enlace = filter_input(INPUT_GET,'ubicacion');
        if($enlace)
        {
            $enlace = $this->negocio->generarEnlace($enlace);
        }else
        {
            $enlace = $this->negocio->generarEnlace('Inicio');
        }
        include_once $enlace;
    }

    public function buscarClienteControlador($a,$b,$uso)
    {
        return $this->negocio->buscarClienteNegocio($a,$b,$uso);
    }

    public function buscarAdministradorControlador($a,$b)
    {
        return $this->negocio->buscarAdministradorNegocio($a,$b);
    }

    public function registrarClienteControlador($ClienteDTO)
    {
        return $this->negocio->registrarClienteNegocio($ClienteDTO);
    }

    public function actualizarClienteControlador($id,$ClienteDTO){
        return $this->negocio->actualizarClienteNegocio($id,$ClienteDTO);
    }

    public function cambiarContraseniaControlador($contraseniaActual,$contraseniaNueva){
        return $this->negocio->cambiarContraseniaNegocio($contraseniaActual,$contraseniaNueva);
    }

    public function recordarContraseniaControlador($ClienteDTO){
        return $this->negocio->recordarContraseniaNegocio($ClienteDTO);
    }

    public function cargarGenerosControlador(){
        return $this->negocio->cargarGenerosNegocio();
    }

    public function cargarCategoriasControlador(){
        return $this->negocio->cargarCategoriasNegocio();
    }

    public function cargarColoresControlador(){
        return $this->negocio->cargarColoresNegocio();
    }

    public function cargarTelasControlador(){
        return $this->negocio->cargarTelasNegocio();
    }

    public function cargarTallasControlador($genero){
        return $this->negocio->cargarTallasNegocio($genero);
    }

    public function crearProductoControlador($ProductoDTO,$tallas){
        return $this->negocio->crearProductoNegocio($ProductoDTO,$tallas);
    }

    public function actualizarProductoControlador($ProductoDTO,$id){
        return $this->negocio->actualizarProductoNegocio($ProductoDTO,$id);
    }

    public function mostrarProductosControlador($filtro,$genero){
        return $this->negocio->mostrarProductosNegocio($filtro,$genero);
    }

    public function mostrarTallasProductoControlador($id,$tipo){
        return $this->negocio->mostrarTallasProductoNegocio($id,$tipo);
    }

    public function gestionarFavoritosControlador($producto,$opcion){
        return $this->negocio->gestionarFavoritosNegocio($producto,$opcion);
    }

    public function obtenerProductosFavoritosControlador(){
        return $this->negocio->obtenerProductosFavoritosNegocio();
    }

    public function añadirCarritoControlador($tallaProducto){
        return $this->negocio->añadirCarritoNegocio($tallaProducto);
    }

    public function eliminarProductoCarritoControlador($producto){
        return $this->negocio->eliminarProductoCarritoNegocio($producto);
    }

    public function actualizarCantidadCarritoControlador($carrito,$nuevaCantidad){
        return $this->negocio->actualizarCantidadCarritoNegocio($carrito,$nuevaCantidad);
    }

    public function mostrarCarritoControlador(){
        return $this->negocio->mostrarCarritoNegocio();
    }

    public function cargarGaleriaProductoControlador($producto){
        return $this->negocio->cargarGaleriaProductoNegocio($producto);
    }

    public function peticionPayuControlador($totalPagar){
        return $this->negocio->peticionPayuNegocio($totalPagar);
    }

    public function mostrarFacturaControlador(){
        return $this->negocio->mostrarFacturaNegocio();
    }

    public function mostrarProductosFacturaControlador($factura){
        return $this->negocio->mostrarProductosFacturaNegocio($factura);
    }

    public function mostrarProductosFavoritosControlador(){
        return $this->negocio->mostrarProductosFavoritosNegocio();
    }

    public function guardarMensajeControlador($MensajeDTO){
        return $this->negocio->guardarMensajeNegocio($MensajeDTO);
    }

    public function mostrarMensajesControlador(){
        return $this->negocio->mostrarMensajesNegocio();
    }

    public function eliminarMensajeControlador(){
        return $this->negocio->eliminarMensajeNegocio();
    }

    public function actualizarInventarioControlador($productoTalla, $nuevaCantidad){
        return $this->negocio->actualizarInventarioNegocio($productoTalla, $nuevaCantidad);
    }

    public function cargarTallasInventarioControlador($idProducto){
        return $this->negocio->cargarTallasInventarioNegocio($idProducto);
    }

    public function añadirNuevasTallaControlador($idProducto,$nuevasTallas){
        return $this->negocio->añadirNuevasTallaNegocio($idProducto,$nuevasTallas);
    }

    public function cargarReportesControlador($tipo){
        return $this->negocio->cargarReportesNegocio($tipo);
    }
    
    public function cargarReportesFacturaControlador($tipo){
        return $this->negocio->cargarReportesFacturaNegocio($tipo);
    }

    public function cargarProductosFacturaControlador($factura){
        return $this->negocio->cargarProductosFacturaNegocio($factura);
    }

    public function cambiarEstadoFacturaControlador($factura,$nuevoEstado){
        return $this->negocio->cambiarEstadoFacturaNegocio($factura,$nuevoEstado);
    }

}

?>