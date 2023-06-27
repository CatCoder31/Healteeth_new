<?php 
   
   session_start();
   include 'config.php';


   //UPDATE DENTIST SCHEDULE
   if(isset($_POST['add_sched'])){
     $id = $_POST['id'];
     $time_sched = $_POST['time_sched'];
     $date_sched = $_POST['date_sched'];

     $check = mysqli_query($con, "SELECT * FROM schedule WHERE doctor_Id='$id' AND time_sched='$time_sched' AND date_sched='$date_sched' AND sched_Id='$id'");
     if(mysqli_num_rows($check) > 0) {
      $_SESSION['update'] = 'This schedule is already added with the same doctor';
      header('Location: schedule.php');
     } else {

         $save = mysqli_query($con, "UPDATE schedule SET time_sched='$time_sched', date_sched='$date_sched' WHERE sched_Id='$id'");
         if($save) {
            $_SESSION['update'] = 'Schedule has been updated successfully.';
            header('Location: schedule.php');
         } else {
            $_SESSION['update'] = 'Something went wrong while updating the schedule.';
            header('Location: schedule.php');
         }
     }
   }

?>

