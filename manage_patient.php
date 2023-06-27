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
      <div class="container">
         <table class="table table-bordered table-striped table-hover" id="myTable">
            <thead>
               <tr>
                  <th class="text-center" scope="col">No.</th>
                  <th class="text-center" scope="col">Name</th>
                  <th class="text-center" scope="col">E-mail</th>
                  <th class="text-center" scope="col">Contact Number</th>
                  <th class="text-center" scope="col">Address</th>
                  <th class="text-center" scope="col">View</th>
                  <th class="text-center" scope="col">Edit</th>
                  <th class="text-center" scope="col">Delete</th>
               </tr>
            </thead>
            <?php
               $get_data = "SELECT * FROM user WHERE role='Patient' order by 1 desc";
               $run_data = mysqli_query($con,$get_data);
               $i = 0;
               while($row = mysqli_fetch_array($run_data))
               {
                   $sl = ++$i;
                   $id = $row['id'];
                   $name = $row['full_name'];
                   $email = $row['email_address'];
                   $c_num = $row['contact_number'];
                   $address = $row['full_address'];
               
                   echo "
                   <tr>
                   <td class='text-center'>$sl</td>
                   <td class='text-left'>$name</td>
                   <td class='text-left'>$email</td>
                   <td class='text-left'>$c_num</td>
                   <td class='text-left'>$address</td>
                   <td class='text-center'>
                       <span>
                       <a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-eye' aria-hidden='true'></i></a>
                       </span>
                   </td>
                   <td class='text-center'>
                       <span>
                       <a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
                       </span>
                   </td>
                   <td class='text-center'>
                       <span>
                           <a href='#' class='btn btn-danger deleteuser' title='Delete'>
                                <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
                           </a>
                       </span>
                   </td>
               </tr>
               
                   ";
               }
               
               ?>
         </table>
      </div>
      <!------DELETE modal---->
      <!-- Modal -->
      <?php
         $get_data = "SELECT * FROM user WHERE role='Patient' ";
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
                <center> <a href='delete_patient.php?id=$id' class='btn btn-danger'>Delete</a></center>
               </div>
             </div>
           </div>
         </div>
             ";
             
         }
         
         
         ?>
      <!-- View modal  -->
      <?php 
         // <!-- profile modal start -->
         $get_data = "SELECT * FROM user WHERE role='Patient' ";
         $run_data = mysqli_query($con,$get_data);
         
         while($row = mysqli_fetch_array($run_data))
         {
             $id = $row['id'];
             $fname = $row['full_name'];
             $pemail = $row['email_address'];
             $pc_num = $row['contact_number'];
             $padd = $row['full_address'];
            
             echo "
                 <div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
                 <div class='modal-dialog'>
                     <div class='modal-content'>
                     <div class='modal-header'>
                         <h5 class='modal-title' id='exampleModalLabel'>Profile <i class='fa fa-user' aria-hidden='true'></i></h5>
                         <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                         <span aria-hidden='true'>&times;</span>
                         </button>
                     </div>
                     <div class='modal-body'>
                     <div class='container' id='profile'> 
                         <div class='row'>
                             <div class='col-sm-12 col-md-6'>
                                 <img src='assets/image/image.jpg' alt='' style='width: 150px; height: 150px;' ><br><br>
                             </div>
                             <div class='col-sm-3 col-md-6'>
                                 <p class='text-secondary'>
                                 <strong>Name:</strong> $fname <br>
                                 <strong>E-Mail:</strong> $pemail <br>
                                 <strong>Contact Number:</strong> $pc_num <br>
                                 <strong>Address:</strong> $padd <br>
                                 </p>
                                 <!-- Split button -->
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
                 </div>";
         }
         
         
         // <!-- profile modal end -->
         
         
         ?>
      <!----edit Data--->
      <?php
         $get_data = "SELECT * FROM user WHERE role='Patient' ";
         $run_data = mysqli_query($con,$get_data);
         
         while($row = mysqli_fetch_array($run_data))
         {
             $id = $row['id'];
             $fname = $row['full_name'];
             $pemail = $row['email_address'];
             $pc_num = $row['contact_number'];
             $padd = $row['full_address'];
             echo "
         <div id='edit$id' class='modal fade' role='dialog'>
           <div class='modal-dialog'>
             <div class='modal-content'>
               <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title text-center'>Edit your Data</h4> 
               </div>
               <div class='modal-body'>
                 <form action='edit_patient.php?id=$id' method='post' enctype='multipart/form-data'>
                 <div class='form-row'>
                     <div class='form-group col-md-12'>
                         <label for='fname'>Full Name</label>
                         <input type='text' class='form-control' name='f_name' placeholder='Enter Full Name' value='$fname'>
                     </div>
                     <div class='form-group col-md-12'>
                         <label for='email'>E-mail</label>
                         <input type='text' class='form-control' name='e_mail' placeholder='Enter Email' value='$pemail'>
                     </div>
                     <div class='form-group col-md-12'>
                         <label for='cnum'>Contact Number</label>
                         <input type='text' class='form-control' name='c_num' placeholder='Enter Contact Number' value='$pc_num'>
                     </div>
                     <div class='form-group col-md-12'>
                         <label for='address'>Address</label>
                         <input type='text' class='form-control' name='a_ddress' placeholder='Enter Address' value='$padd'>
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
         </div>";
         }
         ?>
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