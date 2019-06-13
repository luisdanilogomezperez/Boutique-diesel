<?php

class ProductoDTO
{
    private $id;
    private $numero;
    private $nombre;
    private $descripcion;
    private $foto;
    private $precio;
    private $marca;
    private $fechaCreacion;
    private $categoria;
    private $color;
    private $genero;
    private $tela;

    function __construct($numero,$nombre,$descripcion,$foto,$precio,$marca,$categoria,$color,$genero,$tela)
    {
        $this->numero = $numero;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
        $this->precio = $precio;
        $this->marca = $marca;
        $this->categoria = $categoria;
        $this->color = $color;
        $this->genero = $genero;
        $this->tela = $tela;
    }

    function getId()
    {
        return $this->id;
    }

    function getNumero()
    {
        return $this->numero;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    function getFoto()
    {
        return $this->foto;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getMarca()
    {
        return $this->marca;
    }

    function getColor()
    {
        return $this->color;
    }

    function getGenero()
    {
        return $this->genero;
    }

    function getTela()
    {
        return $this->tela;
    }
    
    function getCategoria()
    {
        return $this->categoria;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setNumero($numero)
    {
        $this->numero = $numero;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setFoto($foto)
    {
        $this->foto = $foto;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    function setMarca($marca)
    {
        $this->marca = $marca;
    }

    function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function setGenero($genero)
    {
        $this->genero = $genero;
    }

    function setTela($tela)
    {
        $this->tela = $tela;
    }

}

?>