<?php

class Negocio
{

    public function generarPlantilla()
    {
        include 'vista/Plantilla.php';
    }

    public function generarEnlace($enlace)
    {
        if($this->validarPestañaBarraNavegacion($enlace))
        {
            return 'vista/modulos/navegacion/'.$enlace.'.php';
        }else if($this->validarPestañaRedireccion($enlace))
        {
            return 'vista/modulos/'.$enlace.'.php';
        }else
        {
            return 'vista/modulos/navegacion/Inicio.php';
        }
    }

    private function validarPestañaBarraNavegacion($pestaña)
    {
        $exito = false;
        $pestañas = array("Inicio","Ingresar","Registrar","Perfil","Salir","Nosotros","Hombres","Chicos","Mujeres","Privado","Bienvenida");
        if(in_array($pestaña,$pestañas))
        {
            $exito = true;
        }
        return $exito;
    }

    private function validarPestañaRedireccion($pestaña)
    {
        $exito = false;
        $pestañas = array("cargarFotoPerfilCliente","cargarFotoPerfilProducto","Administrador","verProducto","Carrito","cargarFotosProductos","respuestaPayu","confirmacionPayu","Inventario","Reportes");
        if(in_array($pestaña,$pestañas))
        {
            $exito = true;
        }
        return $exito;
    }

    public function buscarClienteNegocio($a,$b,$uso)
    {
       return ClienteDAO::buscarCliente($a,$b,$uso);
    }

    public function buscarAdministradorNegocio($a,$b)
    {
       return AdministradorDAO::buscarAdministrador($a,$b);
    }

    public function registrarClienteNegocio($ClienteDTO)
    {
       return ClienteDAO::registrarCliente($ClienteDTO);
    }

    public function actualizarClienteNegocio($id,$ClienteDTO){
        return ClienteDAO::actualizarCliente($id,$ClienteDTO);
    }

    public function cambiarContraseniaNegocio($contraseniaActual,$contraseniaNueva){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        $desencriptar = ClienteDTO::desencriptar($user->getContrasenia());
        if(strcmp($contraseniaActual,$desencriptar)==0){
            $contraseniaNueva = ClienteDTO::encriptar($contraseniaNueva);
            return ClienteDAO::cambiarContrasenia($user->getId(),$contraseniaNueva);
        }else{
            return false;
        }   
    }

    public function recordarContraseniaNegocio($ClienteDTO){
        return ClienteDAO::recordarContrasenia($ClienteDTO);
    }

    public function cargarGenerosNegocio(){
        return AdministradorDAO::cargarGeneros();
    }

    public function cargarCategoriasNegocio(){
        return AdministradorDAO::cargarCategorias();
    }

    public function cargarColoresNegocio(){
        return AdministradorDAO::cargarColores();
    }

    public function cargarTelasNegocio(){
        return AdministradorDAO::cargarTelas();
    }

    public function cargarTallasNegocio($genero){
        return AdministradorDAO::cargarTallas($genero);
    }

    public function crearProductoNegocio($ProductoDTO,$tallas){
        return ProductoDAO::crearProducto($ProductoDTO,$tallas);
    }

    public function actualizarProductoNegocio($ProductoDTO,$id){
        return ProductoDAO::actualizarProducto($ProductoDTO,$id);
    }

    public function mostrarProductosNegocio($filtro,$genero){
        return ProductoDAO::mostrarProductos($filtro,$genero);
    }

    public function mostrarTallasProductoNegocio($id,$tipo){
        return ProductoDAO::listarTallasProducto($id,$tipo);
    }

    public function gestionarFavoritosNegocio($producto,$opcion){
        if(!isset($_SESSION["Cliente"])){
            return false;
        }else{
            include_once 'dto/ClienteDTO.php';
            $user = unserialize($_SESSION['Cliente']);
            if($user instanceof ClienteDTO){
                if(strcmp($opcion,"añadir")==0){
                    return ProductoDAO::añadirFavorito($producto,$user->getId());
                }else{
                    return ProductoDAO::eliminarFavorito($producto,$user->getId());
                }   
            }else{
                return false;
            }
        }
    }

