<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'hello@maggiegray.co.uk';
    $mail->Password   = 'Magg13Gray3ma1l!';
    $mail->Port       = 587;

    $mail->setFrom('hello@maggiegray.co.uk', 'Web Form');

    $mail->addAddress('hello@maggiegray.co.uk');
    $mail->addAddress('mag_owen@hotmail.com');

    $mail->isHTML(false);
    // $mail->$_POST['email'];
    // $mail->Name = $_POST['name'];
    $mail->Subject = $_POST['subject'];
    $mail->Body = 'Name: ' . $_POST['name'] . "\n" . 'Email Address: ' . $_POST['email'] . "\n" . 'Subject: ' . $_POST['subject'] . "\n" . 'Message: ' . $_POST['message'];

    if ($mail->send()) {
        echo json_encode(["status" => "success", "message" => "Message sent! Thanks for contacting us."]);
        
        // $msg = 'Sorry, something went wrong. Please try again later.';
    } else {
        echo json_encode(["status" => "error", "message" => "Sorry, something went wrong. Please try again later."]);
        // $msg = 'Message sent! Thanks for contacting us.';
    }

    // echo($msg);

    } catch (Exception $e) {
    //WRITE THIS TO A SERVER LOG FILE - DONT ECHO IT TO THE USER, FOR SECURITY!!!
     // Log the error and return a generic error message to the user
     error_log($e->getMessage());
     echo json_encode(["status" => "error", "message" => "Sorry, something went wrong. Please try again later."]);
    }
?>