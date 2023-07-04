<?php
   include 'config2.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: index.php");
      exit;
   }
   $id = $_SESSION['id'];
   $result = mysqli_query($con, "SELECT * FROM user where id = $id");
   while($row = mysqli_fetch_array($result)){
      $full_name = $row['full_name'];
      $email_address = $row['email_address'];
      $contact_number = $row['contact_number'];
      $full_address = $row['full_address'];
      $birth_date = $row['birth_date'];
      $gender = $row['gender'];
      $medical_history = $row['medical_history'];
      $language = $row['language'];
      $emergency_contact = $row['emergency_contact'];
      $comments_and_questions = $row['comments_and_questions'];
      $password = $row['password'];
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>User Profile</title>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script><script  src="./script.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/nav.css">
   </head>
   <style>
      @media all and (max-width: 1320px) {
      .header_text{
      font-family: 'Montserrat';
      padding-left: 10%;
      }
      .header_h1{
      font-weight:bold;
      font-size:1rem;
      color: #4052a4;
      }
      .header_p{
      font-size:.5rem;
      color: #4052a4;
      }
      .header_column_photo{
      display: none;
      }
      .col-lg-6 {
      flex: 0 0 auto;
      width: 100%;
      }
      .offset-md-2 {
      display: none;
      }
      }
      html{
      font-family: 'Montserrat', sans-serif;
      overflow-x: hidden;
      }
      .header_photo{
      width: 90%;
      }
      .header_text{
      padding-top: 20%;
      padding-bottom: 20%;
      padding-left: 13%;
      font-family: 'Montserrat';
      }
      .header_h1{
      font-weight:bold;
      font-size:5rem;
      color: #4052a4;
      }
      .header_p{
      font-size:1.2rem;
      line-height: 2.5;
      color: #4052a4;
      }
      .btn-outline-primary,
      .btn-outline-info{
      border-radius: 30px;
      }
      .appointment_btn,
      .about_btn{
      margin-top: 2%;
      }
      .container_service{
      padding-top:7%;
      padding-bottom:4%;
      }
      .services_h2 {
      text-align: center;
      padding-top: 6%;
      font-weight:bold;
      font-size:4rem;
      color: #4052a4;
      font-family: 'Montserrat';
      position: relative;
      }
      .contact_h2 {
      text-align: center;
      padding-top: 6%;
      font-weight:bold;
      font-size:4rem;
      color: #4052a4;
      font-family: 'Montserrat';
      position: relative;
      }
      .services_p {
      text-align: center;
      margin-bottom: 60px;
      font-weight:light;
      font-size:1.5rem;
      color: #4052a4;
      font-family: 'Montserrat';
      position: relative;
      }
      .services_h2::after {
      content: "";
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 5px;
      background-color: #e85d75;
      border-radius: 20px;
      }
      .service_card_img{
      width: 35%;
      margin: auto;
      border-radius: 50%;
      }
      .service_row{
      margin: 0 auto; /* Added */
      float: none; /* Added */
      margin-bottom: 10px; /* Added */
      display: flex;
      }
      .card{
      padding-top:7%;
      border:none;
      }
      .service_cards{
      margin: auto;
      transition: transform .2s;
      top: 0;
      }
      .col-md-2 {
      height: 15rem;
      }
      .card_service{
      width: 120%;
      height: 100%;
      }
      .service_cards:hover{
      transform: scale(1.1);
      }
      .card:hover{
      background-color: #65cad7;
      }
      @media all and (max-width: 775px) {
      .service_cards{
      margin: auto;
      top: 0;
      }
      .card_service{
      width: 70%;
      margin-bottom: 5%;
      }
      }
      .card-title,
      .card-text{
      text-align: center;
      color: #4052a4;
      }
      .card-title{
      font-weight:bold;
      font-size:1.2rem;
      color: #4052a4;
      font-family: 'Montserrat';
      }
      .card-text{
      font-weight:light;
      font-size:1rem;
      color: #4052a4;
      font-family: 'Montserrat';
      }
      .why_us{
      padding-top:5%;
      color: #4052a4;
      font-family: 'Montserrat';
      }
      .contact{
      padding-bottom:4%;
      color: #4052a4;
      font-family: 'Montserrat';
      }
      .why_us_h3{
      font-weight:900;
      font-size:2.8rem;
      color: #4052a4;
      text-align: center;
      }
      .contact_us_title{
      font-weight:900;
      font-size:2rem;
      color: #4052a4;
      }
      .why_us_title{
      font-weight:bold;
      font-size:1.5rem;
      color: #4052a4;
      }
      .contact_us_p{
      font-weight:light;
      font-size:1rem;   
      color: #4052a4;
      }
      .why_us_p{
      font-weight:light;
      font-size:1rem;
      color: #4052a4;
      }
      .contact_us_btn{
      margin-top: 3%;
      padding-right:3%;
      padding-left:3%;
      }
      .logo_img{
      width: 180px;
      max-width: 100%;
      }
      . footer{
      color:white;
      font-family: 'Montserrat';
      }
      .icon{
      transition: transform .1s;
      color: white;
      font-size: 1.5em;
      }
      .icon:hover{
      transform: scale(1.5);
      color: #4052a4;
      }
      .about_btn:hover{
      color: white;
      }
      .row_1{
      margin: 1%;
      margin-right: 5%;
      text-align:right;
      }
      .row_2{
      background-color:#97dae3;
      border-radius: 10px;
      margin: 5%;
      }
      .story_photo{
      padding: 5%;
      width: 90%
      }
      .row_3{
      padding-top: 3%;
      margin: 1%;
      margin-right: 5%;
      text-align:right;
      }
      .row_4{   
      padding-top: 3%;
      margin: 1%;
      margin-right: 5%;
      }
      .form-control{
      border-radius: 30px;
      background-color: white !important;
      font-family: 'Montserrat';
      color: #4052a4;
      height: 50px !important;
      }
      .form-row{
      padding-top: 2%;
      }
      .why_us_h2{
      font-weight:900;
      font-size:2rem;
      color: #4052a4;
      text-align: left; 
      }
      .appointment_container{
      margin-top: 4%;
      margin-left: 2%;
      margin-right: 2%;
      }
      .appointment_button{
      font-size: 1.8rem;
      }
      .appointment_button:hover{
      color:white;
      }
      .appointment_button_container{
      margin-top: 3%;
      width: 30%;
      }
      .field-icon {
      float: right;
      margin-right: 10px;
      margin-top: -38px;
      position: relative;
      z-index: 2;
      font-size: 1em;
      }
      .btn_change{
      border:none;
      background-color: transparent;
      background-repeat: no-repeat;
      }
   </style>
   <body>
      <?php include 'nav_patient.php'; ?>
      <br>
      <h3 class="why_us_h3">Edit<span style="color: #65cad7"> Your Profile</span></h3>
      <div class="container">
         <br>
         <div class="row">
            <div class="col-lg-7 mx-auto">
               <div class="container">
                  <!-- First Form: Personal Information -->
                  <form method="post" action="update-user.php" enctype="multipart/form-data">
                     <div class="controls">
                        <input type="hidden" name="idnum" class="form-control" value="<?php echo $id; ?>;">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_name">Name</label>
                                 <input id="form_name" type="text" name="patient_name" class="form-control" value="<?php echo $full_name; ?>" disabled required="required" data-error="Full Name is required.">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_email">Email</label>
                                 <input id="form_email" type="text" name="email" class="form-control" value="<?php echo $email_address; ?>" required="required" data-error="Valid email is required.">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_phone">Phone</label>
                                 <input id="form_phone" type="text" name="phone" class="form-control" value="<?php echo $contact_number; ?>" required="required" data-error="Phone number is required.">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_address">Address</label>
                                 <input id="form_address" type="text" name="address" class="form-control" value="<?php echo $full_address; ?>" required="required" data-error="Address is required.">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_birthdate">Birthdate</label>
                                 <input id="form_birthdate" type="date" name="birthdate" class="form-control" value="<?php echo $birth_date; ?>" required="required" data-error="Birth Date is required.">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_gender">Gender</label>
                                 <select id="form_gender" name="gender" class="form-control" required="required" data-error="Gender is required.">
                                    <option value="" disabled>Select Gender</option>
                                    <option value="Male" <?php if ($gender === 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if ($gender === 'Female') echo 'selected'; ?>>Female</option>
                                    <option value="Other" <?php if ($gender === 'Other') echo 'selected'; ?>>Other</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_language">Language</label>
                                 <select id="form_language" name="language" class="form-control" required="required" data-error="Language is required.">
                                    <option value="" disabled>Select Language</option>
                                    <option value="English" <?php if ($language === 'English') echo 'selected'; ?>>English</option>
                                    <option value="Filipino" <?php if ($language === 'Filipino') echo 'selected'; ?>>Filipino</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="form_emergency_contact">Emergency Contact</label>
                                 <input id="form_emergency_contact" type="text" name="emergency_contact" class="form-control" value="<?php echo $emergency_contact; ?>" required="required" data-error="Emergency Contact is required.">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="form_medical_history">Medical History</label>
                                 <input id="form_medical_history" type="text" name="medical_history" class="form-control" value="<?php echo $medical_history;?>" required="required" data-error="Medical History is required.">
                              </div>
                           </div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto appointment_button_container">
                           <input type="submit" class="btn btn-outline-info btn-lg btn-send pt-2 btn-block" value="Submit" name="action">
                        </div>
                     </div>
                  </form>
                  <!-- Second Form: Password -->
                  <form method="post" action="update-user.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                     <div class="controls">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="password">Password</label>
                                 <input id="password" type="password" name="password" class="form-control" value="" required="required" data-error="Password is required.">
                                 <input id="password" type="hidden" name="idnum" class="form-control" value="<?php echo $id; ?>;" data-error="Password is required.">
                                 <div class="btn_change field-icon">
                                    <button class="btn_change" onclick="change(); return false;">
                                    <i class="fa-solid fa-eye" style="color: #65cad7;" aria-hidden="true"></i>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="confirm_password">Confirm Password</label>
                                 <input id="confirm_password" type="password" name="confirm_password" class="form-control" value="" required="required" data-error="Please confirm your password.">
                              </div>
                           </div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto appointment_button_container">
                           <input type="submit" class="btn btn-outline-info btn-lg btn-send pt-2 btn-block" value="Update Password" name="action">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- /.row-->
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
</html>
<!-- ================================================
   Scripts
   ================================================ -->
<script>
   function validateForm() {
     var password = document.getElementById("password").value;
     var confirmPassword = document.getElementById("confirm_password").value;
     
     if (password !== confirmPassword) {
       alert("Passwords do not match.");
       return false;
     }
     
     return true;
   }
</script>
<!-- jQuery Library -->
<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script> <!--angularjs-->
<script type="text/javascript" src="js/plugins/angular.min.js"></script> <!--scrollbar-->
<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script> 
<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script> <!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="js/plugins.min.js"></script> <!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="js/custom-script.js"></script>