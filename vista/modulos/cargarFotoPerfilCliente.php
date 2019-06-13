<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
     $clave = sha1(rand(0000,9999).rand(00,99));
     $cliente = htmlentities($_POST['idCliente']);
     $actual = htmlentities($_POST['fotoActualCliente']);
     $ruta = $_FILES['imagen']['tmp_name'];
     $imagen = $_FILES['imagen']['name'];

     if($ruta != ''){
        $ancho = 800;
        $alto = 800;
        $info = pathinfo($imagen);
        $tamanio = getimagesize($ruta);
        $width = $tamanio[0];
        $heigth = $tamanio[1];
          
        if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
         $imagenSubida = imagecreatefromjpeg($ruta);
         $imagenConvertida = imagecreatetruecolor($ancho,$alto);
         imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
         if(strcmp($actual, "vista/presentacion/assets/PerfilSinFoto.png")!==0){
             unlink($actual);
         }
         $copia = 'vista/presentacion/assets/fotos_usuarios/'.$clave.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($ancho,$alto);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
            if(strcmp($actual, "vista/presentacion/assets/PerfilSinFoto.png")!==0){
             unlink($actual);
         }
            $copia = 'vista/presentacion/assets/fotos_usuarios/'.$clave.'.png';
            imagepng($imagenConvertida,$copia);
        }else{
            $copia = $actual;
        }
     }else{
         $copia = $actual;
     }
 }
 require_once $_SERVER["DOCUMENT_ROOT"].'/App_Boutique/modelo/Conexion.php';
 $UsuarioActualizado = unserialize($_SESSION["Cliente"]);
 $UsuarioActualizado->setFoto($copia);
 $conexion = Conexion::crearConexion();
 $consulta = $conexion->prepare('UPDATE cliente SET foto=? WHERE id=?;');
 $consulta->bindParam(1, $copia, PDO::PARAM_STR);
 $consulta->bindParam(2, $cliente, PDO::PARAM_INT);
 $_SESSION["Cliente"] = serialize($UsuarioActualizado);
 $consulta->execute();
 header("location:Perfil");
?>

 
 
