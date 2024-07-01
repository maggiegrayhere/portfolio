<?php
// Include PHPMailer classes
require_once './PHPMailer-master/src/PHPMailer.php';
require_once './PHPMailer-master/src/Exception.php';
require_once './PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if fields are empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo json_encode(["message" => "Please fill in all fields."]);
        exit;
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid email address."]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username   = 'hello@maggiegray.co.uk';
    $mail->Password   = 'Magg13Gray3ma1l!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Enable verbose debug output
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'error_log';

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('hello@maggiegray.co.uk');
    $mail->addAddress('mag_owen@hotmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        
        // HTML Body
        $mail->Body = 'Message: ' . nl2br($message) . '<br>' . 
                      'Subject: ' . $subject . '<br>' . 
                      'Name: ' . $name . '<br>' . 
                      'Email Address: ' . $email;
        
        // Plain text body
        $mail->AltBody = 'Message: ' . $message . "\n" . 
                         'Subject: ' . $subject . "\n" . 
                         'Name: ' . $name . "\n" . 
                         'Email Address: ' . $email;

        $mail->send();
        echo json_encode(["message" => "Your message has been sent. Thank you!"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Invalid request method."]);
}
?>
