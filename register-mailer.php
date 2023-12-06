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
      $mail->Subject = 'Thank You for Joining Healteeth!';

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
                  <h3>Thank you for signing up!</h3>
               </div>
               <div class="content">
                  <h2>Dear '.$name.',</h2>
                  <p>We hope this email finds you in good health and high spirits. On behalf of the entire Healteeth team, I would like to extend our heartfelt gratitude for signing up on our dental clinic website. We are thrilled to have you as a member of our growing community!

                  At Healteeth, we understand that your oral health is essential to your overall well-being. Our mission is to provide exceptional dental care and support to each and every one of our patients. By joining our platform, you have taken an important step towards maintaining a healthy and beautiful smile.

                   <br>
                   We are committed to delivering a seamless and rewarding experience for all our patients. If you have any questions, concerns, or feedback, please don\'t hesitate to reach out to us. Our friendly support team is here to assist you every step of the way.

                   Once again, thank you for choosing Healteeth as your trusted dental partner. We look forward to providing you with exceptional care and helping you achieve your oral health goals.</p>
                  <br>
                  <p>Warm regards,</p>
                  <p>Healteeth Dental Clinic</p>
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