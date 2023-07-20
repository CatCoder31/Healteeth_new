<?php

    session_start();
   // Include config file
   include('config.php');
    
   // Define variables and initialize with empty values
   $name = $email = $password  = $phonenumber = $address ="";
   $name_err = $email_err = $password_err = "";
   
   // Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    
       // Validate email
       if(empty(trim($_POST["email"]))){
           $email_err = "Please enter a email.";
       } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
           $email_err = "Invalid email format";
       } else{
           // Prepare a select statement
           $sql = "SELECT id FROM user WHERE email_address = ?";
           
           if($stmt = mysqli_prepare($con, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "s", $param_email);
               
               // Set parameters
               $param_email = trim($_POST["email"]);
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   /* store result */
                   mysqli_stmt_store_result($stmt);
                   
                   if(mysqli_stmt_num_rows($stmt) == 1){
                       $email_err = "This email is already taken.";
                   } else{
                       $email = trim($_POST["email"]);
                   }
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
   
               // Close statement
               mysqli_stmt_close($stmt);
           }
       }
       
   
   // Validate password
       if(empty(trim($_POST["name"]))){
           $name_err = "Please enter your name.";     
       } else{
           $name = trim($_POST["name"]);
       }
   
       if(empty(trim($_POST["phonenumber"]))){
           $phonenumber_err = "Please enter your Contact Number.";     
       } else{
           $phonenumber = trim($_POST["phonenumber"]);
       }
   
       if(empty(trim($_POST["address"]))){
           $address_err = "Please enter your addresss.";     
       } else{
           $address = trim($_POST["address"]);
       }
   
       // Validate password
       if(empty(trim($_POST["password"]))){
           $password_err = "Please enter a password.";     
       } elseif(strlen(trim($_POST["password"])) < 6){
           $password_err = "Password must have atleast 6 characters.";
       } else{
           $password = trim($_POST["password"]);
       }
       
       
       
       // Check input errors before inserting in database
       if(empty($name_err) && empty($email_err) && empty($password_err) && empty($phonenumber_err) && empty($address_err)){
           
           // Prepare an insert statement
           $sql = "INSERT INTO user (full_name, email_address, password, contact_number, full_address) VALUES (?, ?, ?, ?, ?)";
            
           if($stmt = mysqli_prepare($con, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_password, $param_phonenumber, $param_address);
               
               // Set parameters
               $param_name = $name;
               $param_email = $email;
               $param_password = md5($password); // Creates a password hash
               $param_phonenumber = $phonenumber;
               $param_address=$address;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   // Redirect to login page
                   header("location: add_patient.php");
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
   
               // Close statement
               mysqli_stmt_close($stmt);
           }
       }
       
       // Close connection
       mysqli_close($con);
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
    }

    .pressable-card:hover {
        background-color: #e0e0e0;
    }

    .pressable-card h2 {
        margin: 60px;
    }

    .container1 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
        margin-top: 10px; /* Adjust the margin top value as needed */
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
                    <h3 class="text-themecolor">PATIENT RECORDS / ADD PATIENT</h3>
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

                <div class="container1">
                    <div class="row">
                        <form method="post" autocomplete="off" id="f"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Full Name"
                                    class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email"
                                    class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" name="password" id="password" placeholder="Password"
                                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $password; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-change"
                                            onclick="togglePasswordVisibility(); return false;">
                                            <i id="password-icon" class="fa fa-eye" style="color: #65cad7;"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-change" onclick="generatePassword(); return false;">
                                            Generate Password
                                        </button>
                                    </div>
                                </div>
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>

                            <script>
                            function generatePassword() {
                                // Code to generate a random password
                                var randomPassword = generateRandomPassword();

                                // Set the generated password to the password field
                                document.getElementById('password').value = randomPassword;
                            }

                            function generateRandomPassword() {
                                // Code to generate a random password
                                // Replace this with your password generation logic

                                // Example: Generating a random 8-character password
                                var charset =
                                    "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
                                var password = "";
                                for (var i = 0; i < 8; i++) {
                                    password += charset.charAt(Math.floor(Math.random() * charset.length));
                                }
                                return password;
                            }

                            function togglePasswordVisibility() {
                                var passwordInput = document.getElementById('password');
                                var passwordIcon = document.getElementById('password-icon');

                                if (passwordInput.type === "password") {
                                    passwordInput.type = "text";
                                    passwordIcon.classList.remove("fa-eye");
                                    passwordIcon.classList.add("fa-eye-slash");
                                } else {
                                    passwordInput.type = "password";
                                    passwordIcon.classList.remove("fa-eye-slash");
                                    passwordIcon.classList.add("fa-eye");
                                }
                            }
                            </script>

                            <div class="form-group">
                                <input type="tel" name="phonenumber" placeholder="+63-933-555-3585" required
                                    class="form-control <?php echo (!empty($phonenumber_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $phonenumber; ?>">
                                <span class="invalid-feedback"><?php echo $phonenumber_err; ?></span>
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" placeholder="Address"
                                    class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $address; ?>">
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>

                            <div class="text-center pt-1 mb-5 pb-1">
                                <input type="submit" class="btn btn-outline-info btn-lg btn_form" onclick="myFunction()"
                                    value="REGISTER">
                                <br>
                                <!--   <a class="text-muted" href="reset.php">Forgot password?</a> -->
                            </div>
                        </form>
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
                <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js">
                </script>
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