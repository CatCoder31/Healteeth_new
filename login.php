<?php
// Initialize the session

// Check if the user is already logged in, if yes then redirect him to the welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email_address = $password = "";
$email_err = $password_err = "";

// Processing form data when the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email_address, password, email_verified, username, full_name, role FROM user WHERE email_address = ?";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if email exists, if yes then verify password and email verification status
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email_address, $hashed_password, $is_email_verified, $username, $full_name, $role);

                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            if($is_email_verified == 1){
                                // Password is correct and email is verified, so start a new session
                                session_start();

                                // Retrieve the profile photo from the database
                                $sql_profile_photo = "SELECT profile_photo FROM user WHERE id = ?";
                                $stmt_profile_photo = mysqli_prepare($con, $sql_profile_photo);
                                mysqli_stmt_bind_param($stmt_profile_photo, "i", $id);
                                mysqli_stmt_execute($stmt_profile_photo);
                                mysqli_stmt_bind_result($stmt_profile_photo, $profile_photo);
                                mysqli_stmt_fetch($stmt_profile_photo);
                                mysqli_stmt_close($stmt_profile_photo);

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["email_address"] = $email_address;
                                $_SESSION["full_name"] = $full_name;
                                $_SESSION["role"] = $role;
                                $_SESSION["profile_photo"] = $profile_photo;

                                // Redirect user to the appropriate page based on role
                                if($role == 'Patient') {
                                    header("location: welcome.php");
                                } elseif($role == 'Doctor') {
                                    header("location: doctor_index.php");
                                } elseif($role == 'Staff') {
                                    header("location: staff_index.php");
                                }
                                exit;
                            } else {
                                // Email is not verified, display an error message
                                $email_err = "Email is not verified yet. Please check your email for verification instructions.";
                            }
                        } else{
                            // Password is not valid, display an error message
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else{
                    // Email doesn't exist, display an error message
                    $email_err = "No account found with that email.";
                }
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
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login | HealTeeth</title>
<link rel="icon" type="image/x-icon" href="assets/healteeth.ico">
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script><script  src="./script.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      
   </head>
      <style type="text/css">
         html{
            overflow-x:hidden;
            overflow-y:hidden;
         }
         @media (min-width: 768px) {
         .navbar-brand.abs
         {
         position: absolute;
         width: auto;
         left: 50%;
         transform: translateX(-50%);
         text-align: center;
         }
         }
         .custom {
         display: inline-block;
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: -70px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
                 /* width */
::-webkit-scrollbar {
        width: 5px;
      }
      
      /* Track */
      ::-webkit-scrollbar-track {
        border-radius: 10px;
      }
       
      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #4052a4; 
        border-radius: 10px;
      }
      
      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #65cad7; 
      }
         .custom1 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: -35px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom2 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: -5px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom3 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 30px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom4 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 300px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom1:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom2:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom3:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom4:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }

         .vertical-center {
            border:none;
         margin-top: 4%;
         margin-bottom: 10%;
         }

         .rounded-3 {
            border:none;
         }


         .header_photo{
         width: 100%;
      }
      .logo_img{
         margin-left: 5%;
         margin-top: 3%;
   width: 300px;
      max-width: 100%;
}

.signin_h2 {
  text-align: center;
  font-weight:bold;
         font-size:4rem;
         color: #4052a4;
         font-family: 'Montserrat';
  position: relative;
}

.signin_p{
  text-align: center;
  font-weight:light;
         font-size:1rem;
         color: #4052a4;
         font-family: 'Montserrat';
  position: relative;
}

.field-icon {
  float: right;
  margin-right: 10px;
  margin-top: -33px;
  position: relative;
  z-index: 2;
   font-size: 1em;
}
.btn_change{
  border:none;
  background-color: transparent;
    background-repeat: no-repeat;
}
.form-group {
  padding: 30px 0;
  background-color: #006dcc;
}
.form-control{
   border-radius: 30px;
   padding-right:5%;
   padding-left:5%;
   padding-top:2%;
   padding-bottom:2%;
   background-color: white !important;
         font-family: 'Montserrat';
         color: #4052a4;
}

.fa-eye{
   font-size: 1em;
}

.btn_form{
   padding-right:20%;
   padding-left:20%;
   border-radius: 30px;
}

.btn_form:hover{
   color: white;
}

