<?php

/**
 * This example shows how to handle a simple contact form safely.
 */


//Import PHPMailer class into the global namespace

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


try {

require '../vendor/PHPMailer-master/src/Exception.php';
require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';


echo('1');
        // // Logger ##########################################################################
        // $file = '/Applications/XAMPP/xamppfiles/htdocs/Logging.rtf';
        // // Set the timezone to your local timezone
        // date_default_timezone_set('Europe/London');
        // $data = 'yo all';
        // $handle = fopen($file, 'a+');
        // fwrite($handle, $data);
        // fclose($handle);
        // // Logger ##########################################################################
    
        // echo "Mailer Error: {$mail->ErrorInfo}";
        // echo "Mailer Error: {$e}";

$msg = '';
//Don't run this unless we're handling a form submission

echo('2');
$mail = new PHPMailer();

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'hello@maggiegray.co.uk';                     //SMTP username
$mail->Password   = 'Mal1c3L0v35Banana5!';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 


echo('3');
    //Send using SMTP to localhost (faster and safer than using mail()) – requires a local mail server
    //See other examples for how to use a remote server such as gmail
    // $mail->isSMTP();
    // $mail->Host = 'smtp.hostinger.com';
    // $mail->Port = 465;

    //Use a fixed address in your own domain as the from address
//     //**DO NOT** use the submitter's address here as it will be forgery
//     //and will cause your messages to fail SPF checks
    $mail->setFrom('from@maggiegray.co.uk', 'First Last');
//     //Choose who the message should be sent to
//     //You don't have to use a <select> like in this example, you can simply use a fixed address
//     //the important thing is *not* to trust an email address submitted from the form directly,
//     //as an attacker can substitute their own and try to use your form to send spam
    $addresses = [
        'hello' => 'hello@maggiegray.co.uk'
    ];
//     //Validate address selection before trying to use it
        $mail->addAddress('hello@maggiegray.co.uk');
//     //Put the submitter's address in a reply-to header
//     //This will fail if the address provided is invalid,
//     //in which case we should ignore the whole request
        // $mail->Subject('RAW PHPMailer test without form');
         $mail->Body = "I am a body - worked, we broke, now fixing3";

// <<<EOT
// // Email: {$_POST['email']}
// // Name: {$_POST['name']}
// // Subject: {$_POST['subject']}
// // Message: {$_POST['message']}
// // EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
        //     //The reason for failing to send will be in $mail->ErrorInfo
        //     //but it's unsafe to display errors directly to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }

//     echo('fdsfdtdrtdrtdrtydfdfyfydrry');

// // } catch (Exception $e) {

    // Logger ##########################################################################
    // $file = '/Applications/XAMPP/xamppfiles/htdocs/Logging.rtf';
    // // Set the timezone to your local timezone
    // date_default_timezone_set('Europe/London');
    // $data = $e;
    // $handle = fopen($file, 'a+');
    // fwrite($handle, $data);
    // fclose($handle);
    // // Logger ##########################################################################

} catch (Exception $e) {
    echo $mail->ErrorInfo;
}

?>