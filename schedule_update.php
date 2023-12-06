<?php
   // Initialize the session
   session_start();
   
   date_default_timezone_set('Asia/Manila');
   $date_today = date('Y-m-d');

   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
   // database connection
   include('config.php');
   
   
   // GET THE ID OF THE SCHEDULE FROM SCHEDULE.PHP UPDATE BUTTON
   if(isset($_GET['sched_Id']))
   $sched_Id = $_GET['sched_Id'];
   $get = mysqli_query($con, "SELECT * FROM schedule JOIN user ON schedule.doctor_Id=user.id WHERE schedule.sched_Id='$sched_Id'");
   $g = mysqli_fetch_array($get);

   $added = false;
   //UPDATE DENTIST SCHEDULE
   if(isset($_POST['add_sched'])){
     $id = $_POST['id'];
     $date_sched       = $_POST['date_sched'];
     $time_sched_start = $_POST['time_sched_start'];
     $time_sched_end   = $_POST['time_sched_end'];
     $breaktime_start  = $_POST['breaktime_start'];
     $breaktime_end    = $_POST['breaktime_end'];

     $check = mysqli_query($con, "SELECT * FROM schedule WHERE time_sched_start='$time_sched_start' AND time_sched_end='$time_sched_end' AND date_sched='$date_sched' AND doctor_Id='$id'");
     if(mysqli_num_rows($check) > 0) {
      echo "<script>alert('This schedule is already added with the same doctor.'); window.history.go(-1); </script>";
      // $_SESSION['update'] = 'This schedule is already added with the same doctor';
      // header('Location: schedule.php');
     } else {

          if($time_sched_start >= $time_sched_end) {
            echo "<script>alert('Time sched start must be earlier than end Time sched end.'); window.history.go(-1); </script>";
          } else {
            if($breaktime_start >= $breaktime_end) {
              echo "<script>alert('Break time start must be earlier than end Break time end.'); window.history.go(-1); </script>";
            } else {
              if($date_sched < $date_today) {
                  echo "<script>alert('Date schedule must be later than today or equal to date today.'); window.history.go(-1); </script>";
                  // $added = true;
                  // $added = 'Schedule has been updated successfully.';
               } else {
                  $save = mysqli_query($con, "UPDATE schedule SET date_sched='$date_sched', time_sched_start='$time_sched_start', time_sched_end='$time_sched_end', breaktime_start='$breaktime_start', breaktime_end='$breaktime_end' WHERE sched_Id='$id'");
                  if($save) {

                     // UPDATE APPOINTMENT COUNTING - APPTCOUNTING TABLE
                     // $update = mysqli_query($con, "UPDATE apptcounting SET date_sched='$date_sched' WHERE sched_Id='$id'");
                     // if($update) {
                        // $_SESSION['update'] = 'Schedule has been updated successfully.';
                        // header('Location: schedule.php');
                        echo "<script>alert('Schedule has been updated successfully.'); window.history.go(-1); </script>";
                        // $added = true;
                        // $added = 'Schedule has been updated successfully.';
                        
                     // } else {
                        // $_SESSION['update'] = 'Something went wrong while updating the schedule.';
                        // header('Location: schedule.php');
                        echo "<script>alert('Something went wrong while updating the schedule.'); window.history.go(-1);</script>";
                        // $added = true;
                        // $added = 'Something went wrong while updating the schedule.';
                        // echo "<script>window.history.go(-1);</script>";
                     // }
                     
                  } else {
                     // $_SESSION['update'] = 'Something went wrong while updating the schedule.';
                     // header('Location: schedule.php');
                     echo "<script>alert('Something went wrong while updating the schedule.'); window.history.go(-1);</script>";
                     $added = true;
                     $added = 'Something went wrong while updating the schedule.';
                     // echo "<script>window.history.go(-1);</script>";
                  }
               }
            }
          }

         

         
     }
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Doctor </title>
    
    <!-- Custom CSS -->
     <style type="text/css">
      .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  } 

  .card-counter.secondary{
    background-color: #336369;
    color: #FFF;
  }

  .card-counter.yellow{
    background-color: #76a5af;
    color: #FFF;
  }    

  .card-counter.light{
    background-color: #e69138;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }

 
  /* bootstrap hack: fix content width inside hidden tabs */
.tab-content > .tab-pane:not(.active),
.pill-content > .pill-pane:not(.active) {
    display: block;
    height: 0;
    overflow-y: hidden;
} 
/* bootstrap hack end */
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet"/>
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet"/>
    <!--c3 CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard.css" rel="stylesheet" />
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet" />
    
  </head>

  <body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">LOADING...</p>
      </div>
    </div>     
      <?php
        include 'includes/topheader.php';
        include 'includes/sidebar_doctor.php';
      ?>
       
    <div class="page-wrapper">
      <div class="container-fluid">
          <div class="container">
            <div class="card">
         <div class="card-body">
            <form  method="POST" enctype="multipart/form-data">
               <div>
                  <!-- adding alert notification  -->
                  <?php
                     if($added){
                       echo "
                         <div class='btn-success' style='padding: 15px; text-align:center;'>
                           ".$added."
                         </div><br>
                       ";
                     }
                     
                     ?>
               </div>
               <div class="row">
                  <div class="col-12">
                     <h2><b>Schedule settings</b></h2>
                     <hr>
                  </div>

                  <!-- ID OF THE LOGGED IN DOCTOR -->
                  <input type="hidden" class="form-control" name="id" value="<?php echo $sched_Id; ?>">
                  
                  <div class="col-12">
                     <h2><b>Operating time:</b></h2>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="password">Date Settings</label>
                     <input type="date" class="form-control" name="date_sched" required value="<?php echo $g['date_sched']; ?>">
                  </div>
                  <div class="form-group col-md-6"></div>
                  
                  <div class="form-group col-md-6">
                     <label for="email_address">Time Start</label>
                     <input type="time" class="form-control" name="time_sched_start" required value="<?php echo $g['time_sched_start']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email_address">Time End</label>
                     <input type="time" class="form-control" name="time_sched_end" required value="<?php echo $g['time_sched_end']; ?>">
                  </div>

                  <div class="col-12">
                     <h2><b>Breaktime:</b></h2>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email_address">Breaktime Start</label>
                     <input type="time" class="form-control" name="breaktime_start" required value="<?php echo $g['breaktime_start']; ?>">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email_address">Breaktime End</label>
                     <input type="time" class="form-control" name="breaktime_end" required value="<?php echo $g['breaktime_end']; ?>">
                  </div>
                  
               </div>
               
               <div class="form-group col-md-12 d-flex justify-content-end">
                  <input type="submit" name="add_sched" class="btn btn-info float-right" value="Submit">         
               </div>
            </form>
         </div>
      </div>
          </div>
      </div>
    </div>

   


    
     <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard.js"></script>
    <script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});
</script>
<script>
   $(document).ready(function () {
     $('#myTable').DataTable();
   
   });

     $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,6000);
  }
  );



      $(document).ready(function() {
        // SIBLINGS TABLE - SIBLINGS.PHP
        var html = '<tr><td><input type="time" class="form-control" name="time_sched_start[]" ></td><td><input type="time" class="form-control" name="time_sched_end[]" ></td><td><button class="btn btn-danger" id="remove">Remove row</button></td></tr>';
        var x = 1;

        $("#add").click (function() {
            $("#table_field").append(html);
        });
        $("#table_field").on('click', '#remove', function(){
            $(this).closest('tr').remove();
        });
});
</script>
  </body>
</html>
