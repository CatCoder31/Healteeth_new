<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $phonenumber = $address ="";
$name_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
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

    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate phone number
    if(empty(trim($_POST["phonenumber"]))){
        $phonenumber_err = "Please enter your Contact Number.";
    } else{
        $phonenumber = trim($_POST["phonenumber"]);
    }

    // Validate address
    if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your address.";
    } else{
        $address = trim($_POST["address"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($phonenumber_err) && empty($address_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO user (full_name, email_address, password, contact_number, full_address) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_password, $param_phonenumber, $param_address);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phonenumber = $phonenumber;
            $param_address = $address;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
      <title>HealTeeth</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script><script  src="./script.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <style type="text/css">
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
         .header_photo{
         width: 100%;
      }

      .vertical-center {
         }

         .p-md-5 {
    padding: 0!important;
}

         .rounded-3 {
            border:none;
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
.logo_img{
         margin-left: 5%;
         margin-top: 3%;
   width: 300px;
      max-width: 100%;
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
      </style>
   </head>
   <body>
      
   <a href="welcome.php" class="">
      <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="" >
                                </a>
         <div class="container vertical-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                     <div class="row g-0">
                        <div class="col-lg-6">
                           <div class="card-body p-md-5 mx-md-4">
                           <h2 class="signin_h2 text-center">REGISTER</h2>
                              <p class="signin_p">Register on HealTeeth for top-notch dental care and convenience.</p>
                              <br>
                              <form method="post" autocomplete="off"    id="f" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                 <div class="form-outline mb-4">
                                    <input type="text" name="name" placeholder="Full Name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                 </div>

                                 <div class="form-outline mb-4">
                                    <input type="email" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>

                                    
                                 </div>


                                 <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                    <div class="btn_change field-icon">
                <button class="btn_change" onclick="change(); return false;">
                    <i class="fa-solid fa-eye" style="color: #65cad7;" aria-hidden="true"></i>
                </button>
            </div>   
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-outline mb-4">
                                    <input type="password" name="confirm_password" id="cfpassword" placeholder="Confirm Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                    
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                 </div>
                                 

                                 <div class="form-outline mb-4">
                                    <input type="tel" name="phonenumber" placeholder="+63-933-555-3585"  required class="form-control <?php echo (!empty($phonenumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phonenumber; ?>">
                                    <span class="invalid-feedback"><?php echo $phonenumber_err; ?></span>
                                 </div>



                                 <div class="form-outline mb-4">
                                    <input type="text" name="address" placeholder="Address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                                    <span class="invalid-feedback"><?php echo $address_err; ?></span>
                                    <div class="col-md-12 signin_p">
                                       <br>
                                       <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2 register_p">Already have an account?</p>
                                    <a href="login.php" class="register_link_btn">Sign In</a>
                                 </div>
                                    <input type="checkbox" required> Accept <a type="button" href="" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;">Terms and Conditions</a>
                                 </div>  
                                 
                                 </div>
                                 
                               
                                 <div class="text-center pt-1 mb-5 pb-1">
                                    <input type="submit" class="btn btn-outline-info btn-lg btn_form"  onclick="myFunction()" value="REGISTER">
                                    <br>
                                 <!--   <a class="text-muted" href="reset.php">Forgot password?</a> -->
                                 
                                 </div>

                                
                                
                                 
                              </form>
                           </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2" >
                        <img  class=" header_photo" src="assets/image/container_head_photo.png" alt="">
                           <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>


      <!-- Modal for TERMS AND AGREEMENT -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Agreement</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p style="text-align: justify;"><b>Healteeth Dental Clinic</b> respects the privacy of the users. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website <b>Healteeth Dental Clinic</b>. Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.</p>
            <p style="text-align: justify;">We reserve the right to make changes to this Privacy Policy at any time and for any reason. We will alert you about any changes by updating the "Last Updated" date of this Privacy Policy on the Site. and you waive the right to receieve specific notice of each such change or modification.</p>
            <p style="text-align: justify;">You are encouraged to periodically review this Privacy Policy to stay informed of updates. You will be deemed to have been made aware of, will be subject to, and will be deemed to have accepted the changes in any revised Privacy Policy by your continued use of the Site after the date such revised Privacy Policy is posted.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<script>
 var form = document.getElementById('f');

function myFunction() {
  if (form.checkValidity()) {
    alert("Account Created Successfully!");
  }
}
      </script>
</script>   
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

</html>