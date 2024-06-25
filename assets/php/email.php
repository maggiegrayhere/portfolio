<?php
    echo 'starting head';
// Include PHPMailer classes into the global namespace
// require 'libs/phpmailer/src/PHPMailer.php';
// require 'libs/phpmailer/src/SMTP.php';
// require 'libs/phpmailer/src/Exception.php';

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    echo 'starting inside try';
    // Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host       = 'smtp.hostinger.com';               // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'hello@maggiegray.co.uk';         // SMTP username
    $mail->Password   = 'Mal1c3L0v35Banana5!';                  // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                              // TCP port to connect to

    // Recipients
    // $mail->setFrom('from@example.com', 'Mailer');
    // $mail->addAddress('recipient@example.com', 'Joe User');  // Add a recipient, Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    $mail->setFrom('hello@maggiegray.co.uk', 'Mailer');
    $mail->addAddress('hello@maggiegray.co.uk', 'Joe User');  // Add a recipient, Name is optional
    $mail->addReplyTo('hello@maggiegray.co.uk', 'Information');

    // Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>