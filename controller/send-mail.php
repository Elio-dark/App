<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//#########################################
$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
// Load Composer's autoloader
require '../vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
//Server settings
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->SMTPDebug = 0;
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
	$mail->isSMTP(); // Send using SMTP
	$mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'emuculo25@gmail.com'; // SMTP username
	$mail->Password = 'eliodark25'; // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	//Recipients
	$mail->setFrom($email, $nome);
	$mail->addAddress('emuculo25@gmail.com', 'TAF'); // Add a recipient
	// Content
	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = $assunto;
	$mail->Body = $email . "<br>" . $mensagem;
	$mail->send();
	echo 'Message has been sent';
	header('Location: ../index.php?email-enviado');
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
