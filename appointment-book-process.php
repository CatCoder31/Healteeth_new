<?php
session_start();
include 'config.php';

require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/Exception.php");
require("PHPMailer/src/SMTP.php");

// Check if the user is logged in, if not then redirect him to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

date_default_timezone_set('Asia/Manila');
$date_today = date('Y-m-d');
$full_name = $_SESSION['full_name'];
$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
   $patient_name = $_POST['patient_name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   $address = $_POST['address'];
   $categorypick = $_POST['categorypick'];
   $servicepick = $_POST['servicepick'];
   $doctor_id = $_POST['doctorId'];
   $schedule = $_POST['schedule'];

    $query = "SELECT *
            FROM schedule 
            WHERE date_sched = CURRENT_DATE AND doctor_id = '$doctor_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $date_sched = $row['date_sched'];
    $time_sched_start = strtotime($row['time_sched_start']);
    $time_sched_end = strtotime($row['time_sched_end']);
    $breaktime_start = strtotime($row['breaktime_start']);
    $breaktime_end = strtotime($row['breaktime_end']);

       // Get service duration
       $query = "SELECT * FROM services WHERE service_id = ?";
       $stmt = mysqli_prepare($con, $query);
       mysqli_stmt_bind_param($stmt, "s", $servicepick);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);

       if (mysqli_num_rows($result) > 0) {
           $row = mysqli_fetch_assoc($result);
           $service_duration = $row['service_duration'];
        // Get service duration
        $query = "SELECT * FROM services WHERE service_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $servicepick);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $service_duration = $row['service_duration'];

           // Get the last appointment time for the selected schedule
           $query = "SELECT * FROM appointments WHERE appointment_date = ? AND doctor_id = ? AND status = 'Approved' ORDER BY time_finish DESC LIMIT 1";
           $stmt = mysqli_prepare($con, $query);
           mysqli_stmt_bind_param($stmt, "ss", $date_sched, $doctor_id);
           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);
            // Get the last appointment time for the selected schedule
            $query = "SELECT * FROM appointments WHERE appointment_date = ? AND doctor_id = ? AND status = 'Approved' ORDER BY time_finish DESC LIMIT 1";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ss", $date_sched, $doctor_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

                   if (mysqli_num_rows($result) > 0) {
                       $row = mysqli_fetch_assoc($result);
                       $last_appointment_time = strtotime($row['time_finish']);
                   } else {
                       // If there are no existing appointments, set the start time to the opening time
                       $last_appointment_time = $time_sched_start;
                   }

           // Calculate the start and end time of the new appointment
           $start_time = max($last_appointment_time, $time_sched_start);
           $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
           $end_time = $start_time + $service_duration_seconds;

           // Check if $end_time exceeds $breaktime_start
           if ($end_time > $breaktime_start) {
               // Calculate the start and end time of the new appointment
               $start_time = max($last_appointment_time, $breaktime_end);
               $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
               $end_time = $start_time + $service_duration_seconds;
           }

           // Check if $end_time exceeds $time_sched_end
           if ($end_time > $time_sched_end) {
               // Reject the appointment
               $response = [
                   'success' => false,
                   'message' => 'The appointment cannot be scheduled as it exceeds the closing time.'
               ];

               // Redirect to appointment-book.php with the response as a query parameter
               header("Location: appointment-book.php?response=" . urlencode(json_encode($response)));
               exit();
           }

           // Insert the new appointment into the database
           $query = "INSERT INTO appointments (doctor_id, patient_id, patient_name, email, phone, address, category, service, appointment_date, appointment_time, time_finish, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Approved')";
           
           $stmt = mysqli_prepare($con, $query);
           mysqli_stmt_bind_param($stmt, "sssssssssss", $doctor_id, $id, $patient_name, $email, $phone, $address, $categorypick, $servicepick, $date_sched, date('H:i:s', $start_time), date('H:i:s', $end_time));
           mysqli_stmt_execute($stmt);

           $appointment_date = date('F j, Y', strtotime($date_sched));
           $appointment_start_time = date('h:i A', $start_time);
           $appointment_end_time = date('h:i A', $end_time);

           $response = [
               'success' => true,
               'message' => 'Appointment booked successfully!',
               'appointment_date' => $appointment_date,
               'start_time' => $appointment_start_time,
               'end_time' => $appointment_end_time
           ];
           
           // Prepare and send the email
           $mail = new PHPMailer\PHPMailer\PHPMailer();
           
           // Set up SMTP configuration
           $mail->isSMTP();
           $mail->Host = 'smtp.gmail.com';
           $mail->SMTPDebug = 0;
           $mail->Port = 587;
           $mail->SMTPSecure = 'tls';
           $mail->SMTPAuth = true;
           $mail->Username = 'healteethph@gmail.com';
           $mail->Password = 'lektzbyfwtljbqpd';

           // Set up sender and recipient
           $mail->setFrom('healteethph@gmail.com', 'Official Healteeth');
           $mail->addAddress($email, $patient_name);

           // Attach the logo image as CID
           $logoPath = 'assets/image/Healteeth Logo.png';
           $cid = $mail->addEmbeddedImage($logoPath, 'logo', 'logo.png');

           // Set email content
           $mail->Subject = 'Appointment';
           $mail->isHTML(true); // Set email content type
           
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
               <h3>Scheduled Appointment</h3>
               </div>
               <div class="content">
               <h2>Dear '.$patient_name.',</h2>
               <p>Thank you for booking an appointment with us. We would like to confirm that your appointment has been successfully scheduled.
                   <br>
                   If you have any questions or need to make any changes, please feel free to contact us.
                   <br>We look forward to meeting you on '.$date_sched.'.</p>
               <br>
               <p>Thank you,</p>
               <p>'.$patient_name.'</p>
               </div>
                   <p style="text-align: center;">&copy; '.date("Y").' Healteeth PH. All rights reserved.</p>
               </body>
               </html>';

           // Check if the email was sent successfully
           if ($mail->send()) {
               // Redirect to appointment-book.php with the response as a query parameter
               header("location: appointment-book.php?response=" . urlencode(json_encode($response)));
               exit();
           } else { 
               echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
           }
           // Redirect to appointment-book.php with the response as a query parameter
           header("Location: appointment-book.php?response=" . urlencode(json_encode($response)));
           exit();
       }
   }
            // Calculate the start and end time of the new appointment
            $start_time = max($last_appointment_time, $time_sched_start);
            $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
            $end_time = $start_time + $service_duration_seconds;

            // Check if $end_time exceeds $breaktime_start
            if ($end_time > $breaktime_start) {
                // Calculate the start and end time of the new appointment
                $start_time = max($last_appointment_time, $breaktime_end);
                $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
                $end_time = $start_time + $service_duration_seconds;
            }

            // Check if $end_time exceeds $time_sched_end
            if ($end_time > $time_sched_end) {
                // Reject the appointment
                $response = [
                    'success' => false,
                    'message' => 'The appointment cannot be scheduled as it exceeds the closing time.'
                ];

                // Redirect to appointment-book.php with the response as a query parameter
                header("Location: appointment-book.php?response=" . urlencode(json_encode($response)));
                exit();
            }

            // Insert the new appointment into the database
            $query = "INSERT INTO appointments (doctor_id, patient_id, patient_name, email, phone, address, category, service, appointment_date, appointment_time, time_finish, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Approved')";
            
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssss", $doctor_id, $id, $patient_name, $email, $phone, $address, $categorypick, $servicepick, $date_sched, date('H:i:s', $start_time), date('H:i:s', $end_time));
            mysqli_stmt_execute($stmt);

            $appointment_date = date('F j, Y', strtotime($date_sched));
            $appointment_start_time = date('h:i A', $start_time);
            $appointment_end_time = date('h:i A', $end_time);

            $response = [
                'success' => true,
                'message' => 'Appointment booked successfully!',
                'appointment_date' => $appointment_date,
                'start_time' => $appointment_start_time,
                'end_time' => $appointment_end_time
            ];

            // Redirect to appointment-book.php with the response as a query parameter
            header("Location: appointment-book.php?response=" . urlencode(json_encode($response)));
            exit();
        }
    

?>
