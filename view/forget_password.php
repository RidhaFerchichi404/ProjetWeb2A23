<?

private function sendForgetPasswordEmail($email, $token)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    $log = new Logger('sendnotif');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/sendnotif.log', Logger::INFO));
    $log->info('FORGET PASSWORD MAIL FUNCTION INIT', ['email' => $email]);

    // Set up SMTP for Gmail
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'sana.lar0015@gmail.com'; // Your Gmail address
    $mail->Password = 'tisv rtgh idpq cdmt'; // Your Gmail password

    // Set up email content
    $mail->setFrom('sana.lar0015@gmail.com', 'Sana'); // Sender's email address and name
    $mail->addAddress($email); // Recipient's email address
    $mail->Subject = 'Reset Your Password'; // Email subject
    $mail->Body = 'To reset your password, click the following link: <a href="http://yourwebsite.com/reset_password.php?email=' . urlencode($email) . '&token=' . urlencode($token) . '">Reset Password</a>'; // Email body

    $log->info('FORGET PASSWORD MAIL ITSELF', ['mail' => $mail]);

    try {
        $log->info('SENDING FORGET PASSWORD MAIL');
        $mail->send();
        $log->info('FORGET PASSWORD MAIL SENT');
    } catch(Exception $e) {
        $log->error('FORGET PASSWORD MAIL NOT SENT:', ['error' => $e->getMessage()]);
    }
}
