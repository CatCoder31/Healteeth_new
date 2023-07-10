<?php
   // Mailer Dir
   require("PHPMailer/src/PHPMailer.php");
   require("PHPMailer/src/Exception.php");
   require("PHPMailer/src/SMTP.php");

   // Check if form is submitted
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $mail = new PHPMailer\PHPMailer\PHPMailer();

      // Input details
      $name = $_POST["name"];
      $email = $_POST["email"];
      $subject = $_POST["subject"];
      $message = $_POST["message"];
      $fileName = $_POST["current_page"]; // Retrieve the file name from the hidden input field

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
      $mail->setFrom('healteethph@gmail.com', 'Official Healteeth');
      $mail->addAddress($email, $name);

      // Attach the logo image as CID
      $logoPath = 'assets/image/Healteeth Logo.png';
      $cid = $mail->addEmbeddedImage($logoPath, 'logo', 'logo.png');

      // Set email content
      $mail->Subject = 'Thank you for Contacting us!';

      // Email body with CSS design
      $mail->Body = '
         <html>
         <head>
            <style>
               /* Reset CSS */
               body, h1, h2, h3, h4, h5, h6, p, ul, ol, li {
                  margin: 0;
                  padding: 0;
               }
               body {
                  font-family: Arial, sans-serif;
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
            </style>
         </head>
         <body>
            <div class="container">
               <div class="header">
                  <img src="cid:logo" alt="Healteeth PH Logo">
                  <br>
                  <h3>We have received your feedback!</h3>
               </div>
               <div class="content">
                  <h2>Dear '.$name.',</h2>
                  <p>Thank you for contacting us through our website. We appreciate your inquiry and value your interest in Healteeth.

                    We have received your message and will address your concerns promptly. Our team is dedicated to providing excellent customer service, and we will strive to assist you effectively.

                   <br>
                    If you have any further questions or require immediate assistance, please do not hesitate to reach out to us. We are here to help.

                    Thank you once again for contacting Healteeth. We appreciate your support.</p>
                  <br>
                  <p>Thank you,</p>
                  <p>Healteeth Philippines</p>
               </div>
               
            </div>
             <p style="text-align: center;">&copy; '.date("Y").' Healteeth PH. All rights reserved.</p>
         </body>
         </html>';

      // Set email content type
      $mail->isHTML(true);

      // Check if the email was sent successfully
      if ($mail->send()) {
         header("Location: $fileName"); // Redirect to the file name from the form
         exit; // Stop further execution of the script
      } else {
         echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
      }
   }
?>
