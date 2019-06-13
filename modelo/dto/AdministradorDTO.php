<?php

class AdministradorDTO
{
    private $id;
    private $nombres;
    private $apellidos;
    private $documento;
    private $correo;
    private $contrasenia;

    function __construct($nombres,$apellidos,$documento,$correo,$contrasenia)
    {
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->documento = $documento;
        $this->correo = $correo;
        $this->contrasenia = $contrasenia;
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

    function getDocumento()
    {
        return $this->documento;
    }

    function getCorreo()
    {
        return $this->correo;
    }

    function getContrasenia()
    {
        return $this->contrasenia;
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

    function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

}

?>