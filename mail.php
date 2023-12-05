<?php
$to = "iamsadiq98@gmail@gmail.com";
$subject = "Test Email";
$message = "This is a test email.";

// Additional headers
$headers = "From: solomonjulius96@gmail.com" . "\r\n" .
    "Reply-To: iamsadiq98@gmail.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

// Send the email
$mailSuccess = mail($to, $subject, $message, $headers);

// Check if the email was sent successfully
if ($mailSuccess) {
    echo "Email sent successfully.";
} else {
    echo "Error sending email.";
}
?>
