<?php
   // Initialize the session
   session_start();
   include('config.php');

   date_default_timezone_set('Asia/Manila');
   $date_today = date('Y-m-d');

   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: login.php");
       exit;
   }


   $delete = false;
   if(isset($_POST['deleteSched'])) {
    $SchedId = $_POST['SchedId'];
    $deletess = mysqli_query($con, "DELETE FROM schedule WHERE sched_Id = '$SchedId'");

    if($deletess){
        $delete = true;
        $delete = 'Successfully deleted!';
    }else{
        $delete = true;
        $delete = 'Something went wrong while deleting the record.';
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
      <div class="container">
         <a href='schedule_add.php' class='btn btn-primary' title='Delete'>Add schedule</a>
         <div>
                  <!-- adding alert notification  -->
              <?php
                 if($delete){
                   echo "
                     <div class='btn-success mt-3 alert' style='padding: 15px; text-align:center;'>
                       ".$delete."
                     </div><br>
                   ";
                 } 
                 
                 ?>
               </div>

         <table class="table table-bordered table-striped table-hover" id="myTable">
            <thead>
               <tr>
                  <th class="text-center" scope="col">#</th>
                  <th class="text-center" scope="col">Date schedule</th>
                  <th class="text-center" scope="col">Time Schedule</th>
                  <th class="text-center" scope="col">Breaktime Schedule</th>
                  <th class="text-center" scope="col">Actions</th>
               </tr>
            </thead>
            <?php
               $get_data = "SELECT * FROM schedule JOIN user ON schedule.doctor_Id=user.id WHERE schedule.doctor_Id='$id' AND date_sched >= '$date_today'";
               $run_data = mysqli_query($con,$get_data);
               $i = 1;
               while($row = mysqli_fetch_array($run_data))
               {
            ?>
               
               <tr>
                   <td class='text-center'><?php echo $i++; ?></td>
                   <td class='text-center'><?php echo date("F d, Y", strtotime($row['date_sched'])) ?></td>
                   <td class='text-center'><?php echo $row['time_sched_start'].' - '.$row['time_sched_end'] ?></td>
                   <td class='text-center'><?php echo $row['breaktime_start'].' - '.$row['breaktime_end'] ?></td>
                   <td class='text-center'>
                       <a href='schedule_update.php?sched_Id=<?php echo $row['sched_Id']; ?>' class='btn btn-success' title='Delete'><i class='fa fa-pencil-square-o fa-lg'></i></a>
                       <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#<?php echo $row['sched_Id']; ?>'><i class='fa fa-trash-o fa-lg' aria-hidden='true'></i></a>
                   </td>
               </tr>


                <div class="modal fade" id="<?php echo $row['sched_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Schedule</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" class="form-control" name="SchedId" value="<?php echo $row['sched_Id']; ?>">
                        <h3>Are you sure you want to delete?</h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="deleteSched">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

               
             <?php  }
               
               ?>
         </table>
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

    $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,4000);
  }
  );
</script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>