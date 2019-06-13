<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
     $clave = sha1(rand(0000,9999).rand(00,99));
     $producto = htmlentities($_POST['idProductoCargarFoto']);
     $actual = htmlentities($_POST['productoFotoActual']);
     $genero = htmlentities($_POST['productoGenero']);
     $ruta = $_FILES['imagen']['tmp_name'];
     $imagen = $_FILES['imagen']['name'];

     if($ruta != ''){
        $ancho = 850;
        $alto = 1200;
        $info = pathinfo($imagen);
        $tamanio = getimagesize($ruta);
        $width = $tamanio[0];
        $heigth = $tamanio[1];
          
        if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
         $imagenSubida = imagecreatefromjpeg($ruta);
         $imagenConvertida = imagecreatetruecolor($ancho,$alto);
         imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
         if(strcmp($actual, "vista/presentacion/assets/ProductoSinFoto.jpg")!==0){
             unlink($actual);
         }
         $copia = 'vista/presentacion/assets/img_perfil_Productos/'.$genero.'/'.$clave.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($ancho,$alto);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
            if(strcmp($actual, "vista/presentacion/assets/ProductoSinFoto.jpg")!==0){
             unlink($actual);
         }
            $copia = 'vista/presentacion/assets/img_perfil_Productos/'.$genero.'/'.$clave.'.png';
            imagepng($imagenConvertida,$copia);
        }else{
            $copia = $actual;
        }
     }else{
         $copia = $actual;
     }
 }
 require_once $_SERVER["DOCUMENT_ROOT"].'/App_Boutique/modelo/Conexion.php';
 $conexion = Conexion::crearConexion();
 $consulta = $conexion->prepare('UPDATE producto SET foto=? WHERE id=?;');
 $consulta->bindParam(1, $copia, PDO::PARAM_STR);
 $consulta->bindParam(2, $producto, PDO::PARAM_INT);
 $consulta->execute();
 header("location:Producto=".$producto);
?>

 
 
