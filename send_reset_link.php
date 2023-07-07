<?php
// send_reset_link.php

// Include the PHPMailer library
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/Exception.php");
require("PHPMailer/src/SMTP.php");

// Retrieve the email from the form submission
$email = $_POST['email'];



   // Generate a random token
    $token = bin2hex(random_bytes(32));

    // Database connection parameters
    $servername = 'localhost';
    $username = 'root';
    $password = ''; // Replace with your database password
    $dbname = 'healteeth';

    // Create a new MySQLi instance
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to update the token in the user table
    $stmt = $conn->prepare('UPDATE user SET token = ? WHERE email_address = ?');
    $stmt->bind_param('ss', $token, $email);
    $stmt->execute();

// Create the reset link with the token=email because no token field in user update the $resetlink url when deployed will only work right now in local server
$resetLink = "http://localhost/Healteeth/reset_password.php?token=$token";

// Compose the email
$subject = 'Password Reset';
$message = <<<HTML
<!DOCTYPE html>
<html>
         <head>
      
            <style>
               /* Reset CSS */
               body, h1, h2, h3, h4, h5, h6, p, ul, ol, li {
                  margin: 0;
                  padding: 0;
               }
               body {
                 font-family: 'Montserrat';
                  background-color: #f1f1f1;
               }
               /* Container */
               .container {
                  max-width: 600px;
                  margin: 0 auto;
                  border: 1px solid #dddddd;
                  border-radius: 6px;
               }
               /* Header */
               .header {
                 border-bottom: thin solid #dadce0;
                  padding: 30px;
                  text-align: center;
                  margin-left: 10%;
                  margin-right: 10%;
               }
               .header img {
                  max-width: 150px;
                  margin-bottom: 20px;
               }
               /* Content */
               .content {
                  padding: 30px;
                  color: #333333;
                  line-height: 1.5;
               }
               .content h2 {
                  font-size: 24px;
                  margin-bottom: 20px;
               }
               .content p {
                  font-size: 16px;
                  margin-bottom: 10px;
               }
               /* Footer */
               .footer {
                  background-color: #f1f1f1;
                  padding: 30px;
                  text-align: center;
               }
               .footer p {
                  font-size: 14px;
                  margin-bottom: 10px;
               }

              .button {
                  display: inline-block;
                  background-color: #007bff;
                  color: #fff !important;
                  padding: 10px 20px;
                  border-radius: 4px;
                  text-decoration: none;
                  font-weight: bold;
                  font-size: 16px;
                }

                .button:hover {
                  background-color: #0056b3;
                }
                p{
                  font-family: 'Montserrat';
                }
            </style>
                 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
         </head>
         <body>
            <div class="container">
               <div class="header">
                  <h3>Reset your Healteeth Account password</h3>
               </div>
               <div class="content">
                  <h2>Healteeth password reset</h2>
                  <p>
                  We heard that you lost your Healteeth password. Sorry about that!

                  But don’t worry! You can use the following button to reset your password:</p>
                  <br>
                  <p><a href="$resetLink" class="button">Reset Password</a></p>
                  <br>
                   <p>If you did not request a password reset, please ignore this email.</p>
               </div>
               
            </div>
             <p style="text-align: center;">&copy; 2023 Healteeth PH. All rights reserved.</p>

         </body>
         </html>
HTML;

// Instantiate PHPMailer
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


// Set the email sender and recipient
$mail->setFrom('your_email@example.com', 'Official Healteeth'); // Replace with your actual name and email address
$mail->addAddress($email);

// Set email content
$mail->Subject = $subject;
$mail->Body = $message;
$mail->isHTML(true);

// Send the email
$mailSent = $mail->send();

// Check if the email was sent successfully
if ($mailSent) {
  // Display a success message to the user
  echo "An email with instructions to reset your password has been sent to your email address.";
} else {
  // Display an error message to the user
  echo "Failed to send the reset email. Please try again later.";
}
?>
