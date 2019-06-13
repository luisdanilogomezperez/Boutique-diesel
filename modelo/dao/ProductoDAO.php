<?php

class ProductoDAO {

    function crearProducto($productoDTO,$tallas){
        $exito = false;
        try{
            $nombre = $productoDTO->getNombre();
            $numero = $productoDTO->getNumero();
            $precio = $productoDTO->getPrecio();
            $marca = $productoDTO->getMarca();
            $descripcion = $productoDTO->getDescripcion();
            $genero = $productoDTO->getGenero();
            $categoria = $productoDTO->getCategoria();
            $color = $productoDTO->getColor();
            $tela = $productoDTO->getTela();
            $foto = $productoDTO->getFoto();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("INSERT INTO producto (numero,nombre,descripcion,foto,precio,marca,fechacreacion,categoria,color,genero,tela) VALUES (?,?,?,?,?,?,NOW(),?,?,?,?)");
            $consulta->bindParam(1,$numero,PDO::PARAM_STR);
            $consulta->bindParam(2,$nombre,PDO::PARAM_STR);
            $consulta->bindParam(3,$descripcion,PDO::PARAM_STR);
            $consulta->bindParam(4,$foto,PDO::PARAM_STR);
            $consulta->bindParam(5,$precio,PDO::PARAM_INT);
            $consulta->bindParam(6,$marca,PDO::PARAM_STR);
            $consulta->bindParam(7,$categoria,PDO::PARAM_INT);
            $consulta->bindParam(8,$color,PDO::PARAM_INT);
            $consulta->bindParam(9,$genero,PDO::PARAM_INT);
            $consulta->bindParam(10,$tela,PDO::PARAM_INT);
            $consulta->execute();
            $consulta2 = $conexion->prepare("SELECT id FROM producto WHERE numero =?;");
            $consulta2->bindParam(1,$numero,PDO::PARAM_STR);
            $consulta2->execute();
            $respuesta = $consulta2->fetch();
            $id = $respuesta['id'];
            $cadena = "INSERT INTO productotalla (producto,talla,cantidad) VALUES";
            for($i=0;$i<count($tallas);$i++){
                $cadena.='('.$id.','.$tallas[$i].',0),';
            }
            $sql = substr($cadena,0,-1);
             $sql.=';';
            $consulta3=$conexion->prepare($sql);
            $exito=$consulta3->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }

    function actualizarProducto($ProductoDTO,$id){
        $exito = false;
        try{
            $nombre = $ProductoDTO->getNombre();
            $precio = $ProductoDTO->getPrecio();
            $marca = $ProductoDTO->getMarca();
            $descripcion = $ProductoDTO->getDescripcion();
            $categoria = $ProductoDTO->getCategoria();
            $color = $ProductoDTO->getColor();
            $tela = $ProductoDTO->getTela();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE producto SET nombre = ?, precio = ?, marca = ?, descripcion = ?, categoria = ?,color = ?, tela = ? WHERE id = ?;");
            $consulta->bindParam(1,$nombre,PDO::PARAM_STR);
            $consulta->bindParam(2,$precio,PDO::PARAM_INT);
            $consulta->bindParam(3,$marca,PDO::PARAM_STR);
            $consulta->bindParam(4,$descripcion,PDO::PARAM_STR);
            $consulta->bindParam(5,$categoria,PDO::PARAM_INT);
            $consulta->bindParam(6,$color,PDO::PARAM_INT);
            $consulta->bindParam(7,$tela,PDO::PARAM_INT);
            $consulta->bindParam(8,$id,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }


    function mostrarProductos($filtro,$genero){
        try {
            $sql = 'SELECT producto.id AS id,producto.likes AS likes, producto.numero AS numero, producto.nombre AS nombre, producto.descripcion AS descripcion, producto.foto AS foto, producto.precio AS precio,producto.marca AS marca, producto.fechacreacion AS fechacreacion, categoria.nombre AS categoria, color.nombre AS color,genero.nombre AS genero,tela.nombre AS tela,tela.recomendaciones AS recomendaciones FROM producto INNER JOIN categoria ON producto.categoria = categoria.id INNER JOIN color ON producto.color = color.id INNER JOIN genero ON producto.genero = genero.id INNER JOIN tela ON producto.tela = tela.id WHERE genero.nombre = "'.$genero.'" ORDER BY id ASC;';
            if (strcmp($filtro, "undefined") !== 0) {
                if (is_numeric($filtro)) {
                    $sql = 'SELECT producto.id AS id,producto.likes AS likes,  producto.numero AS numero, producto.nombre AS nombre, producto.descripcion AS descripcion, producto.foto AS foto, producto.precio AS precio,producto.marca AS marca, producto.fechacreacion AS fechacreacion, categoria.nombre AS categoria, color.nombre AS color,genero.nombre AS genero,tela.nombre AS tela,tela.recomendaciones AS recomendaciones FROM producto INNER JOIN categoria ON producto.categoria = categoria.id INNER JOIN color ON producto.color = color.id INNER JOIN genero ON producto.genero = genero.id INNER JOIN tela ON producto.tela = tela.id WHERE genero.nombre ="'.$genero.'" AND producto.precio <= '.$filtro.' ORDER BY id ASC;';
                }else if(strcmp($genero, "todos") == 0){
                    $sql = 'SELECT producto.id AS id,producto.likes AS likes,  producto.numero AS numero, producto.nombre AS nombre, producto.descripcion AS descripcion, producto.foto AS foto, producto.precio AS precio,producto.marca AS marca, producto.fechacreacion AS fechacreacion, categoria.nombre AS categoria,categoria.id AS idcategoria, color.nombre AS color,color.id AS idcolor, genero.nombre AS genero,tela.nombre AS tela,tela.id AS idtela,tela.recomendaciones AS recomendaciones FROM producto INNER JOIN categoria ON producto.categoria = categoria.id INNER JOIN color ON producto.color = color.id INNER JOIN genero ON producto.genero = genero.id INNER JOIN tela ON producto.tela = tela.id ORDER BY id ASC;';
                } else {
                    $sql = 'SELECT id,likes,numero,nombre,descripcion,foto,precio,marca,fechacreacion,categoria,color,genero,tela,recomendaciones FROM (SELECT producto.id AS id,producto.likes AS likes,  producto.numero AS numero, producto.nombre AS nombre, producto.descripcion AS descripcion, producto.foto AS foto, producto.precio AS precio,producto.marca AS marca, producto.fechacreacion AS fechacreacion, categoria.nombre AS categoria, color.nombre AS color,genero.nombre AS genero,tela.nombre AS tela,tela.recomendaciones AS recomendaciones FROM producto INNER JOIN categoria ON producto.categoria = categoria.id INNER JOIN color ON producto.color = color.id INNER JOIN genero ON producto.genero = genero.id INNER JOIN tela ON producto.tela = tela.id WHERE genero.nombre = "'.$genero.'" ORDER BY id ASC) AS hombres where nombre LIKE "%' . $filtro . '%" OR descripcion LIKE "%' . $filtro . '%" OR marca LIKE "%' . $filtro . '%" OR fechacreacion LIKE "%' . $filtro . '%" OR categoria LIKE "%' . $filtro . '%" OR color LIKE "%' . $filtro . '%" OR tela LIKE "%' . $filtro . '%" OR numero LIKE "%' . $filtro . '%" OR recomendaciones LIKE "%' . $filtro . '%";';
                }
            }
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($productos);
        } catch (Exception $ex) {
            throw new Exception("Ocurrio un error" . $ex->getTraceAsString());
        }
    }

    function listarTallasProducto($id,$tipo){
        try{
            $conexion = Conexion::crearConexion();
            $sql = "";
            if(strcmp($tipo,"productos")===0){
                $sql = "AND productotalla.cantidad>0";
            }
            $consulta = $conexion->prepare("SELECT productotalla.id AS idproductotalla,producto.nombre AS producto,productotalla.cantidad AS cantidad,talla.id AS idtalla, talla.numero AS numerotalla,talla.pecho AS pecho,talla.cintura AS cintura,talla.cadera AS cadera,genero.nombre AS genero FROM talla INNER JOIN genero ON talla.genero = genero.id INNER JOIN productotalla ON talla.id = productotalla.talla INNER JOIN producto ON producto.id = productotalla.producto WHERE producto.id = ? ".$sql.";");

            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $tallas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tallas);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function añadirFavorito($producto,$cliente){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id FROM productofavorito WHERE productofavorito.cliente = ? AND productofavorito.producto = ?;");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->bindParam(2,$producto,PDO::PARAM_INT);
            $exito = $consulta->execute();
            
            $filas = $consulta->rowCount();
            if($filas<1){
            $consulta2 = $conexion->prepare("UPDATE producto SET likes= (likes+1) WHERE id = ?");
            $consulta2->bindParam(1,$producto,PDO::PARAM_INT);
            $consulta2->execute();
            $consulta3=$conexion->prepare("INSERT INTO productofavorito (cliente,producto) VALUES (?,?);");
            $consulta3->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta3->bindParam(2,$producto,PDO::PARAM_INT);
            $exito = $consulta3->execute();
            }else{
                $exito = false;
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function eliminarFavorito($producto,$cliente){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id FROM productofavorito WHERE productofavorito.cliente = ? AND productofavorito.producto = ?;");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->bindParam(2,$producto,PDO::PARAM_INT);
            $exito = $consulta->execute();
            
            $filas = $consulta->rowCount();
            if($filas>0){
            $consulta2 = $conexion->prepare("UPDATE producto SET likes= (likes-1) WHERE id = ?");
            $consulta2->bindParam(1,$producto,PDO::PARAM_INT);
            $consulta2->execute();
            $consulta3=$conexion->prepare("DELETE FROM productofavorito WHERE cliente = ? AND producto = ?");
            $consulta3->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta3->bindParam(2,$producto,PDO::PARAM_INT);
            $exito = $consulta3->execute();
            }else{
                $exito = false;
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }
    
    function obtenerFavoritos($cliente){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT producto FROM productofavorito WHERE cliente = ?");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->execute();

            while ($desocupados = $consulta->fetch()){
                echo $desocupados['producto'].',';
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function añadirCarrito($cliente,$tallaProducto){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT * FROM carrito WHERE cliente=? AND productotalla = ?");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->bindParam(2,$tallaProducto,PDO::PARAM_INT);
            $consulta->execute();
            $filas = $consulta->rowCount();
            if($filas > 0){
                $exito = false;
            }else{
            $consulta2 = $conexion->prepare("INSERT INTO carrito (cliente,productotalla) VALUES (?,?)");
            $consulta2->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta2->bindParam(2,$tallaProducto,PDO::PARAM_INT);
            $exito = $consulta2->execute();
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function mostrarCarrito($cliente){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT carrito.id AS carrito,carrito.cantidadllevar AS cantidadllevar,producto.foto AS foto, producto.nombre AS nombre,producto.descripcion AS descripcion,producto.precio AS precio,productotalla.cantidad AS cantidad,producto.id AS idproducto,talla.numero AS talla FROM carrito INNER JOIN productotalla ON carrito.productotalla = productotalla.id INNER JOIN producto ON productotalla.producto = producto.id INNER JOIN talla on productotalla.talla = talla.id WHERE carrito.cliente = ?;");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->execute();
            $carrito = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($carrito);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function eliminarProductoCarrito($producto){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("DELETE FROM carrito WHERE id = ?");
            $consulta->bindParam(1,$producto,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }

        return $exito;
    }

    function actualizarCantidadCarrito($carrito,$nuevaCantidad){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT productotalla.cantidad AS permitido FROM productotalla INNER JOIN carrito ON carrito.productotalla = productotalla.id WHERE carrito.id = ?;");
            $consulta->bindParam(1,$carrito,PDO::PARAM_INT);
            $consulta->execute();
            $respuesta = $consulta->fetch();
            $permitido = $respuesta['permitido'];
            if($nuevaCantidad<=$permitido){
            $consulta2 = $conexion->prepare("UPDATE carrito SET cantidadllevar = ? WHERE id = ?");
            $consulta2->bindParam(1,$nuevaCantidad,PDO::PARAM_INT);
            $consulta2->bindParam(2,$carrito,PDO::PARAM_INT);
            $exito = $consulta2->execute();
            }else{
                $exito = false;
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }

        return $exito;
    }

    function cargarGaleriaProducto($producto){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT fotos.ruta AS ruta FROM fotos WHERE fotos.producto = ?;");
            $consulta->bindParam(1,$producto,PDO::PARAM_INT);
            $consulta->execute();
            $galeria = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($galeria);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function mostrarFactura($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT factura.id AS id,factura.idtransaccion AS transaccion,factura.tipopago AS tipopago,factura.empresapago AS empresapago,factura.fecha AS fecha,factura.total AS totalpagar,estado.estado AS estado,estado.descripcion AS estadodescripcion FROM factura INNER JOIN estado ON factura.estado = estado.id WHERE factura.cliente = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $facturas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($facturas);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function mostrarProductosFactura($factura){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT producto.id AS producto,producto.nombre AS nombre,talla.numero AS talla,compra.cantidad AS comprado,producto.precio AS precio FROM producto INNER JOIN productotalla ON productotalla.producto = producto.id INNER JOIN talla ON productotalla.talla = talla.id INNER JOIN compra ON compra.productotalla = productotalla.id WHERE compra.factura = ?;");
            $consulta->bindParam(1,$factura,PDO::PARAM_INT);
            $consulta->execute();
            $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($productos);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function mostrarProductosFavoritos($cliente){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT producto.id AS idproducto, producto.foto AS foto FROM producto INNER JOIN productofavorito ON productofavorito.producto = producto.id WHERE productofavorito.cliente =? ORDER BY idproducto DESC;");
            $consulta->bindParam(1,$cliente,PDO::PARAM_INT);
            $consulta->execute();
            $productosFavoritos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($productosFavoritos);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function actualizarInventario($productoTalla, $nuevaCantidad){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE productotalla SET cantidad = ? WHERE id = ?");
            $consulta->bindParam(1,$nuevaCantidad,PDO::PARAM_INT);
            $consulta->bindParam(2,$productoTalla,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function cargarTallasInventario($idProducto){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT talla.id AS idtalla, talla.numero AS numero FROM talla WHERE talla.genero = (SELECT producto.genero FROM producto WHERE producto.id = ?) AND talla.id NOT IN (SELECT productotalla.talla FROM productotalla WHERE productotalla.producto = ?);");
            $consulta->bindParam(1,$idProducto,PDO::PARAM_INT);
            $consulta->bindParam(2,$idProducto,PDO::PARAM_INT);
            $consulta->execute();
            $tallas = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($tallas);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function añadirNuevasTalla($idProducto,$nuevasTallas){
        $exito = false;
        try{
            $conexion = Conexion::crearConexion();
            $cadena = "INSERT INTO productotalla (producto,talla,cantidad) VALUES";
            for($i=0;$i<count($nuevasTallas);$i++){
                $cadena.='('.$idProducto.','.$nuevasTallas[$i].',1),';
            }
            $sql = substr($cadena,0,-1);
            $sql.=';';
            $consulta = $conexion->prepare($sql);
            $exito = $consulta->execute();
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }
}
