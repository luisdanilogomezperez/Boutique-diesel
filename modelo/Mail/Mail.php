<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function enviarCorreoRecordarContraseña($email, $nombres,$apellidos, $contrasenia) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "pruebaswebufps@gmail.com";
            $mail->Password = "kakaroto1494";
            $mail->setFrom('palo1493@gmail.com', 'Boutique');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recordar Clave del Sistema de Boutique'; //asunto
            $mail->Body = $this->plantillaMensaje($nombres,$apellidos,$contrasenia); //mensaje
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            throw new Exception('No lograste enviar el correo ');
        }
        return $exito;
    }

    public function plantillaMensaje($nombre,$apellidos,$contrasenia) {
        $plantilla = '<!DOCTYPE html>    
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body style="padding: 0;margin: 0;">
    <div style="width: 100%;height: 100%; background: red;margin:0;padding:0;display:block;">
        <div style="position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
          height: 100%;
          width: 100%;">
            <div style="margin: 0;padding: 0; background: blue;">
                <img style="height: 100%;width: 100%;" src="http://www.bohmerproject.nl/oud/projecten/winkelinterieur/kledingwinkel/fotos/unusual1.jpg" alt="No se encontro la imagen">
            </div>
            <div style="margin: 0;padding-bottom: 20px; background: black;color: white;text-align: center;font-family: cursive;font-size:40px;border: 5px solid white;">
                <h1>Hola,</h1>
                <h2>'.$nombre.' '.$apellidos.'</h2>
                <hr>
                <p>Su contraseña es: <strong>'.$contrasenia.'</strong>, recuerde seguir los pasos de seguridad indicados por el sistema al momento de intentar recuperar la contraseña.</p>
                <a href="http://localhost/App_Boutique/Ingresar" style="display: block;background: white;color: black;text-decoration: none;width: 100%;height: 50px; margin: 5px;">Ir a Boutique</a>
            </div>
        </div>
    </div>
</body>
</html>
';
        return $plantilla;
    }

}
