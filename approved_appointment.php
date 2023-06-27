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
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="noindex,nofollow">
      <title>Doctor</title>
      <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="css/style.css" rel="stylesheet">
      <!-- You can change the theme colors from here -->
      <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
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
         ?><!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
         <!-- ============================================================== -->
         <!-- Container fluid  -->
         <!-- ============================================================== -->
         <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="container">
               <table class="table table-bordered table-striped table-hover" id="myTable">
                  <thead>
                     <tr>
                        <th class="text-center" scope="col">No.</th>
                        <th class="text-center" scope="col">Patient Name</th>
                        <th class="text-center" scope="col">Date</th>
                        <th class="text-center" scope="col">Time</th>
                        <th class="text-center" scope="col">Service</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">View</th>
                        <th class="text-center" scope="col">Delete</th>
                     </tr>
                  </thead>
                  <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='Approved' ";
                     $run_data = mysqli_query($con,$get_data);
                     $i = 0;
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $sl = ++$i;
                         $id = $row['id'];
                         $name = $row['patient_name'];
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = $row['appointment_time'];
                         $service = $row['service_name'];
                         $status=$row['status'];
                     
                         echo "
                     
                         <tr>
                         <td class='text-center'>$sl</td>
                         <td class='text-left'>$name</td>
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>
                         <td class='text-left'>$status</td>
                     
                         <td class='text-center'>
                             <span>
                             <a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-info-circle' aria-hidden='true'></i></a>
                             </span>
                             
                         </td>
                     
                         <td class='text-center'>
                             <span>
                             
                                 <a href='#' class='btn btn-danger deleteuser' title='Delete'>
                                      <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
                                 </a>
                             </span>
                             
                         </td>
                     
                     
                         ";
                     }
                     
                     ?>
               </table>
            </div>
            <!--====DELETE modal==-->
            <!-- Modal -->
            <?php
               $get_data = "SELECT * FROM `appointments` WHERE status='Approved' ";
               $run_data = mysqli_query($con,$get_data);
               
               while($row = mysqli_fetch_array($run_data))
               {
                   $id = $row['id'];
               
                   echo "
               
               <div id='$id' class='modal fade' role='dialog' tabindex='-1'>
                 <div class='modal-dialog'>
                   <!-- Modal content-->
                   <div class='modal-content'>
                     <div class='modal-header'>
                       <button type='button' class='close' data-dismiss='modal'>&times;</button>
                       <h4 class='modal-title'>Are you sure you want to delete?</h4>
                     </div>
                     <div class='modal-body'>
                      <center> <a href='delete_approved.php?id=$id' class='btn btn-danger'>Delete</a></center>
                     </div>
                     
                   </div>
               
                 </div>
               </div>";
               }
               ?><!-- View modal  -->
            <?php 
               // <!-- profile modal start -->
               $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='Approved' ";
               $run_data = mysqli_query($con,$get_data);
               
               while($row = mysqli_fetch_array($run_data))
               {
                     $id = $row['id'];
                     $name = $row['patient_name'];
                     $e_email = $row['email'];
                     $p_phone = $row['phone'];
                     $a_address = $row['address'];
                     $category = $row['category_name'];
                     $service = $row['service_name'];
                     $adate = $row['appointment_date'];
                     $atime = $row['appointment_time'];
                     $status=$row['status'];
                  
                   echo "
               
                       <div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
                       <div class='modal-dialog'>
                           <div class='modal-content'>
                           <div class='modal-header'>
                               <h5 class='modal-title' id='exampleModalLabel'>Appointment Information<i class='fa fa-info-circle' aria-hidden='true'></i></h5>
               
                               <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                               <span aria-hidden='true'>&times;</span>
                               </button>
                           </div>
                           <div class='modal-body'>
                           <div class='container' id='profile'> 
                               <div class='row'>
                                   <div class='col-sm-12 col-md-12'>
                                        <p class='text-secondary'>
                                       <strong>Name:</strong> $name <br>
                                       <strong>E-Mail:</strong> $e_email <br>
                                       <strong>Contact Number:</strong> $p_phone <br>
                                       <strong>Address:</strong> $a_address <br>
                                       <strong>Category:</strong> $category <br>
                                       <strong>Service:</strong> $service <br>
                                       <strong>Date:</strong> $adate <br>
                                       <strong>Time:</strong> $atime <br>
                                       </p>
                                   </div>
                               </div>
               
                           </div>   
                           </div>
                           <div class='modal-footer'>
                               <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                           </div>
                           </form>
                           </div>
                       </div>
                       </div> 
               
               
                   ";
               }
               
               
               // <!-- profile modal end -->
               
               
               ?><!--==edit Data=-->
            <?php
               $get_data = "SELECT * FROM appointments";
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
                       <form action='edit_status.php?id=$id' method='post' enctype='multipart/form-data'>
                       
                       <div class='form-row'>
                           <div class='form-group col-md-12'>
                               <label for='lang'>Status</label>
                     <select name='stats' id='lang' class='form-control'>
                       <option value=''>$status</option>
                       <option value='Approved'>Approved</option>
                       <option value='Cancel'>Cancel</option>
                     </select>
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
               
               
               
               
                   ";
               }
               
               
               ?>
         </div>
      </div>
   </body>
</html>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- slimscrollbar scrollbar JavaScript -->
<script src="js/perfect-scrollbar.jquery.min.js"></script> <!--Wave Effects -->
<script src="js/waves.js"></script> <!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script> <!--Custom JavaScript -->
<script src="js/custom.min.js"></script> 
<script>
   $(document).ready(function () {
   $('#myTable').DataTable();
   
   });
</script> <!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> <!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>