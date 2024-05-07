<?php
// forget password 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Replace these placeholders with your actual email settings
    $to = "your-email@example.com";
    $subject = "Password Reset Request";
    $message = "Someone has requested a password reset. If this was not you, please ignore this message.";
    $headers = "From: your-email@example.com";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
    }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-gmail-account@gmail.com'; // Your Gmail email address
    $mail->Password = 'your-gmail-password'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('your-gmail-account@gmail.com', 'Your Name'); // Sender's email address and name
    $mail->addAddress('recipient@example.com', 'Recipient Name'); // Recipient's email address and name
    $mail->Subject = 'Password Reset Request';
    $mail->Body = 'Someone has requested a password reset. If this was not you, please ignore this message.';

    // Send email
    $mail->send();
    echo 'Email sent successfully.';
} catch (Exception $e) {
    echo "Email sending failed. Error: {$mail->ErrorInfo}";
}
?>



