<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.bratinoff.ru';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->SMTPAutoTLS= false;
    $mail->Username   = 'danila@bratinoff.ru';                     //SMTP username
    $mail->Password   = 'jhqi336917';                               //SMTP password
    #$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          //Enable STARTTLS encryption
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    $mail->SMTPDebug = 2;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //Recipients
    $mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
    $mail->setFrom('danila@bratinoff.ru', 'Mailer');
    $mail->addAddress('spam@bratinoff.ru', 'Joe User'); 

    $service = $_POST['Услуга'];
    $name = $_POST['Имя:'];
    $email = $_POST['Почта:'];
    $phone = $_POST['Телефон:'];

    $message = $_POST['Комментарий'];
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Новая заявка';
    $mail->Body    = 'Имя: ' . $name . '\n' . 'Услуга: ' . $service;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
print_r(error_get_last());


?>