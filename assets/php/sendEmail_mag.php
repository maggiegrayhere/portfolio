<?php
// Include PHPMailer classes
// require_once '../../libs/PHPMailer/src/PHPMailer.php';
// require_once '../../libs/PHPMailer/src/Exception.php';
// require_once '../../libs/PHPMailer/src/SMTP.php';
require_once '../vendor/PHPMailer-master/src/Exception.php';
require_once '../vendor/PHPMailer-master/src/PHPMailer.php';
require_once '../vendor/PHPMailer-master/src/SMTP.php';

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
        $mail->Username = 'hello@maggiegray.co.uk'; // SMTP username
        $mail->Password = 'Mal1c3L0v35Banana5!'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('from@maggiegray.co.uk', 'Recipient Name'); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message); // Convert newlines to <br> tags for HTML
        $mail->AltBody = $message; // Plain text version

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
