<?php


$nombre = $_POST["name"];
$email = $_POST["email"];
$mensaje = $_POST["message"];
$body = "Nombre y Apellido: " . $nombre . "<br>Correo: " . $email . "<br>Mensaje: " . $mensaje; 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

	define('CLAVE', '6LfZP6wfAAAAAAotDhCCmHFHd91tkiNrKfVg5En-');
	
	$token = $_POST['token'];
	$action = $_POST['action'];
	
	$cu = curl_init();
	curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($cu, CURLOPT_POST, 1);
	curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => CLAVE, 'response' => $token)));
	curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($cu);
	curl_close($cu);
	
	$datos = json_decode($response, true);
	
	print_r($datos);
	
	if($datos['success'] == 1 && $datos['score'] >= 0.5){
		if($datos['action'] == 'validarUsuario'){
			
		}
		
		} else {
		echo "ERES UN ROBOT";
	}

    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                           //Send using SMTP
    $mail->Host       = 'smtp.zoho.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                  //Enable SMTP authentication
    $mail->Username   = 'info@fosclean.com';   //SMTP username
    $mail->Password   = 'Fos13915563';         //SMTP password
    $mail->SMTPSecure = 'tls';                 //Enable implicit TLS encryption
    $mail->Port       = 587;                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@fosclean.com', $nombre);
    $mail->addAddress('info@fosclean.com', $nombre);     //Add a recipient

    //Content
    $mail->isHTML(true);                        //Set email format to HTML
    $mail->Subject = 'Mensaje desde formulario de contacto';
    $mail->Body    = $body;

    $mail->send();
    echo "Thanks for sending your message! We'll get back to you shortly.";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}