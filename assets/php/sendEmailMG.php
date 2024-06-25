<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';

try {
    $mail = new PHPMailer();

    // Enable verbose debug output
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hello@maggiegray.co.uk'; 
    $mail->Password   = 'Mal1c3L0v35Banana5!'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port       = 465; 

    // Sender information
    $mail->setFrom('from@maggiegray.co.uk', 'Maggie Gray');
    
    // Recipient
    $mail->addAddress('hello@maggiegray.co.uk'); 

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email body.';

    // Send the email
    if (!$mail->send()) {
        $msg = 'Sorry, something went wrong. Please try again later.';
        error_log("Mailer Error: " . $mail->ErrorInfo);
    } else {
        $msg = 'Message sent! Thanks for contacting us.';
    }
} catch (Exception $e) {
    error_log("Exception caught: " . $e->getMessage());
    echo 'Sorry, something went wrong. Please try again later.';
}

?>
