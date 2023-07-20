<?php
// Include config file
require_once "config.php";

// Include PHPMailer
  require("PHPMailer/src/PHPMailer.php");
  require("PHPMailer/src/Exception.php");
  require("PHPMailer/src/SMTP.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Get email, name, and token from the POST data
$email = $_POST['email'];
$name = $_POST['name'];
$verificationToken = $_POST['token'];

// Set up PHPMailer
$mail = new PHPMailer(true);

try {
    // Set up SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPDebug = 2; // Set to 0 to disable debugging output
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'healteethph@gmail.com'; // Replace with your email address
    $mail->Password = 'lektzbyfwtljbqpd'; // Replace with your email password

    // Set up sender and recipient
    $mail->setFrom('healteethph@gmail.com', 'Your Name'); // Replace with your name and email address
    $mail->addAddress($email, $name); // Set recipient's email and name

    // Set email content
    $mail->Subject = 'Email Verification';
    $mail->isHTML(true);
    $mail->Body = 'Click the following link to verify your email: <a href="https://example.com/verify.php?token=' . $verificationToken . '">Verify Email</a>';

    // Send email
    $mail->send();

    // Prepare the response
    $response = [
        'success' => true,
        'message' => 'Verification email sent successfully.'
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to send verification email. Error: ' . $mail->ErrorInfo
    ];
}

// Send the response back in JSON format
header('Content-Type: application/json');
echo json_encode($response);
?>
