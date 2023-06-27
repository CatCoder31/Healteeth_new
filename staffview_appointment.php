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
         include 'includes/sidebar_staff.php';
         ?>
      <!-- ============================================================== -->
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
                        <th class="text-center" scope="col">Patient Name</th>
                        <th class="text-center" scope="col">Appointment Date</th>
                        <th class="text-center" scope="col">Appointment Time</th>
                        <th class="text-center" scope="col">Service</th>
                        <th class="text-center" scope="col">Price</th>
                     </tr>
                  </thead>
                  <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE appointment_date=CURRENT_DATE AND status='Approved'";
                     $run_data = mysqli_query($con,$get_data);
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $pname = $row['patient_name'];
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = date('h:i A',(strtotime($row['appointment_time'])));
                         $service = $row['service_name'];
                         $price = $row['service_price'];
                     
                         echo "
                     
                         <tr>
                         <td class='text-left'>$pname</td>
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>
                         <td class='text-left'>$price</td>
                     
                     </tr>
                     
                         ";
                     }
                     
                     ?>
               </table>
            </div>
         </div>
      </div>
      </div>
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