<?php

    class MensajeDAO{
        
        function guardarMensaje($MensajeDTO){
            $exito = false;
            try{
                $nombre = $MensajeDTO->getNombre();
                $correo  = $MensajeDTO->getCorreo();
                $asunto  = $MensajeDTO->getAsunto();
                $mensaje  = $MensajeDTO->getMensaje();
                $filas = MensajeDAO::buscarMensaje($correo);
                if($filas>0){
                    $exito = false;
                }else{
                $conexion = Conexion::crearConexion();
                $consulta = $conexion->prepare("INSERT INTO mensaje (nombre,correo,asunto,mensaje,fechacreacion) VALUES (?,?,?,?,NOW());");
                $consulta->bindParam(1,$nombre,PDO::PARAM_STR);
                $consulta->bindParam(2,$correo,PDO::PARAM_STR);
                $consulta->bindParam(3,$asunto,PDO::PARAM_STR);
                $consulta->bindParam(4,$mensaje,PDO::PARAM_STR);
                $exito = $consulta->execute();
                }
            }catch(Exception $exc){
                throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
            }
            return $exito;
        }

        public static function buscarMensaje($correo){
            $filas = 0;
            try{
                $conexion = Conexion::crearConexion();
                $consulta = $conexion->prepare("SELECT * FROM mensaje WHERE correo = ?;");
                $consulta->bindParam(1,$correo,PDO::PARAM_STR);
                $consulta->execute();
                $filas = $consulta->rowCount();
            }catch(Exception $exc){
                throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
            }
            return $filas;
        }

        public function mostrarMensajes(){
            try{
                $conexion = Conexion::crearConexion();
                $consulta = $conexion->prepare("SELECT id,nombre,correo,asunto,mensaje,fechacreacion FROM mensaje");
                $consulta->execute();
                $mensajes = $consulta->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($mensajes);
            }catch(Exception $exc){
                throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
            }
        }

        public function eliminarMensaje(){
            $exito = false;
            try{
                $conexion = Conexion::crearConexion();
                $consulta = $conexion->prepare("DELETE FROM mensaje;");
                $exito = $consulta->execute();
            }catch(Exception $exc){
                throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
            }
            return $exito;
        }

    }


?>