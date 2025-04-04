<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["emailAddress"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'adlensouci07@outlook.com';                     //SMTP username
        $mail->Password   = '123-Adlen';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 465 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_SMTPS`


        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('adlenssouci07@outlook.com', 'adlen');  

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        //echo 'Message has been sent';
        // Après l'envoi du message avec succès
        echo '<script>showConfirmation();</script>';
    } catch (Exception $e) {
       // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
