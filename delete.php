<?php
   session_start();
   include 'config.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }

   date_default_timezone_set('Asia/Manila');
   $date_today = date('Y-m-d');


   $full_name = $_SESSION['full_name'];
   $id = $_SESSION['id'];
   
   if(isset($_POST['submit'])){
      $patient_name     = $_POST['patient_name'];
      $email            = $_POST['email'];
      $phone            = $_POST['phone'];
      $address          = $_POST['address'];
      $categorypick     = $_POST['categorypick'];
      $servicepick      = $_POST['servicepick'];
      $appointment_date = $_POST['appointment_date'];
      $appointment_time = $_POST['appointment_time'];
      $doctorId         = $_POST['doctorId'];
      $docSchedule      = $_POST['docSchedule'];

      $sql       = mysqli_query($con, "SELECT * FROM services WHERE service_id = $servicepick;");
      $row       = mysqli_fetch_array($sql);
      $duration  = $row['service_duration'];
      $sduration = strtotime($row['service_duration']);
      $dduration = date("h:i A", $sduration);
      

      $sfinish = strtotime($appointment_time) + (strtotime($duration) - strtotime('00:00:00'));
      $finish  = date("H:i", $sfinish);
      $dfinish = date("h:i A", $sfinish);


      // GET APPT COUNT
      $fetch      = mysqli_query($con, "SELECT * FROM apptcounting WHERE doctor_Id='$doctorId' AND sched_Id='$docSchedule'");
      $row2        = mysqli_fetch_array($fetch);
      $appt_Count = $row2['appt_Count'];
      $count = $appt_Count + 1;

      $insert_data = mysqli_query($con, "INSERT INTO appointments (patient_id, patient_name, email, phone, address, category, service, schedule_Id,appointment_date, appointment_time, time_finish) VALUES ('$id', '$patient_name', '$email', '$phone', '$address', '$categorypick', '$servicepick', '$docSchedule', '$appointment_date', '$appointment_time', '$finish')");

      if($insert_data){
         $update = mysqli_query($con, "UPDATE apptcounting SET appt_Count='$count' WHERE doctor_Id='$doctorId' AND sched_Id='$docSchedule'");
         if($update) {
            echo "Thank you for booking an appointment with Healteeth, please wait for the approval of your appointment";
         } else {
            echo "hgfhgfh";
         }
      }else{
         echo "fdgdfgd";
      }
   
   }
   
   ?>