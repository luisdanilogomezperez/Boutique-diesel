<?php

class ClienteDAO
{

    function buscarCliente($a, $b, $uso)
    {
        $ClienteDTO = null;
        try {
            $conexion = Conexion::crearConexion();
            if (strcmp($uso, "registrar") == 0) {
                $consulta = $conexion->prepare("SELECT id,nombres,apellidos,documento,correo,fechanacimiento,contrasenia,foto,direccion FROM cliente WHERE documento=? OR correo = ?");
            } else {
                $consulta2 = $conexion->prepare("SELECT contrasenia FROM cliente WHERE correo=?");
                $consulta2->bindParam(1, $a, PDO::PARAM_STR);
                $consulta2->execute();
                $filas = $consulta2->rowCount();
                if ($filas > 0) {
                    $datos = $consulta2->fetch();
                    $actual = $datos['contrasenia'];
                    $encriptada = ClienteDTO::desencriptar($actual);
                    if (strcmp($encriptada, $b) == 0) {
                        $b = $actual;
                        $consulta = $conexion->prepare("SELECT id,nombres,apellidos,documento,correo,fechanacimiento,contrasenia,foto,direccion FROM cliente WHERE correo=? AND contrasenia = ?");
                    }else{
                        return $ClienteDTO;
                    }
                }else{
                    return $ClienteDTO;
                }
            }

            $consulta->bindParam(1, $a, PDO::PARAM_STR);
            $consulta->bindParam(2, $b, PDO::PARAM_STR);
            $consulta->execute();
            $filas = $consulta->rowCount();
            if ($filas > 0) {
                $datos = $consulta->fetch();
                $ClienteDTO = new ClienteDTO($datos['nombres'], $datos['apellidos'], $datos['direccion'], $datos['documento'], $datos['correo'], $datos['fechanacimiento'], $datos['contrasenia'], $datos['foto']);
                $ClienteDTO->setId($datos['id']);
                $ClienteDTO->setContrasenia($datos['contrasenia']);
            }
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $ClienteDTO;
    }

    function registrarCliente($ClienteDTO)
    {
        $exito = false;
        try {
            $nombres = $ClienteDTO->getNombres();
            $apellidos = $ClienteDTO->getApellidos();
            $direccion = $ClienteDTO->getDireccion();
            $documento = $ClienteDTO->getDocumento();
            $correo = $ClienteDTO->getCorreo();
            $fechaNacimiento = $ClienteDTO->getFechaNacimiento();
            $contrasenia = $ClienteDTO->getContrasenia();
            $foto = $ClienteDTO->getFoto();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("INSERT INTO cliente (nombres,apellidos,documento,correo,fechanacimiento,contrasenia,foto,direccion) VALUES (?,?,?,?,?,?,?,?)");
            $consulta->bindParam(1, $nombres, PDO::PARAM_STR);
            $consulta->bindParam(2, $apellidos, PDO::PARAM_STR);
            $consulta->bindParam(3, $documento, PDO::PARAM_STR);
            $consulta->bindParam(4, $correo, PDO::PARAM_STR);
            $consulta->bindParam(5, $fechaNacimiento, PDO::PARAM_STR);
            $consulta->bindParam(6, $contrasenia, PDO::PARAM_STR);
            $consulta->bindParam(7, $foto, PDO::PARAM_STR);
            $consulta->bindParam(8, $direccion, PDO::PARAM_STR);
            $exito = $consulta->execute();
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function actualizarCliente($id, $ClienteDTO)
    {
        $exito = false;
        try {
            $nombres = $ClienteDTO->getNombres();
            $apellidos = $ClienteDTO->getApellidos();
            $direccion = $ClienteDTO->getDireccion();
            $documento = $ClienteDTO->getDocumento();
            $correo = $ClienteDTO->getCorreo();
            $fechaNacimiento = $ClienteDTO->getFechaNacimiento();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE cliente SET nombres=? , apellidos=?,documento=?,correo=?,fechanacimiento=?,direccion = ? WHERE id = ?;");
            $consulta->bindParam(1, $nombres, PDO::PARAM_STR);
            $consulta->bindParam(2, $apellidos, PDO::PARAM_STR);
            $consulta->bindParam(3, $documento, PDO::PARAM_STR);
            $consulta->bindParam(4, $correo, PDO::PARAM_STR);
            $consulta->bindParam(5, $fechaNacimiento, PDO::PARAM_STR);
            $consulta->bindParam(6, $direccion, PDO::PARAM_STR);
            $consulta->bindParam(7, $id, PDO::PARAM_INT);
            $exito = $consulta->execute();
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function cambiarContrasenia($id, $contraseniaNueva)
    {
        $exito = false;
        try {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE cliente SET contrasenia=?  WHERE id = ?;");
            $consulta->bindParam(1, $contraseniaNueva, PDO::PARAM_STR);
            $consulta->bindParam(2, $id, PDO::PARAM_INT);
            $exito = $consulta->execute();
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function recordarContrasenia($ClienteDTO)
    {
        $exito = null;
        try {
            $correo = $ClienteDTO->getCorreo();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT nombres,apellidos,contrasenia FROM cliente WHERE correo=?;");
            $consulta->bindParam(1, $correo, PDO::PARAM_STR);
            $consulta->execute();
            $filas = $consulta->rowCount();
            if ($filas > 0) {
                $respuesta = $consulta->fetch();
                $ClienteDTO->setNombres($respuesta['nombres']);
                $ClienteDTO->setApellidos($respuesta['apellidos']);
                $desencriptar = ClienteDTO::desencriptar($respuesta['contrasenia']);
                $ClienteDTO->setContrasenia($desencriptar);
                $exito = $ClienteDTO;
            }
        } catch (Exception $exc) {
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }
}
