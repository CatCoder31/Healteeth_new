<?php 

   include 'config.php';
   date_default_timezone_set('Asia/Manila');
   $date_today = date('Y-m-d');

   if (isset($_POST['doctor_Id'])) {
      $doctorId = $_POST['doctor_Id'];
      $query = mysqli_query($con, "SELECT * FROM schedule s JOIN user u ON s.doctor_Id=u.id WHERE role='Doctor' AND date_sched >= CURRENT_DATE AND id = $doctorId");       
      if (mysqli_num_rows($query) > 0 ) {
         echo '<option value="" selected disabled>Select from below</option>'; //can be deleted
         while ($row = $query->fetch_assoc()) {
            echo '<option value= "Schedule 1">  Schedule 1 Date: '.date("F d, Y", strtotime($row['date_sched'])).'('.date('h:i A',strtotime($row['time_sched_start'])).' - '.date('h:i A',strtotime($row['time_sched_end'])).')  </option>';
          //  echo '<option value= "Schedule 2">  Schedule 2 Date: '.date("F d, Y", strtotime($row['date_sched'])).'('.date('h:i A',strtotime($row['time_sched_start'])).' - '.date('h:i A',strtotime($row['time_sched_end'])).')  </option>';
         }  
      } else {
         echo '<option selected disabled>No schedule found</option>';
       }
   }

?>