    public function obtenerProductosFavoritosNegocio(){
        if(!isset($_SESSION["Cliente"])){
            return ProductoDAO::obtenerFavoritos(0);   
        }else{
            include_once 'dto/ClienteDTO.php';
            $user = unserialize($_SESSION['Cliente']);
            if($user instanceof ClienteDTO){
            return ProductoDAO::obtenerFavoritos($user->getId());   
            }else{
            return ProductoDAO::obtenerFavoritos(0);   
            }
        }
    }

    public function añadirCarritoNegocio($tallaProducto){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        return ProductoDAO::añadirCarrito($user->getId(),$tallaProducto);   
    }

    public function mostrarCarritoNegocio(){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        return ProductoDAO::mostrarCarrito($user->getId()); 
    }

    public function actualizarCantidadCarritoNegocio($carrito,$nuevaCantidad){
        return ProductoDAO::actualizarCantidadCarrito($carrito,$nuevaCantidad);
    }

    public function eliminarProductoCarritoNegocio($producto){
        return ProductoDAO::eliminarProductoCarrito($producto);
    }

    public function cargarGaleriaProductoNegocio($producto){
        return ProductoDAO::cargarGaleriaProducto($producto);
    }

    public function peticionPayuNegocio($totalPagar){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        $api_key = "4Vj8eK4rloUd272L48hsrarnUA";
        $merchanId = "508029";
        $accountId = "512321";
        $descripcion = "BoutiqueSW";
        $referenceCode = "Ref:".rand(1,100);;
        $tax = "0";
        $taxReturnBase = "0";
        $currency = "COP";
        $test = "1";
        $buyerEmail = $user->getCorreo();
        $amount = $totalPagar;
        $signature = md5($api_key.'~'.$merchanId.'~'.$referenceCode.'~'.$amount.'~'.$currency);
        $responseUrl = "http://localhost/App_Boutique/respuestaPayu";
        $confirmationUrl = "http://localhost/App_Boutique/confirmacionPayu";

        $peticion = array("merchanId" => $merchanId,"accountId" => $accountId,"descripcion" => $descripcion,"referenceCode" => $referenceCode,"tax" => $tax,"taxReturnBase"=>$taxReturnBase,"currency" => $currency,"test" => $test,"buyerEmail" => $buyerEmail,"responseUrl" => $responseUrl,"confirmationUrl" => $confirmationUrl,"amount" => $amount,"signature" => $signature);
        
        echo json_encode($peticion);
    }

    public function mostrarFacturaNegocio(){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        return ProductoDAO::mostrarFactura($user->getId()); 
    }

    public function mostrarProductosFacturaNegocio($factura){
        return ProductoDAO::mostrarProductosFactura($factura); 
    }

    public function mostrarProductosFavoritosNegocio(){
        include_once 'dto/ClienteDTO.php';
        $user = unserialize($_SESSION['Cliente']);
        return ProductoDAO::mostrarProductosFavoritos($user->getId());
    }

    public function guardarMensajeNegocio($MensajeDTO){
        return MensajeDAO::guardarMensaje($MensajeDTO);
    }

    public function mostrarMensajesNegocio(){
        return MensajeDAO::mostrarMensajes();
    }

    public function eliminarMensajeNegocio(){
        return MensajeDAO::eliminarMensaje();
    }

    public function actualizarInventarioNegocio($productoTalla, $nuevaCantidad){
        return ProductoDAO::actualizarInventario($productoTalla, $nuevaCantidad);
    }

    public function cargarTallasInventarioNegocio($idProducto){
        return ProductoDAO::cargarTallasInventario($idProducto);
    }

    public function añadirNuevasTallaNegocio($idProducto,$nuevasTallas){
        return ProductoDAO::añadirNuevasTalla($idProducto,$nuevasTallas);
    }

    public function cargarReportesNegocio($tipo){
        return AdministradorDAO::cargarReportes($tipo);
    }

    public function cargarReportesFacturaNegocio($tipo){
        return AdministradorDAO::cargarReportesFactura($tipo);
    }

    public function cargarProductosFacturaNegocio($factura){
        return AdministradorDAO::cargarProductosFactura($factura);
    }

    public function cambiarEstadoFacturaNegocio($factura,$nuevoEstado){
        return AdministradorDAO::cambiarEstadoFactura($factura,$nuevoEstado);
    }
}
