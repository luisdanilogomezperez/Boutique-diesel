<?php

class MensajeDTO {

    private $id;
    private $nombre;
    private $correo;
    private $asunto;
    private $mensaje;
    private $fechacreacion;

    function __construct($nombre,$correo,$asunto,$mensaje)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getCorreo(){
        return $this->correo;
    }

    function getAsunto(){
        return $this->asunto;
    }

    function getMensaje(){
        return $this->mensaje;
    }

    function getFechaCreacion(){
        return $this->fechacreacion;
    }

    function setId($id){
        $this->id = $id;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function setCorreo($correo){
        $this->correo = $correo;
    }

    function setAsunto($asunto){
        $this->asunto = $asunto;
    }

    function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    function setFechaCreacion($fechacreacion){
        $this->fechacreacion = $fechacreacion;
    }

}


?>