.register_p{
         font-family: 'Montserrat';
         color: #4052a4;
         font-weight: light;
}
.register_link_btn{
         font-family: 'Montserrat';
         color: #65cad7;
         transition: 0.2s;
         font-weight: bold;
         text-decoration: none;
}

@media (max-width: 1000px){
   .logo_img{
   width: 300px;
      max-width: 50%;
}
   .header_photo {
    width: 100%;
    display: none;
}
}



        .center-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .register_link_btn {
            font-family: 'Montserrat';
            color: #65cad7;
            transition: 0.2s;
            font-weight: bold;
            text-decoration: none;
        }

       

        .back-2signin {
            padding-top: 10px;
        }

     

        .modal-body {
            padding: 10%;
        }

        .modal-content {
            border-radius: 60px;
        }

         .resetButton {
            width: 100%;
            border-radius: 50px;
        }
      </style>
   <body>
     <!-- <nav class="navbar navbar-white bg-white flex-nowrap">
         &nbsp&nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Facebook.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Twitter.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Telegram.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
         <div class="container-fluid nav justify-content-center">
            <ul class="nav">
               <li class="nav-item">
                  <img src="assets/image/Location.png" alt="" width="60" height="60">
               </li>
               &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
               <li class="nav-item">
                  <img src="assets/image/Time.png" alt="" width="60" height="60">
               </li>
               &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
               <li class="nav-item">
                  <img src="assets/image/Email.png" alt="" width="60" height="60">
               </li>
            </ul>
         </div>
         <div class="w-100">
           
         </div>
      </nav> -->

      
      <a href="index.php" class="">
      <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
                                </a>
         <div class="container vertical-center">
            
            <div class=" d-flex justify-content-center align-items-center h-100">
               <div class="col-xl-12">
                  <div class="card rounded-3 text-black">
                     <div class="row g-0">
                        <div class="col-lg-6">
                           <div class="card-body p-md-5 mx-md-4">
                              <div class="text-left">
                                <h2 class="signin_h2 text-center">SIGN IN</h2>
                                <p class="signin_p text-center">Sign in to your Account</p>
                                 <br>
                                 <?php 
                                    if(!empty($login_err)){
                                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                    }        
                                    ?>
                              </div>
                             
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-row">
                                 <div class="form-outline mb-4">
                                    <input type="email"  name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email_address; ?>">
                                    <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                              <div class="modal-body">
                                                <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
                                                <br><br>
                                                <p class="signin_p text-center"><?php echo $email_err; ?></p>
                                                  <button type="button" class="btn btn-outline-info btn-lg resetButton" id="closeModalBtn">Done</button>
                                             </div>
                                            
                                       </div>
                                    </div>
                                 </div>
                                 </div>
                                 <div class="form-outline mb-4" >
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                    <div class="btn_change field-icon">
                                 <button class="btn_change" onclick="change(); return false;">
                                    <i class="fa-solid fa-eye" style="color: #65cad7;" aria-hidden="true"></i>
                                 </button>
                           </div>   
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                 </div>
                                 <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2 register_p">Don't have an account?</p>
                                    <a href="register.php" class="register_link_btn">Register</a>
                                 </div>
                                 <div class="text-center pt-1 mb-5 pb-1">
                                    <input type="submit" class="btn btn-outline-info btn-lg btn_form" value="SIGN IN">
                                    <br>  <br>     
                                    <a href="forgot-password.php" class="register_p">Forgot Password?</a>
                                    <br>
                                 <!--   <a class="text-muted" href="reset.php">Forgot password?</a> -->
                                 </div>
                                

                                <!-- <div align="center">
                                    <a href="welcome.php" class="btn btn-dark">Back to Home</a>
                                 </div> -->
                              </form>
                              
                           </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style="">
                        <img  class=" header_photo" src="assets/image/container_head_photo.png" alt="">
                           <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </body>
 
   <script>
 function change() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }   
   </script>


<script>
    // JavaScript to show the modal when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (!empty($email_err)): ?>
            // Check if the email error is not empty
            $('#verificationModal').modal('show');
        <?php endif; ?>
    });

    // JavaScript to dismiss the modal when the close button is clicked
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('closeModalBtn').addEventListener('click', function () {
            $('#verificationModal').modal('hide');
        });
    });
</script>

</html>