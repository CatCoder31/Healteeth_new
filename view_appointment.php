<?php
   // Initialize the session
   session_start();
    
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }
   // database connection
   include('config.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="robots" content="noindex,nofollow" />
      <meta http-equiv="refresh" content="60">
      <title>Doctor</title>
      <link
         href="assets/plugins/bootstrap/css/bootstrap.min.css"
         rel="stylesheet"
         />
      <!-- Custom CSS -->
      <link href="css/style.css" rel="stylesheet" />
      <!-- You can change the theme colors from here -->
      <link href="css/colors/default-dark.css" id="theme" rel="stylesheet" />
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
      <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
               <table class="table table-bordered table-striped table-hover" id="myTable">
                  <thead>
                     <tr>
                        <th class="text-center" scope="col">Patient Name</th>
                        <th class="text-center" scope="col">Appointment Date</th>
                        <th class="text-center" scope="col">Appointment Time Start</th>
                        <th class="text-center" scope="col">Estimated Time End</th>
                        <th class="text-center" scope="col">Service</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Status</th>
                     </tr>
                  </thead>
                  <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN services ON appointments.service=services.service_id WHERE appointment_date=CURRENT_DATE AND status='Approved'";
                     $run_data = mysqli_query($con,$get_data);
                     while($row = mysqli_fetch_array($run_data))
                     {
                        $id = $row['id'];
                        $pname = $row['patient_name'];
                        $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                        $atime = date('h:i A',(strtotime($row['appointment_time'])));
                        $tfinish = date('h:i A',(strtotime($row['time_finish'])));
                        $service = $row['service_name'];
                        $price = $row['service_price'];

                        // Calculate the appointment start time plus 15 minutes
                        $appointmentStartTime = DateTime::createFromFormat('h:i A', $atime);
                        $appointmentStartTime->modify('+15 minutes');

                        // Get the current datetime
                        $currentDateTime = new DateTime();

                        // Compare the current datetime with the appointment start time plus 15 minutes
                        if ($currentDateTime > $appointmentStartTime) {
                        // Update the status to 'No Show'
                        $update_query = "UPDATE appointments SET status = 'No Show' WHERE id = $id";
                        mysqli_query($con, $update_query);
                    }
                  ?> 
                         <tr>
                         <td class='text-left'><?php echo $pname?></td>
                         <td class='text-left'><?php echo $adate?></td>
                         <td class='text-left'><?php echo $atime?></td>
                         <td class='text-left'><?php echo $tfinish?></td>
                         <td class='text-left'><?php echo $service?></td>
                         <td class='text-left'><?php echo "₱".$price?></td>
                         </td>
                     
                     <td class='text-center'>
                       <span>
                       <a href='#' class='btn btn-warning mr-3 editappointment' data-toggle='modal' data-target='#edit<?php echo $id?>' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
                       </span>
                     </td>
                     
                     </tr>
                     <?php
                     }
                     ?>
                  <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN services ON appointments.service=services.service_id WHERE appointment_date=CURRENT_DATE AND status='Approved'";
                     $run_data = mysqli_query($con,$get_data);
                     
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $id = $row['id'];
                         $status = $row['status'];
                         echo "
                     
                     <div id='edit$id' class='modal fade' role='dialog'>
                       <div class='modal-dialog'>
                     
                     
                         <div class='modal-content'>
                           <div class='modal-header'>
                                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  <h4 class='modal-title text-center'>Edit Status</h4> 
                           </div>
                     
                           <div class='modal-body'>
                             <form action='edit_appointment.php?id=$id' method='post' enctype='multipart/form-data'>
                             
                           <div class='form-row'>
                              <div class='form-group col-md-12' id='status'>
                                     <label for='lang'>Status</label>
                              <select name='stats' id='stats' class='form-control stats'>
                                <option disabled value=''>$status</option>
                                <option value='Done'>Done</option>
                                <option value='No Show'>No Show</option>
                              </select>
                              </div>
                              <div class='form-group col-md-12 settimedelay' id='settimedelay' style='display:none'>
                                 <label for='lang'>Time delay</label>
                                 <input type='text' name='timedel' id='lang' class='form-control'>
                              </div>
                           </div>
                             <div class='modal-footer'>
                                  <input type='submit' name='submit' class='btn btn-info btn-large' value='Submit'>
                                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                             </div>
                             </form>
                           </div>
                     
                         </div>
                         </div>
                         </div>
                     
                     </div>
                     ";
                     }
                     ?>
               </table>
            </div>
         </div>
      </div>
      </div>

      <script>
      // Function to refresh the page
      function refreshPage() {
         // Get the current time
         var currentTime = new Date();

         // Calculate the remaining seconds until the next refresh
         var remainingSeconds = 60 - currentTime.getSeconds();

         // Display the remaining seconds
         document.getElementById('refresh-seconds').textContent = remainingSeconds;

         // Refresh the page after 60 seconds (1 minute)
         setTimeout(function() {
            location.reload();
         }, 60000);
      }

      // Call the refreshPage function on page load
      refreshPage();
   </script>
   
   </body>
</html>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<script>
   $(document).ready(function () {
     $('#myTable').DataTable();
   });
</script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>