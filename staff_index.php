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
    <title>Staff</title>
    
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
    <link
      href="assets/plugins/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link
      href="assets/plugins/chartist-js/dist/chartist.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css"
      rel="stylesheet"
    />
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
<div class="row page-titles">
            <div class="col-md-5 align-self-center">
              <h3 class="text-themecolor">Dashboard</h3>
            </div>
            <div class="container">
    <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-calendar-check-o"></i>
        <?php
         $sql = "SELECT * FROM `appointments` INNER JOIN services ON appointments.service=services.service_id WHERE appointment_date=CURRENT_DATE AND status='Approved'";
         $query = $con->query($sql);
         $countAppointment = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countAppointment; ?></span>
        <span class="count-name">Appointment</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter danger">
        <i class="fa fa-calendar-times-o"></i>
        <?php
         $sql = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='Cancel'";
         $query = $con->query($sql);
         $countVoters = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countVoters; ?></span>
        <span class="count-name">Cancelled</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fa fa-calendar-o"></i>
        <?php
         $sql = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='Pending'";
         $query = $con->query($sql);
         $countPending = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countPending; ?></span>
        <span class="count-name">Pending</span>
      </div>
    </div>


    <div class="col-md-3">
      <div class="card-counter info">
        <i class="fa fa-user"></i>
        <?php
         $sql = "SELECT * FROM user where role='Patient'";
         $query = $con->query($sql);
         $countUser = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countUser; ?></span>
        <span class="count-name">No. of Patient</span>
      </div>
    </div>
  </div>

  <br>

   <div class="row">
    <div class="col-md-3">
      <div class="card-counter yellow">
        <i class="fa fa-check-square"></i>
        <?php
         $sql = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='Done'";
         $query = $con->query($sql);
         $countDone = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countDone; ?></span>
        <span class="count-name">Done</span>
      </div>
    </div>


    <div class="col-md-3">
      <div class="card-counter red">
        <i class="fa fa-exclamation-circle"></i>
        <?php
         $sql = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE status='No Show'";
         $query = $con->query($sql);
         $countNo = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countNo; ?></span>
        <span class="count-name">No show</span>
      </div>
   </div>

    <div class="col-md-3">
      <div class="card-counter secondary">
        <i class="fa fa-user-md"></i>
        <?php
         $sql = "SELECT * FROM user WHERE role='Doctor'";
         $query = $con->query($sql);
         $countDoctor = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countDoctor; ?></span>
        <span class="count-name">Doctor</span>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card-counter light">
        <i class="fa fa-users"></i>
        <?php
         $sql = "SELECT * FROM user WHERE role='Staff'";
         $query = $con->query($sql);
         $countStaff = $query->num_rows;
        ?>
        <span class="count-numbers"><?php echo $countStaff; ?></span>
        <span class="count-name">Staff</span>
      </div>
    </div>
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
  </body>
</html>
