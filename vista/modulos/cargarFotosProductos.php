<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $claveProducto = htmlentities($_POST['productoCargarFotos']);
    $genero = htmlentities($_POST['generoCargarFotos']);
    $contador = 0;
    
    foreach($_FILES['imagenesProducto']['tmp_name'] as $key => $value){
        $ruta = $_FILES['imagenesProducto']['tmp_name'][$key];
        $imagen = $_FILES['imagenesProducto']['name'][$key];
        
        $clave = sha1(rand(0000,9999).rand(00,99));
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
         $contador++;
         $aleatorio = rand(000,999);
         $nombreFoto = $clave.$aleatorio.$contador;
         $copia = 'vista/presentacion/assets/img_productos/'.$genero.'/'.$nombreFoto.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($ancho,$alto);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
            $contador++;
            $aleatorio = rand(000,999);
            $nombreFoto = $clave.$aleatorio.$contador;
            $copia = 'vista/presentacion/assets/img_productos/'.$genero.'/'.$nombreFoto.'.png';
            imagepng($imagenConvertida,$copia);
        }else{
            header('location:Producto='.$claveProducto);
        }

        require_once $_SERVER["DOCUMENT_ROOT"] . '/App_Boutique/modelo/Conexion.php';
        $conexion = Conexion::crearConexion();
        $consulta = $conexion->prepare("INSERT INTO fotos (ruta,producto) VALUES (?,?) ");
        $consulta->bindParam(1, $copia, PDO::PARAM_STR);
        $consulta->bindParam(2, $claveProducto, PDO::PARAM_INT);
        $consulta->execute();  
    }
    header("location:Producto=".$claveProducto);
}
?>


