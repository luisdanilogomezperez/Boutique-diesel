<?php

class AdministradorDAO
{

    function cargarGeneros()
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombre FROM genero");
            $consulta->execute();
            $grupos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($grupos);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cargarCategorias()
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombre FROM categoria");
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($categorias);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cargarColores()
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombre FROM color");
            $consulta->execute();
            $colores = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($colores);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cargarTelas()
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombre FROM tela");
            $consulta->execute();
            $telas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($telas);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cargarTallas($genero)
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,numero FROM talla WHERE genero = ?");
            $consulta->bindParam(1, $genero, PDO::PARAM_INT);
            $consulta->execute();
            $tallas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tallas);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function buscarAdministrador($a, $b)
    {
        $AdministradorDTO = null;
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombres,apellidos,documento,correo,contrasenia FROM administrador WHERE correo=? AND contrasenia = ?");
            $consulta->bindParam(1, $a, PDO::PARAM_STR);
            $consulta->bindParam(2, $b, PDO::PARAM_STR);
            $consulta->execute();
            $filas = $consulta->rowCount();
            if ($filas > 0) {
                $datos = $consulta->fetch();
                $AdministradorDTO = new AdministradorDTO($datos['nombres'], $datos['apellidos'], $datos['documento'], $datos['correo'], $datos['contrasenia']);
                $AdministradorDTO->setId($datos['id']);
            }
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $AdministradorDTO;
    }

    function cargarReportes($tipo)
    {
        try {
            $conexion = Conexion::crearConexion();
            $sql = '';
            switch ($tipo) {
                case 'diario':
                    $sql = '(SELECT IFNULL(SUM(factura.total),0) AS totalcompras FROM factura WHERE factura.fecha = CURDATE()) UNION (SELECT IFNULL(SUM(factura.total),0) FROM factura WHERE factura.fecha = (SELECT date_sub(CURDATE(), INTERVAL 1 DAY)));';
                    break;
                case 'semanal':
                    $sql = '(SELECT IFNULL(SUM(factura.total),0) AS totalcompras FROM factura WHERE factura.fecha >= (SELECT date_sub(CURDATE(), INTERVAL 8 DAY))) UNION (SELECT IFNULL(SUM(factura.total),0) AS totalcompras FROM factura WHERE factura.fecha  BETWEEN (SELECT date_sub(CURDATE(), INTERVAL 15 DAY)) AND (SELECT date_sub(CURDATE(), INTERVAL 7 DAY))) ';
                    break;
                case 'mensual':
                    $sql = '(SELECT IFNULL(SUM(factura.total),0) AS totalcompras FROM factura WHERE MONTH(factura.fecha) = MONTH(CURDATE())) UNION (SELECT IFNULL(SUM(factura.total),0) FROM factura WHERE MONTH(factura.fecha) = (MONTH(CURDATE())-1));';
                    break;
                case 'total':
                    $sql = 'SELECT IFNULL(SUM(factura.total),0) AS totalcompras FROM factura;';
                    break;
            }

            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $reporte = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($reporte);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cargarReportesFactura($tipo)
    {
        try {
            $conexion = Conexion::crearConexion();
            $sql = '';
            switch ($tipo) {
                case 'diario':
                    $sql = 'SELECT cliente.nombres, cliente.apellidos,factura.id,factura.fecha, factura.tipopago,factura.empresapago,factura.total FROM cliente INNER JOIN factura ON cliente.id = factura.cliente WHERE factura.fecha = CURDATE();';
                    break;
                case 'semanal':
                    $sql = 'SELECT cliente.nombres, cliente.apellidos,factura.id,factura.fecha,factura.tipopago,factura.empresapago,factura.total FROM cliente INNER JOIN factura ON cliente.id = factura.cliente WHERE factura.fecha >= (SELECT date_sub(CURDATE(), INTERVAL 8 DAY));';
                    break;
                case 'mensual':
                    $sql = 'SELECT cliente.nombres, cliente.apellidos,factura.id,factura.fecha,factura.tipopago,factura.empresapago,factura.total FROM cliente INNER JOIN factura ON cliente.id = factura.cliente WHERE MONTH(factura.fecha) = MONTH(CURDATE());';
                    break;
                case 'total':
                    $sql = 'SELECT cliente.nombres,cliente.direccion, cliente.apellidos,factura.id,factura.fecha,factura.tipopago,factura.empresapago,factura.total,estado.id AS idestado,estado.estado AS nombreestado,estado.descripcion AS estadodescripcion FROM cliente INNER JOIN factura ON cliente.id = factura.cliente INNER JOIN estado ON estado.id = factura.estado;';
                    break;
            }
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $reporteFacturas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($reporteFacturas);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }
    function cargarProductosFactura($factura)
    {
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT producto.nombre AS nombre,producto.precio AS precio,genero.nombre AS genero,categoria.nombre AS categoria,talla.numero AS talla,compra.cantidad AS cantidad FROM producto INNER JOIN categoria ON producto.categoria = categoria.id INNER JOIN genero ON producto.genero = genero.id INNER JOIN productotalla ON producto.id = productotalla.producto INNER JOIN talla ON productotalla.talla = talla.id INNER JOIN compra ON compra.productotalla = productotalla.id INNER JOIN factura ON compra.factura = factura.id WHERE factura.id = ?;");
            $consulta->bindParam(1,$factura,PDO::PARAM_INT);
            $consulta->execute();
            $productosFactura = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($productosFactura);
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function cambiarEstadoFactura($factura,$nuevoEstado){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE factura SET estado = ? WHERE id = ?");
            $consulta->bindParam(1,$nuevoEstado,PDO::PARAM_INT);
            $consulta->bindParam(2,$factura,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }
}
