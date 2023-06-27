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
   
   $added = false;
   $failed = false;
   
   
   //ADD DENTIST SCHEDULE
   
   if(isset($_POST['add_sched'])){
     $id = $_POST['id'];
     $date_sched       = $_POST['date_sched'];
     $time_sched_start = $_POST['time_sched_start'];
     $time_sched_end   = $_POST['time_sched_end'];
     $breaktime_start  = $_POST['breaktime_start'];
     $breaktime_end    = $_POST['breaktime_end'];


         $select_query = mysqli_query($con, "SELECT COUNT(*) AS total_rows FROM schedule WHERE doctor_Id='$id' AND date_sched = '$date_sched'");
         if($select_query && mysqli_num_rows($select_query) > 0) {
           $row = mysqli_fetch_assoc($select_query);
           $total_rows = $row['total_rows'];

            if ($total_rows < 7) {
                // Continue with the insertion of new records
                $num_rows = count($time_sched_start);
                if (($total_rows + $num_rows) <= 7) {

                  
                    // Check if the number of start times and end times is the same
                    if(count($time_sched_start) === count($time_sched_end)) {
                      $valid = true;
                      $num_rows = count($time_sched_start);

                      // Compare the start and end times element-wise
                      for($i = 0; $i < $num_rows; $i++) {
                        $start_time = strtotime($time_sched_start[$i]);
                        $end_time = strtotime($time_sched_end[$i]);

                        if($start_time >= $end_time) {
                          $valid = false;
                          break;
                        }
                      }

                      if($valid) {
                        // Save the data to the database
                        if($date_sched < $date_today) {
                          $failed = true;
                          $failed = 'Date schedule must be later than today or equal to date today.';
                        } else {

                            if($breaktime_start >= $breaktime_end) {
                               $failed = true;
                               $failed = 'Breaktime start should be earlier than breaktime end.';
                            } else {

                                // Query to check for existing records
                                $select_query = "SELECT * FROM schedule WHERE doctor_Id = '".$id."' AND date_sched = '".$date_sched."' AND (";

                                // Loop through the values of $time_sched_start and $time_sched_end
                                for ($i = 0; $i < count($time_sched_start); $i++) {
                                  // Add each condition to the query
                                  if ($i > 0) {
                                    $select_query .= " OR ";
                                  }
                                  $select_query .= "(time_sched_start = '".$time_sched_start[$i]."' AND time_sched_end = '".$time_sched_end[$i]."')";
                                }

                                $select_query .= ")";

                                $result = mysqli_query($con, $select_query);

                                if (mysqli_num_rows($result) > 0) {
                                    $failed = true;
                                    $failed = 'There are already time schedules under the selected date.';
                                } else {

                                  foreach($time_sched_start as $key1 => $value) {
                                        $save = mysqli_query($con, "INSERT INTO schedule (doctor_Id, date_sched, time_sched_start, time_sched_end, breaktime_start, breaktime_end) VALUES ('".$id."', '".$date_sched."', '".$value."', '".$time_sched_end[$key1]."', '".$breaktime_start."', '".$breaktime_end."') ");
                                        if($save) {
                                            $added = true;
                                            $added = 'Schedule has been added successfully.';
                                        } else {
                                            $failed = true;
                                            $failed = 'Something went wrong while saving the schedule.';
                                        }
                                  }
                                }

                            }

                        }
                      } else {
                        $failed = 'Start times must be earlier than end times';
                      }
                    } else {
                      $failed = 'Number of start times and end times do not match';
                    }


                    
                } else {
                  $failed = true;
                  $failed = 'You can only add up-to seven(7) schedules a day.';
                }
            } else {
              $failed = true;
              $failed = 'You can only add up-to seven(7) schedules a day.';
            }
         } else {
            // Continue with the insertion of new records
                $num_rows = count($time_sched_start);
                if (($total_rows + $num_rows) <= 7) {

                  
                    // Check if the number of start times and end times is the same
                    if(count($time_sched_start) === count($time_sched_end)) {
                      $valid = true;
                      $num_rows = count($time_sched_start);

                      // Compare the start and end times element-wise
                      for($i = 0; $i < $num_rows; $i++) {
                        $start_time = strtotime($time_sched_start[$i]);
                        $end_time = strtotime($time_sched_end[$i]);

                        if($start_time >= $end_time) {
                          $valid = false;
                          break;
                        }
                      }

                      if($valid) {
                        // Save the data to the database
                        if($date_sched < $date_today) {
                          $failed = true;
                          $failed = 'Date schedule must be later than today or equal to date today.';
                        } else {

                            if($breaktime_start >= $breaktime_end) {
                               $failed = true;
                               $failed = 'Breaktime start should be earlier than breaktime end.';
                            } else {

                                 foreach($time_sched_start as $key1 => $value) {
                                        $save = mysqli_query($con, "INSERT INTO schedule (doctor_Id, date_sched, time_sched_start, time_sched_end, breaktime_start, breaktime_end) VALUES ('".$id."', '".$date_sched."', '".$value."', '".$time_sched_end[$key1]."', '".$breaktime_start."', '".$breaktime_end."') ");
                                        if($save) {
                                            $added = true;
                                            $added = 'Schedule has been added successfully.';
                                        } else {
                                            $failed = true;
                                            $failed = 'Something went wrong while saving the schedule.';
                                        }
                                  }

                            }

                        }
                      } else {
                        $failed = 'Start times must be earlier than end times';
                      }
                    } else {
                      $failed = 'Number of start times and end times do not match';
                    }


                    
                } else {
                  $failed = true;
                  $failed = 'You can only add up-to seven(7) schedules a day.';
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
                <form method="POST" enctype="multipart/form-data">
                   <div>
                      <!-- adding alert notification  -->
                      <?php
                         if($added){
                           echo "
                             <div class='btn-success alert' style='padding: 15px; text-align:center;'>
                               ".$added."
                             </div><br>
                           ";
                         }

                         if($failed){
                           echo "
                             <div class='btn-danger alert' style='padding: 15px; text-align:center;'>
                               ".$failed."
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
                      <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                      
                      <div class="col-12">
                         <h2><b>Operating time:</b></h2>
                      </div>
                      <div class="form-group col-md-6">
                         <label for="password">Date Settings</label>
                         <input type="date" class="form-control" name="date_sched" required id="date">
                      </div>
                      <div class="form-group col-md-6"></div>
                      <div class="col-12 p-2">
                         <table class="table table-bordered" id="table_field">
                            <thead>
                                <th>Time Start</th>
                                <th>Time End</th>
                                <th>Add/Remove</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="time" class="form-control" name="time_sched_start[]" id="time" required>
                                        <p id="error-message"></p>
                                    </td>
                                    <td>
                                        <input type="time" class="form-control" name="time_sched_end[]" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" id="add">Add row</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                      </div>
                      <div class="col-12">
                         <h2><b>Breaktime:</b></h2>
                      </div>
                      <div class="form-group col-md-6">
                         <label for="email_address">Breaktime Start</label>
                         <input type="time" class="form-control" name="breaktime_start" required>
                      </div>
                      <div class="form-group col-md-6">
                         <label for="email_address">Breaktime End</label>
                         <input type="time" class="form-control" name="breaktime_end" required>
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
        var html = '<tr><td><input type="time" class="form-control" name="time_sched_start[]" required></td><td><input type="time" class="form-control" name="time_sched_end[]" required></td><td><button class="btn btn-danger" id="remove">Remove row</button></td></tr>';
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
