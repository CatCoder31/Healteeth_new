<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
function getServiceDuration($duration) {
  $durationArray = explode(":", $duration); // Split the duration string into hours, minutes, and seconds
  $hours = intval($durationArray[0]);
  $minutes = intval($durationArray[1]);
  $seconds = intval($durationArray[2]);

  $durationText = '';
  if ($hours > 0) {
      $durationText .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ';
  }
  if ($minutes > 0) {
      $durationText .= $minutes . ' minute' . ($minutes > 1 ? 's' : '');
  }

  return $durationText;
}
// database connection
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title>Doctor</title>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet"/>
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet"/>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.15.0/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.15.0/jquery.timepicker.min.js"></script>
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

<?php include 'includes/topheader.php'; ?>
<?php include 'includes/sidebar_doctor.php'; ?>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="container">
            <table class="table table-bordered table-striped table-hover" id="myTable">
                <thead>
                <tr>
                    <th class="text-center" scope="col">No.</th>
                    <th class="text-center" scope="col">Category</th>
                    <th class="text-center" scope="col">Service</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Duration</th>
                    <th class="text-center" scope="col">View</th>
                    <th class="text-center" scope="col">Edit</th>
                    <th class="text-center" scope="col">Delete</th>
                </tr>
                </thead>
                <?php
                $get_data = "SELECT * FROM services INNER JOIN category ON services.category_id=category.category_id order by 1 desc";
                $run_data = mysqli_query($con, $get_data);
                $i = 0;
                while ($row = mysqli_fetch_array($run_data)) {
                    $sl = ++$i;
                    $id = $row['service_id'];
                    $category_name = $row['category_name'];
                    $service_name = $row['service_name'];
                    $service_price = $row['service_price'];
                    $service_duration = $row['service_duration'];
                    ?>
                    <tr>
                        <td class='text-center'><?php echo $sl; ?></td>
                        <td class='text-left'><?php echo $category_name; ?></td>
                        <td class='text-left'><?php echo $service_name; ?></td>
                        <td class='text-left'><?php echo $service_price; ?></td>
                        <td class='text-left'><?php echo getServiceDuration($service_duration); ?></td>
                        <td class='text-center'>
                            <span>
                                <a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view<?php echo $id; ?>' title='Prfile'><i class='fa fa-eye' aria-hidden='true'></i></a>
                            </span>
                        </td>
                        <td class='text-center'>
                            <span>
                                <a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit<?php echo $id; ?>' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>
                            </span>
                        </td>
                        <td class='text-center'>
                            <span>
                                <a href='#' class='btn btn-danger deleteuser' title='Delete'>
                                    <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#<?php echo $id; ?>' style='' aria-hidden='true'></i>
                                </a>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<!-- Delete modal -->
<?php
$get_data = "SELECT * FROM services INNER JOIN category ON services.category_id=category.category_id";
$run_data = mysqli_query($con, $get_data);
while ($row = mysqli_fetch_array($run_data)) {
    $id = $row['service_id'];
    ?>
    <div id='<?php echo $id; ?>' class='modal fade' role='dialog' tabindex='-1'>
        <div class='modal-dialog'>
            <!-- Modal content-->
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Are you sure you want to delete?</h4>
                </div>
                <div class='modal-body'>
                    <center>
                        <a href='delete_service.php?service_id=<?php echo $id; ?>' class='btn btn-danger'>Delete</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- View modal -->
<?php
$get_data = "SELECT * FROM services INNER JOIN category ON services.category_id=category.category_id";
$run_data = mysqli_query($con, $get_data);
while ($row = mysqli_fetch_array($run_data)) {
    $id = $row['service_id'];
    $c_name = $row['category_name'];
    $s_name = $row['service_name'];
    $s_price = $row['service_price'];
    $s_duration = $row['service_duration'];
    ?>
    <div class='modal fade' id='view<?php echo $id; ?>' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Service Details <i class='fa fa-user' aria-hidden='true'></i></h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='container' id='profile'>
                        <div class='row'>
                            <div class='col-sm-12 col-md-6'>
                                <p class='text-secondary'>
                                    <strong>Category:</strong> <?php echo $c_name; ?><br>
                                    <strong>Service:</strong> <?php echo $s_name; ?><br>
                                    <strong>Price:</strong> <?php echo $s_price; ?><br>
                                    <strong>Price:</strong> <?php echo getServiceDuration($s_duration); ?><br>
                                </p>
                                <!-- Split button -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Edit Data -->
<?php
$get_data = "SELECT * FROM services INNER JOIN category ON services.category_id=category.category_id";
$run_data = mysqli_query($con, $get_data);
while ($row = mysqli_fetch_array($run_data)) {
    $id = $row['service_id'];
    $cc_name = $row['category_name'];
    $ss_name = $row['service_name'];
    $ss_price = $row['service_price'];
    $ss_duration = $row['service_duration'];
    ?>
    <div id='edit<?php echo $id; ?>' class='modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title text-center'>Edit Category</h4>
                </div>
                <div class='modal-body'>
                    <form action='edit_service.php?service_id=<?php echo $id; ?>' method='post' enctype='multipart/form-data'>
                        <div class='form-row'>
                            <div class='form-group col-md-12'>
                                <label for='c_name'>Category Name</label>
                                <input type='text' class='form-control' name='ca_name' placeholder='Enter Category Name' value='<?php echo $cc_name; ?>' disabled>
                            </div>
                            <div class='form-group col-md-12'>
                                <label for='s_name'>Service Name</label>
                                <input type='text' class='form-control' name='se_name' placeholder='Enter Service' value='<?php echo $ss_name; ?>'>
                            </div>
                            <div class='form-group col-md-12'>
                                <label for='s_price'>Price</label>
                                <input type='text' class='form-control' name='se_price' placeholder='Enter Price' value='<?php echo $ss_price; ?>'>
                            </div>
                            <div class='form-group col-md-12'>
                                <label for='s_price'>Duration</label>
                                <input type='text' class='form-control timepicker' name='se_duration' placeholder='Enter Duration' value='<?php echo $ss_duration; ?>'>
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
<?php } ?>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.timepicker').timepicker({
            timeFormat: 'HH:mm', // Display time in 24-hour format
            interval: 15, // Set the time interval to 15 minutes
            minTime: '00:00', // Set the minimum time to 00:00 (midnight)
            maxTime: '23:59' // Set the maximum time to 23:59 (11:59 PM)
        });
    });
</script>

<script>
    function getServiceDuration(duration) {
        var durationArr = duration.split(':'); // Split the duration string into hours, minutes, and seconds
        var hours = parseInt(durationArr[0]);
        var minutes = parseInt(durationArr[1]);
        var durationText = '';

        if (hours > 0) {
            durationText += hours + ' hour' + (hours > 1 ? 's' : '') + ' ';
        }

        if (minutes > 0) {
            durationText += minutes + ' minute' + (minutes > 1 ? 's' : '');
        }

        return durationText;
    }
</script>

</body>
</html>