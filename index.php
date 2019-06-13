<?php

// Importar Archivos Externos
require_once './controlador/Controlador.php';
require_once './modelo/Negocio.php';
require_once './modelo/Conexion.php';

// Activar Almacenamiento en el bufer de la pagina
ob_start();
$controlador = new Controlador();
$controlador->generarPlantilla();

?>