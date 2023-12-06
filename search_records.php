<?php
// Initialize the session
session_start();

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
    }

    .pressable-card:hover {
        background-color: #e0e0e0;
    }

    .pressable-card h2 {
        margin: 60px;
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
                    <h3 class="text-themecolor">PATIENT RECORDS / SEARCH RECORDS</h3>
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
                </div>

                <div class="container">
    <div class="row justify-content-center mt-4"> <!-- Add justify-content-center class to center align the row -->
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by Full Name">
        </div>
    </div>
    <div id="searchResults"></div>
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

<script>
$(document).ready(function() {
    // Live search function
    $('#searchInput').on('keyup', function() {
        var searchQuery = $(this).val();

        $.ajax({
            url: 'search.php',
            method: 'POST',
            data: {
                query: searchQuery
            },
            success: function(response) {
                $('#searchResults').html(response);
            }
        });
    });


});
</script>
</body>

</html>