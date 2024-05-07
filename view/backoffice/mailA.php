<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Exception.php';
require '../PHPMailer.php';
require '../SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] === "accept") {

    // Check if enterprise ID and email are set
    if (!isset($_POST["id"], $_POST["email"])) {
        echo "Enterprise ID or email is missing.";
        exit;
    }

    $enterpriseId = $_POST['id'];
    $enterpriseEmail = $_POST['email'];

    // Send email notification
    try {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hadiji.marwen@esprit.tn';                // SMTP username
        $mail->Password   = 'wbvk gjpn bqpp zxvu';                  // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('hadiji.marwen@esprit.tn', 'CAREERHUB');  // Sender's email address and name
        $mail->addAddress($enterpriseEmail);                        // Recipient's email address

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Notification: Your enterprise has been accepted'; // Email subject
        $mail->Body    = 'Dear Enterprise, your application has been accepted.'; // Email body

        // Send email
        $mail->send();

        echo "Email notification sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send email notification. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
