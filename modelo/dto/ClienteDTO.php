<?php

define('METHOD','AES-256-CBC');
define('SECRET_KEY','$ALEXANDER@2019sv');
define('SECRET_IV','101712');

class ClienteDTO
{
    private $id;
    private $nombres;
    private $apellidos;
    private $direccion;
    private $documento;
    private $correo;
    private $fechaNacimiento;
    private $contrasenia;
    private $foto;

    function __construct($nombres,$apellidos,$direccion,$documento,$correo,$fechaNacimiento,$contrasenia,$foto)
    {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->documento = $documento;
        $this->correo = $correo;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->contrasenia = $this->encriptar($contrasenia);
        $this->foto = $foto;
    }

    function getId()
    {
        return $this->id;
    }

    function getNombres()
    {
        return $this->nombres;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function getDireccion()
    {
        return $this->direccion;
    }

    function getDocumento()
    {
        return $this->documento;
    }

    function getCorreo()
    {
        return $this->correo;
    }

    function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    function getContrasenia()
    {
        return $this->contrasenia;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public static function encriptar($contrasenia){
        $salida = NULL;
        $key = hash('sha256',SECRET_KEY);
        $iv = substr(hash('sha256',SECRET_IV),0,16);
        $salida = openssl_encrypt($contrasenia,METHOD,$key,0,$iv);
        $salida = base64_encode($salida);
        return $salida;
    }

    public static function desencriptar($encriptada){
        $key = hash('sha256',SECRET_KEY);
        $iv = substr(hash('sha256',SECRET_IV),0,16);
        $salida = openssl_decrypt(base64_decode($encriptada),METHOD,$key,0,$iv);
        return $salida;
    }
}

?>