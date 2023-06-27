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
   
   $added = false;
   
   
   //Add  new student code 
   
   if(isset($_POST['submit'])){
     $full_name = $_POST['full_name'];
     $email_address = $_POST['email_address'];
     $password = $_POST['password'];
     $contact_number = $_POST['contact_number'];
     $full_address = $_POST['full_address'];
     $role = $_POST['role'];
   
     $hash= md5($password);
   
       $insert_data = "INSERT INTO user(full_name, email_address, password, contact_number, full_address, role) VALUES ('$full_name','$email_address','$hash','$contact_number','$full_address','$role')";
       $run_data = mysqli_query($con,$insert_data);
   
       if($run_data){
         $added = true;
       }else{
         echo ("Error description: " . $con -> error);
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
      <div class="card">
         <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
               <div>
                  <!-- adding alert notification  -->
                  <?php
                     if($added){
                       echo "
                         <div class='btn-success' style='padding: 15px; text-align:center;'>
                           New User Added Successfully.
                         </div><br>
                       ";
                     }
                     
                     ?>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="full_name">Doctor's Name</label>
                     <input type="text" class="form-control" name="full_name" placeholder="Enter Doctor's Name" required>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="email_address">Email</label>
                     <input type="email" class="form-control" name="email_address" placeholder="Enter Email Address">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" name="password" placeholder="Enter Password">
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label for="contact_number">Contact Number</label>
                     <input type="number" class="form-control" name="contact_number" placeholder="Enter Contact Number">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="full_address">Address</label>
                     <input type="text" class="form-control" name="full_address" placeholder="Enter Home Address">
                  </div>
                  <div class="col-md-6">
                     <label for="role">Role</label>
                     <select id="role" name="role" class="form-control">
                        <option selected>N/A</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Staff">Staff</option>
                     </select>
                  </div>
               </div>
               <div class="form-group col-md-12" align="center">
                  <input type="submit" name="submit" class="btn btn-info" value="Submit">         
               </div>
            </form>
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