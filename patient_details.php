<?php

// Initialize the session
session_start();

// Retrieve the user ID from the URL parameter
$userId = $_GET['id'];


// database connection
include('config.php');

// Prepare and execute a SQL query to retrieve the user information based on the ID
$sql = "SELECT * FROM user WHERE id = $userId"; // Replace "patients" with your actual table name
$result = $con->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Fetch the data from the result set
    $row = $result->fetch_assoc();

    // Extract the relevant information
    $full_name = $row['full_name'];
    $email_address = $row['email_address'];
    $contact_number = $row['contact_number'];
    $full_address = $row['full_address'];
} else {
    // Handle the case when no user with the provided ID is found
    $full_name = "Unknown";
    $email_address = "Unknown";
    $contact_number = "Unknown";
    $full_address = "Unknown";
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
    /* bootstrap hack: fix content width inside hidden tabs */
    .tab-content>.tab-pane:not(.active),
    .pill-content>.pill-pane:not(.active) {
        display: block;
        height: 0;
        overflow-y: hidden;
    }

    /* bootstrap hack end */

    /* Custom styles for the pressable card */
    .pressable-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .pressable-card:hover {
        background-color: #e0e0e0;
    }

    .pressable-card h2 {
        margin: 60px;
    }

    /* Custom CSS for the cards */
    .card.patient-details-card {
        background-color: #dfdfdf;
        border: 1px solid #ccc;
        border-radius: 40px;
    }

    .card.patient-details-card .card-body {
        padding: 20px;
    }

    .card.patient-details-card h5.card-title {
        margin-bottom: 20px;
    }
    </style>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet" />
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet" />
    <!--c3 CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard.css" rel="stylesheet" />
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">PATIENT RECORDS MANAGEMENT</h3>
                </div>
                <div class="container">
                    <div class="row">
                        <!-- Centered pressable card -->
                        <div class="col-lg-4 col-sm-4 d-flex justify-content-center">
                            <a href="add_patient.php" class="pressable-card">
                                <h2><i class="fa fa-plus-circle"></i> ADD PATIENT</h2>
                            </a>
                        </div>
                        <!-- Centered pressable card -->
                        <div class="col-lg-4 col-sm-4 d-flex justify-content-center">
                            <a href="manage_patient.php" class="pressable-card">
                                <h2><i class="fa fa-plus-circle"></i> PATIENT LIST</h2>
                            </a>
                        </div>
                        <!-- Centered pressable card -->
                        <div class="col-lg-4 col-sm-4 d-flex justify-content-center">
                            <a href="search_records.php" class="pressable-card">
                                <h2><i class="fa fa-plus-circle"></i> <span>SEARCH RECORDS</span></h2>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="card patient-details-card">
                                <div class="card-body">
                                    <h5 class="card-title">Patient Details</h5>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Full Name" class="form-control"
                                                value="<?php echo $full_name; ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control"
                                                value="<?php echo $email_address; ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <input type="tel" name="phonenumber" placeholder="+63-933-555-3585" required
                                                class="form-control" value="<?php echo $contact_number; ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="address" placeholder="Address" class="form-control"
                                                value="<?php echo $full_address; ?>" disabled>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="card patient-details-card">
                                <div class="card-body">

                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-dental-history-tab" data-toggle="pill"
                                                href="#pills-dental-history" role="tab"
                                                aria-controls="pills-dental-history" aria-selected="true">Dental
                                                History</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-approved-appointments-tab" data-toggle="pill"
                                                href="#pills-approved-appointments" role="tab"
                                                aria-controls="pills-approved-appointments"
                                                aria-selected="false">Approved Appointments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-cancelled-appointments-tab" data-toggle="pill"
                                                href="#pills-cancelled-appointments" role="tab"
                                                aria-controls="pills-cancelled-appointments"
                                                aria-selected="false">Cancelled Appointments</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="pills-rejected-appointments-tab" data-toggle="pill"
                                                href="#pills-rejected-appointments" role="tab"
                                                aria-controls="pills-rejected-appointments"
                                                aria-selected="false">Rejected Appointments</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-no-show-tab" data-toggle="pill"
                                                href="#pills-no-show" role="tab" aria-controls="pills-no-show"
                                                aria-selected="false">No Show</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-dental-history" role="tabpanel"
                                            aria-labelledby="pills-dental-history-tab">
                                            <!-- Dental History tab content -->
                                            <table class="table table-bordered table-striped table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">No.</th>

                                                        <th class="text-center" scope="col">Date</th>
                                                        <th class="text-center" scope="col">Time</th>
                                                        <th class="text-center" scope="col">Service</th>
                                                        <th class="text-center" scope="col">View</th>
                                                        <th class="text-center" scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <?php
$get_data = "SELECT appointments.*, category.category_name, services.service_name, user.full_name 
FROM appointments 
INNER JOIN category ON appointments.category = category.category_id 
INNER JOIN services ON appointments.service = services.service_id 
INNER JOIN user ON appointments.doctor_Id = user.id 
WHERE appointments.patient_id = $userId AND status='Done'";
                     $run_data = mysqli_query($con,$get_data);
                     $i = 0;
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $sl = ++$i;
                         $id = $row['id'];
                         
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = $row['appointment_time'];
                         $service = $row['service_name'];
                         
                     
                         echo "
                     
                         <tr>
                         <td class='text-center'>$sl</td>
                      
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>

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

               $get_data = "SELECT * FROM `appointments` WHERE status='Done' ";
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
                      <center>  <a href='delete_history.php?id=$id&userId=$userId' class='btn btn-danger'>Delete</a></center>
                     </div>
                     
                   </div>
               
                 </div>
               </div>";
               }
               ?>
               <?php 
               // <!-- profile modal start -->
               $get_data = "SELECT appointments.*, category.category_name, services.service_name, user.full_name 
               FROM appointments 
               INNER JOIN category ON appointments.category = category.category_id 
               INNER JOIN services ON appointments.service = services.service_id 
               INNER JOIN user ON appointments.doctor_Id = user.id 
               WHERE status='Done'";
               
               $run_data = mysqli_query($con,$get_data);
               
               while($row = mysqli_fetch_array($run_data))
               {
                     $id = $row['id'];
                     $name = $row['patient_name'];
                     $e_email = $row['email'];
                     $p_phone = $row['phone'];
                     $a_address = $row['address'];
                     $category = $row['category_name'];
                     $doctor = $row['full_name'];
                     $service = $row['service_name'];
                     $adate = $row['appointment_date'];
                     $atime = $row['appointment_time'];
                     $status=$row['status'];

                     
                  
                   echo "
               
                       <div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
                       <div class='modal-dialog'>
                           <div class='modal-content'>
                           <div class='modal-header'>
                               <h5 class='modal-title' id='exampleModalLabel'>Dental History<i class='fa fa-info-circle' aria-hidden='true'></i></h5>
               
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
                                       <strong>Doctor Assigned:</strong> Dr. $doctor <br>
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
                                        <div class="tab-pane fade" id="pills-approved-appointments" role="tabpanel"
                                            aria-labelledby="pills-approved-appointments-tab">
                                            <!-- Approved Appointments tab content -->
                                            <table class="table table-bordered table-striped table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">No.</th>
                                                        <th class="text-center" scope="col">Date</th>
                                                        <th class="text-center" scope="col">Time</th>
                                                        <th class="text-center" scope="col">Service</th>

                                                    </tr>
                                                </thead>
                                                <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE appointments.patient_id = $userId AND status='Approved' ";
                     $run_data = mysqli_query($con,$get_data);
                     $i = 0;
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $sl = ++$i;
                         $id = $row['id'];
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = $row['appointment_time'];
                         $service = $row['service_name'];
                         $status=$row['status'];
                     
                         echo "
                     
                         <tr>
                         <td class='text-center'>$sl</td>
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>
                     
                         ";
                     }
                     
                     ?>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-cancelled-appointments" role="tabpanel"
                                            aria-labelledby="pills-cancelled-appointments-tab">
                                            <!-- Cancelled Appointments tab content -->
                                            <table class="table table-bordered table-striped table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">No.</th>
                                                        <th class="text-center" scope="col">Date</th>
                                                        <th class="text-center" scope="col">Time</th>
                                                        <th class="text-center" scope="col">Service</th>

                                                    </tr>
                                                </thead>
                                                <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE  appointments.patient_id = $userId AND status='Cancel' ";
                     $run_data = mysqli_query($con,$get_data);
                     $i = 0;
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $sl = ++$i;
                         $id = $row['id'];
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = $row['appointment_time'];
                         $service = $row['service_name'];
                         $status=$row['status'];
                     
                         echo "
                     
                         <tr>
                         <td class='text-center'>$sl</td>
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>
                     
                         ";
                     }
                     
                     ?>
                                            </table>
                                        </div>
                                        <!-- <div class="tab-pane fade" id="pills-rejected-appointments" role="tabpanel"
                                            aria-labelledby="pills-rejected-appointments-tab">
                                           
                                        </div> -->

                                        <div class="tab-pane fade" id="pills-no-show" role="tabpanel"
                                            aria-labelledby="pills-no-show-tab">
                                            <!-- No Show tab content -->
                                            <table class="table table-bordered table-striped table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" scope="col">No.</th>
                                                        <th class="text-center" scope="col">Date</th>
                                                        <th class="text-center" scope="col">Time</th>
                                                        <th class="text-center" scope="col">Service</th>

                                                    </tr>
                                                </thead>
                                                <?php
                     $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE  appointments.patient_id = $userId AND status='No Show' ";
                     $run_data = mysqli_query($con,$get_data);
                     $i = 0;
                     while($row = mysqli_fetch_array($run_data))
                     {
                         $sl = ++$i;
                         $id = $row['id'];
                         $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                         $atime = $row['appointment_time'];
                         $service = $row['service_name'];
                         $status=$row['status'];
                     
                         echo "
                     
                         <tr>
                         <td class='text-center'>$sl</td>
                         <td class='text-left'>$adate</td>
                         <td class='text-left'>$atime</td>
                         <td class='text-left'>$service</td>
                     
                         ";
                     }
                     
                     ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $(document).ready(function() {
            $(".nav-tabs a").click(function() {
                $(this).tab('show');
            });
        });
        </script>
</body>

</html>