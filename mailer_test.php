
<?php

  require("PHPMailer/src/PHPMailer.php");
  require("PHPMailer/src/Exception.php");
  require("PHPMailer/src/SMTP.php");



$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set up SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPDebug = 2;
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'healteethph@gmail.com';
$mail->Password = 'lektzbyfwtljbqpd';

// Set up sender and recipient
$mail->setFrom('healteethph@gmail.com', 'Your Name');
$mail->addAddress('jbareta2@gmail.com', 'Recipient Name');

// Set email content
$mail->Subject = 'Example Mailer PHP Script';
$mail->Body = 'This is a test email sent from the PHP mailer script.';

// Check if the email was sent successfully
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}
 
?>