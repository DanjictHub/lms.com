<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);



try {
    // SMTP configuration
   $mail->isSMTP();
   $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
   $mail->SMTPAuth   = true;
   $mail->Username   = 'solomonjulius96@gmail.com'; // Replace with your email address
   $mail->Password   = 'gfgulxxuonhqzbjj';  // Replace with your email password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SSL;
   //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
   $mail->Port       = 587;//SSL 465 or TLS 587


    // Enable debug mode
   //$mail->SMTPDebug = 2; // 2 for detailed debug output
//$mail->Debugoutput = function ($str, $level) {
    //echo "[$level] $str";
//};


    // Email content
    $mail->setFrom('solomonjulius96@gmail.com', 'Julius'); // Replace with your name
    $mail->addAddress('solomonjulius96@gmail.com', 'Dear Sadiq'); // Replace with recipient's email and name
    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent using PHPMailer.';

    // Send email
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Failed to send email. Error: {$e->getMessage()}";
}
?>
