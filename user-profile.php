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
   $username = $row['username'];
   $role = $row['role'];
   $email_address = $row['email_address'];
   $contact_number = $row['contact_number'];
   $full_address = $row['full_address'];
   $profile_photo = $row['profile_photo'];
   $gender = $row['gender'];
   $birthdate = $row['birthdate'];
   $emergency_contact_name = $row['emergency_contact_name'];
   $emergency_contact_number = $row['emergency_contact_number'];
   $password = $row['password'];
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Profile Page | HealTeeth</title>
      <link rel="icon" type="image/x-icon" href="assets/healteeth.ico">
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
      <script src="https://cdn.tiny.cloud/1/rgyue8swxwwe1559xj0onuitwrzr6nxyc6dtnb4kcgrsjkti/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
      font-weight:600;
      font-size:2.5rem;
      color: #4052a4;
      text-align: left;
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
      .box {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 20px 0;
      padding: 5%;
      width: 100%;
      min-height: 200px;
      border-radius: 20px;
      color: #fff;
      }
      .box2 {
      align-items: center;
      justify-content: center;
      margin: 20px 0;
      width: 100%;
      color: #fff;
      }
      .box3 {
      align-items: center;
      justify-content: center;
      margin: 20px 0;
      width: 100%;
      border-radius: 20px;
      color: #fff;
      }
      /* .box {
      align-items: center;
      justify-content: center;
      background: #aaa;
      margin: 20px 0;
      width: 100%;
      border: 2px #ccc solid;
      color: #fff;
      } */
      .button-container {
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      }
      .btn{
      width: 100%;
      }
      .profile-image{
      width: 90%; /* Make the image fill the container horizontally */
      height: 150px; /* Maintain the image's aspect ratio */
      object-fit: cover; /* Ensure the image covers the container without distortion */
      border: 4px #4052a4 solid;
      }
      .medical-record-wrapper{
      padding:3%;
      }
      .profile-label{
      font-weight: 600;
      font-family: 'Montserrat';
      font-size:1rem;
      color: #4264ad;
      }
      .profile-info{
      font-weight: 400;
      font-family: 'Montserrat';
      font-size:1rem;
      color: #4264ad;
      }
      .name,
      .role,
      .address{
      font-weight: 500;
      font-family: 'Montserrat';
      font-size:1rem;
      color: #4264ad;
      }
      .name{
      padding: 0;
      margin-bottom: 5%;
      font-weight: 800;
      font-size: 1.5rem;
      color:#65cad7;
      }
      .role{
      font-size: 1.3rem;
      color: #4052a4;
      }
      .address{
      font-size: 1rem;
      color: #aaaaaa;
      font-weight: 500;
      }
      .info-wrapper{
      margin-top: 10%;
      }
      .role,
      .address{
      padding: 0;
      margin: 0;
      }
      @media (max-width:590px) {
      .button-container {
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      }
      .profile-image-container{
      display:flex;
      justify-content: center;
      }
      .profile-image{
      width:40%
      }
      .name{
      padding: 0;
      margin-bottom: 0;
      }
      .info-wrapper{
      margin-top: 0;
      }
      .name,
      .role,
      .address{
      margin-bottom: 5%;
      }
      }
      .register_p {
      font-family: 'Montserrat';
      color: #4052a4;
      font-weight: light;
      }
      .password-input{
      margin-top:5%;
      }
      .modal-content{
      padding: 5%;
      border-radius: 50px;
      }
      .btn-container{
      justify-content:center;
      width: 47%;
      }
      .btn-update{
      width:100%;
      border-radius:50px;
      }
      .close-modal{
      display:none;
      }
      .modal-img{
      justify-content:center;
      margin
      }
      .medical-record-btn{
      margin-top: 2%;
      }
      .editor-container {
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid #0dcaf0;
      }
      .editor-container textarea {
      resize: both;
      overflow: hidden;
      }
      .update-pass-btn{
      margin-top:5%;
      }
      .btn-1{
      margin-top:10%;
      }
   </style>
   <body>
      <?php include'nav_patient.php';?>
      <br>
      <div class="container">
         <h3 class="why_us_h3">Hi!<span style="color: #65cad7"> <b><?php echo $full_name; ?></b></span></h3>
         <div class="row">
            <div class="col-xs-12 col-sm-6">
               <div class="box">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="box2 profile-image-container">
                           <img class="rounded-circle shadow-4-strong profile-image form-control-file" id="exampleFormControlFile1" alt="avatar2" src="<?php echo $profile_photo;?>" />
                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="box2">
                           <p class="name"><?php echo $full_name; ?></P>
                           <div class="info-wrapper">
                              <p class="role"><?php echo $role; ?></P>
                              <p class="address"><?php echo $full_address; ?></P>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="box2">
                           <div class="row">
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">email</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo $email_address; ?></P>
                                 </div>
                              </div>
                              <!---->
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">number</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo $contact_number; ?></P>
                                 </div>
                              </div>
                              <!---->
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">gender</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo $gender; ?></P>
                                 </div>
                              </div>
                              <!---->
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">Emergency Contact</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo $emergency_contact_name; ?></P>
                                 </div>
                              </div>
                              <!---->
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">Emergency Contact Number</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo $emergency_contact_number; ?></P>
                                 </div>
                              </div>
                              <!---->
                              <!---->
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-label">Birthday</P>
                                 </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                 <div class="">
                                    <p class="profile-info"><?php echo date("F j, Y",strtotime($birthdate)); ?></P>
                                 </div>
                              </div>
                              <!---->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-sm-6">
               <div class="box3 medical-record-wrapper">
                  <!-- 
                     <h3 class="why_us_h3">Update <span style="color: #65cad7"> <b>Medical Record</b></span></h3>
                      <p class="profile-info">Update your medical record such as recent procedures done to you, allergies.</P>
                     
                      <form action="" id="medicalRecorForm">
                     <div class="editor-container">
                     <input type="hidden" name="user_id" id="user_id" value="<?php echo $id = $_SESSION['id']; ?>">
                     <textarea id="'medical_record"></textarea>
                     </div> -->
                  <button type="button" class="btn btn-outline-info btn-lg resetButton btn-1"data-toggle="modal" data-target="#updateModal">Update Profile</button>
                  <br>
                  <button type="button" class="btn btn-outline-info btn-lg resetButton btn-1" data-toggle="modal" data-target="#passwordModal">Change Password</button>
                  <!-- </form> -->
               </div>
               <!-- <div class="button-container row justify-content-center text-center">
                  <div class="col-md-12 btn-container text-center">
                      <button type="button" class="btn btn-outline-info btn-lg resetButton"data-toggle="modal" data-target="#updateModal">Update Profile</button>
                  </div>
                  <div class="col-md-12 btn-container text-center">
                     <button type="button" class="btn btn-outline-info btn-lg resetButton" data-toggle="modal" data-target="#passwordModal">Change Password</button>
                  </div> -->
            </div>
         </div>
         <!--container-->
         <!-- Add this HTML code where you want the success modal to appear -->
         <div id="medicalRecordModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-body">
                     <h4>Success!</h4>
                     <p>Medical record inserted successfully.</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- Bootstrap Modal -->
         <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-body text-center">
                     <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
                     <form id="passwordForm" method="POST">
                        <h3 class="why_us_h3 text-center">Change<span style="color: #65cad7"> <b>Password</b></span></h3>
                        <p class="profile-info">Enter your current password to update your password. Changing you password will log you out.</p>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $id = $_SESSION['id']; ?>">
                        <div>
                           <input type="password" class="form-control password-input" id="current_password" placeholder="Current Password" name="current_password" required>
                        </div>
                        <div>
                           <input type="password" class="form-control password-input" id="new_password" placeholder="New Password" name="new_password" required>
                        </div>
                        <div>
                           <input type="password" class="form-control password-input" id="confirm_password" placeholder="Confirm New Password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-outline-info btn-lg resetButton update-pass-btn">Update Password</button><br><br>
                        <a href="forgot-password.php" class="register_p">Forgot Password?</a>
                     </form>
                     <div id="passwordMessage"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Update Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
               <div class="d-flex justify-content-center">
                  <img src="assets/image/Healteeth Logo.png" class="img-fluid logo_img" alt="Centered Image">
               </div>
               <br>
               <h3 class="why_us_h3 text-center">Update Your<span style="color: #65cad7"> <b> Information</b></span></h3>
               <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
               <div class="modal-body">
                  <form action="" id="updateForm" method="POST" enctype="multipart/form-data">
                     <input type="hidden" name="user_id" id="user_id" value="<?php echo $id = $_SESSION['id']; ?>">
                     <!---->
                     <div class="form-group">
                        <div class="row">
                           <div class="col">
                              <input type="text" class="form-control" placeholder="Update Name" name="f_name" value="<?php echo $full_name; ?>" disabled>
                              <input type="hidden" class="form-control" placeholder="Update Name" name="full_name" value="<?php echo $full_name; ?>">
                           </div>
                           <div class="col">
                              <input type="email" class="form-control" name="email_address" placeholder="Update Email"  value="<?php echo $email_address; ?>">
                           </div>
                        </div>
                     </div>
                     <!---->
                     <!---->
                     <div class="form-group">
                        <div class="row">
                           <div class="col">
                              <input type="text" class="form-control" name="contact_number"  placeholder="Update Contact Number" value="<?php echo $contact_number; ?>">
                           </div>
                           <div class="col">
                              <input type="text" class="form-control" name="username" placeholder="Update Username" value="<?php echo $username; ?>">
                           </div>
                        </div>
                     </div>
                     <!---->
                     <div class="form-group">
                        <input type="text" class="form-control" name="full_address" placeholder="Update Address" value="<?php echo $full_address; ?>">
                     </div>
                     <!---->
                     <div class="form-group">
                        <div class="row">
                           <div class="col">
                              <input type="text" class="form-control" name="emergency_contact_name" placeholder="Update Emergency Contact Name" value="<?php echo $emergency_contact_name; ?>">
                           </div>
                           <div class="col">
                              <input type="text" class="form-control" name="emergency_contact_number" placeholder="Update Emergency Contact Number" value="<?php echo $emergency_contact_number; ?>">
                           </div>
                        </div>
                     </div>
                     <!---->
                     <!---->
                     <div class="form-group">
                        <div class="row">
                           <div class="col">
                              <label for="gender">Gender:</label>
                              <div>
                                 <input type="radio" name="gender" value="Male" <?php if ($gender === 'Male') echo 'checked'; ?>> Male
                                 <input type="radio" name="gender" value="Female" <?php if ($gender === 'Female') echo 'checked'; ?>> Female
                                 <input type="radio" name="gender" value="Other" <?php if ($gender === 'Other') echo 'checked'; ?>> Other
                              </div>
                           </div>
                           <div class="col">
                              <input type="date" class="form-control" name="birthdate" value="<?php echo $birthdate; ?>">
                           </div>
                        </div>
                     </div>
                     <!---->
                     <!---->
                     <div class="form-group">
                     </div>
                     <div class="col">
                        <label for="profile_photo">Profile Photo:</label>
                        <input type="file" class="form-control-file" name="profile_photo">
                     </div>
               </div>
               <!---->
               <div class="row justify-content-center text-center">
               <div class="col-md-6 btn-container text-center">
               <button type="button" class="btn btn-outline-dark btn-lg btn-update" data-dismiss="modal">Cancel Update Information</button>
               </div>
               <div class="col-md-6 btn-container text-center">
               <button type="submit" class="btn btn-outline-info btn-lg btn-update" id="updateButton">Update Information</button>
               </div>
               </div>
               </form>
            </div>
         </div>
      </div>
      </div>
      <script>
         $(document).ready(function() {
           // Handle form submission using AJAX
           $('#medicalRecorForm').submit(function(event) {
             event.preventDefault(); // Prevent the form from submitting normally
             
             // Get the form data
             var formData = $(this).serialize();
             
             // Submit the form data using AJAX
             $.ajax({
               url: 'medical_record_insert.php', // Replace with the actual PHP script URL
               type: 'POST',
               data: formData,
               dataType: 'json',
               success: function(response) {
                 // Show the success modal
                 $('#medicalRecordModal').modal('show');
               },
               error: function(xhr, status, error) {
                 // Handle any errors and display an error message if necessary
                 console.log(xhr.responseText);
               }
             });
           });
         });
      </script>
      <!-- JavaScript code to handle the modal and form submission -->
      <script>
         // Get the modal element
         var modal = document.getElementById("passwordModal");
         
         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close")[0];
         
         // When the user clicks the button, open the modal
         function openModal() {
           modal.style.display = "block";
         }
         
         // When the user clicks on <span> (x), close the modal
         span.onclick = function() {
           modal.style.display = "none";
         };
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
           if (event.target == modal) {
             modal.style.display = "none";
           }
         };
         
         // Handle form submission
         document.getElementById("passwordForm").addEventListener("submit", function(event) {
           event.preventDefault(); // Prevent form submission
         
           // Retrieve form inputs
           var currentPassword = document.getElementById("current_password").value;
           var newPassword = document.getElementById("new_password").value;
           var confirmPassword = document.getElementById("confirm_password").value;
           var userId = document.getElementById("user_id").value;
         
           // Make an AJAX request to validate the current password and update the password
           var xhr = new XMLHttpRequest();
           xhr.open("POST", "update_password.php", true);
           xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           xhr.onreadystatechange = function() {
             if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
               var response = JSON.parse(xhr.responseText);
               document.getElementById("passwordMessage").innerHTML = response.message;
               if (response.status === "success") {
                 // Password updated successfully
                 setTimeout(function() {
                   window.location.href = "index.php";
                    }, 200);
                 document.getElementById("#passwordForm").reset();
         
                 // Close the modal
                 modal.style.display = "none";
               }
             }
           };
           xhr.send("current_password=" + encodeURIComponent(currentPassword) + "&new_password=" + encodeURIComponent(newPassword) + "&confirm_password=" + encodeURIComponent(confirmPassword) + "&user_id=" + encodeURIComponent(userId));
         });
      </script>
   </body>
   <script>
      $(document).ready(function() {
      // Listen for form submission
      $("#updateForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
      
        // Get form data
        var formData = new FormData(this);
      
        // Send AJAX request
        $.ajax({
            url: 'update_profile.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Parse the JSON response
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    // Display success message
                    //$("#successModal2").modal("show");
                 setTimeout(function() {
                  location.reload();
                    
                  }, 200);
                    // Perform any additional actions on success
                } else {
                    // Display error message
                    alert(result.message);
                    // Perform any additional actions on error
                }
            },
            error: function() {
                // Display error message
                alert('Oops! Something went wrong. Please try again later.');
                // Perform any additional error handling
            }
        });
      });
      });
      
   </script>
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
   <<script>
      tinymce.init({
        selector: '#'medical_record',
        height: 300,
        resize: false,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help',
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tiny.cloud/css/codepen.min.css'
        ],
        formats: {
          customFormat: {
            block: 'div',
            classes: 'custom-format',
            attributes: {
               style: 'border: 1px solid #ccc; padding: 10px; border-radius: 10px;'
            }
          }
        },
        style_formats: [
          {
            title: 'Custom Format',
            format: 'customFormat'
          }
        ]
      });
      
      function saveContent() {
        var content = tinymce.get(''medical_record').getContent();
        // Do something with the content, like saving it to a database
        console.log(content);
      }
   </script>
</html>
<!-- ================================================
   Scripts
   ================================================ -->
<!-- jQuery Library -->
<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script> <!--angularjs-->
<script type="text/javascript" src="js/plugins/angular.min.js"></script> <!--scrollbar-->
<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script> 
<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script> <!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="js/plugins.min.js"></script> <!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="js/custom-script.js"></script> 
<script>
   $( "select[name='categorypick']" ).change(function () {
   var categoryID = $(this).val();
   
   
   if(categoryID) {
   
   
     $.ajax({
         url: "ajaxData.php",
         dataType: 'Json',
         data: {'category_id':categoryID},
         success: function(data) {
             $('select[name="servicepick"]').empty();
             $.each(data, function(key, value) {
                 $('select[name="servicepick"]').append('<option value="'+ key +'">'+ value +'<\/option>');
             });
         }
     });
   
   
   }else{
     $('select[name="service"]').empty();
   }
   });
</script>