<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Load PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');

$mail = new PHPMailer(true);

$response = [];

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'farhanuddinjibon@gmail.com'; // Your Gmail address
    $mail->Password   = 'rmlj wfsz tgml yfza';    // App password, not Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('farhanuddinjibon@gmail.com', 'Farhan'); // Your email

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = nl2br($_POST['message']);

    $mail->send();
    $response = ['status' => 'success', 'message' => 'Message has been sent successfully!'];
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => "Message could not be sent. Error: {$mail->ErrorInfo}"];
}

echo json_encode($response);
