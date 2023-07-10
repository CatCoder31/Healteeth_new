<?php
   session_start();
   include 'config.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   
   date_default_timezone_set('Asia/Manila');
   $date_today = date('Y-m-d');
   $full_name = $_SESSION['full_name'];
   $id = $_SESSION['id'];
   
   if(isset($_POST['submit'])){
      $patient_name     = $_POST['patient_name'];
      $email            = $_POST['email'];
      $phone            = $_POST['phone'];
      $address          = $_POST['address'];
      $categorypick     = $_POST['categorypick'];
      $servicepick      = $_POST['servicepick'];
      // $appointment_time = $_POST['appointment_time'];
      $doctor_id         = $_POST['doctorId'];
      $schedule      = $_POST['schedule']; 
      
      $query = "SELECT *
      FROM schedule 
      WHERE date_sched = CURRENT_DATE AND doctor_id = '$doctor_id'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $date_sched = $row['date_sched'];
      $time_sched_start = strtotime($row['time_sched_start']);
      $time_sched_end = strtotime($row['time_sched_end']);
      $breaktime_start = strtotime($row['breaktime_start']);
      $breaktime_end = strtotime($row['breaktime_end']);
      
      $query = "SELECT *
            FROM services 
            WHERE service_id = '$servicepick'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_assoc($result);
      $service_duration = $row['service_duration']; 
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Book an Appointment| HealTeeth</title>
<link rel="icon" type="image/x-icon" href="assets/healteeth.ico">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&amp;display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/nav.css">
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
         .text-center{
         text-align: center;
         font-family: 'Montserrat';
         font-weight:700;
         font-size: 1rem;
         color: #4052a4;
         position: relative;
         padding-bottom: 10px;
         padding-bottom: 20px;
         }
         .text-center2{
         text-align: center;
         font-family: 'Montserrat';
         font-weight: bold;
         font-size: 2rem;
         color: #4052a4;
         position: relative;
         padding-bottom: 10px;
         padding-bottom: 20px;
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
         .logo_img_modal {
         display: block;
         margin-left: auto;
         margin-right: auto;
         width: 35%;
         }
      </style>
   </head>
   <body>
      <?php include'nav_patient.php'; ?><br>
      <?php
         $sql = "SELECT * FROM user WHERE id = ".$_SESSION['id'];; 
         $result = $con->query($sql);
         while($row = $result->fetch_assoc()){
         ?>
      <h3 class="why_us_h3">Book an <span style="color: #65cad7">Appointment</span></h3>
      <div class="row appointment_container">
         <div class="col-lg-10 mx-auto">
            <form method="post" enctype="multipart/form-data" action="appointment-book-process.php" id="appointment-form">
               <div class="controls">
                  <h2 class="why_us_h2">Enter your Personal Information</h2>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <input id="form_name" type="text" name="patient_name" class="form-control" placeholder="Name" required="required" data-error="Full Name is required." value="<?php echo $row['full_name']; ?>" readonly>
                     </div>
                     <div class="form-group col-md-6">
                        <input id="form_email" type="email" name="email" class="form-control" placeholder="name@example.com" required="required" data-error="Valid Email is required." value="<?php echo $row['email_address']; ?>" readonly>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <input id="form_name" type="text" name="phone" class="form-control" placeholder="+63459440436" required="required" data-error="Contact Number is required." value="<?php echo $row['contact_number']; ?>">
                     </div>
                     <div class="form-group col-md-6">
                        <input id="form_name" type="text" name="address" class="form-control" placeholder="Makati" required="required" data-error="Address is required." value="<?php echo $row['full_address']; ?>">
                     </div>
                  </div>
                  <?php }?>
                  <h2 class="why_us_h2">Select the Service that you need</h2>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <select name="categorypick" class="form-control" required="">
                           <option value="">Select Category</option>
                           <?php
                              $sql = "SELECT * FROM category";
                              $result = $con->query($sql);
                              while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row['category_id']."'>".$row['category_name']." (".$row['descr'].")"."</option>";
                              }
                              ?>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <select name="servicepick" placeholder="Select service" class="form-control" required="">
                           <option value="">Select Service</option>
                        </select>
                     </div>
                  </div>
                  <h2 class="why_us_h2">Choose your Doctor</h2>
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <select name="doctorId" class="form-control" onchange="docName(this.value)" required="">
                           <option value="" selected disabled>Select doctor</option>
                           <?php
                              $sql = mysqli_query($con, "SELECT * FROM schedule JOIN user ON schedule.doctor_Id=user.id WHERE role='Doctor' GROUP BY schedule.doctor_Id");
                              while($row = $sql->fetch_assoc()) {
                                echo "<option value='".$row['id']."'>".$row['full_name']."</option>";
                              }
                              ?>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <select name="schedule" class="form-control" id="docSchedule" required="">
                           <option value="" selected disabled>Select Schedule</option>
                        </select>
                     </div>
                  </div>
                  <div class="d-grid gap-2 col-6 mx-auto appointment_button_container">
                     <input type="submit" class="btn tn-lg btn-outline-info appointment_button" value="Submit Appointment" name="submit">
                  </div>
               </div>
            </form>
            <?php
               if (isset($_GET['response'])) {
                   $response = json_decode($_GET['response'], true);
                   if ($response['success']) {
                       echo '
                       <div class="modal fade" id="successModal" tabindex="-1"  role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-body">
                                    <img src="assets/image/Healteeth Logo.png" class="logo_img_modal" alt="">
                                    <br><br>
                                    <p class="text-center2">Appointment Booked <span style="color: #65cad7">Successfully!</span></p>
                                    <p class="text-center">Appointment Date: ' . $response['appointment_date'] . '</p>
                                    <p class="text-center">Start Time: ' . $response['start_time'] . '</p>
                                    <p class="text-center">End Time: ' . $response['end_time'] . '</p>
                                    <br>
                                    <a href="appointment-list.php"class="btn btn-outline-info btn-lg resetButton" id="redirectButton">Done</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <script>
                           $(document).ready(function() {
                                 $("#successModal").modal("show");
                           });
                        </script>
                       ';
                   } else {
                     echo '
                     <div class="modal fade" id="errorModal" tabindex="-1"  role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                               <div class="modal-body">
                                  <img src="assets/image/Healteeth Logo.png" class="logo_img_modal" alt="">
                                  <br><br>
                                  <p class="text-center2">' . $response['message'] . '</p>
                                  <br>
                                  <a href="appointment-book.php" class="btn btn-outline-info btn-lg resetButton" id="dismissButton">Close</a>
                               </div>
                            </div>
                         </div>
                      </div>
                      <script>
                         $(document).ready(function() {
                            $("#errorModal").modal("show");
                         });
                      </script>
                     ';
                   }
               }
            ?>
         </div>
      </div>
      <!-- /.8 -->
      <!-- /.row-->
      <!-- ================================================
         Scripts
         ================================================ -->
      <!-- jQuery Library -->
      <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script> <!--angularjs-->
      <script type="text/javascript" src="js/plugins/angular.min.js"></script> <!--scrollbar-->
      <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
      <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script> 
      <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script> z
      <script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script> <!--plugins.js - Some Specific JS codes for Plugin Settings-->
      <script type="text/javascript" src="js/plugins.min.js"></script> <!--custom-script.js - Add your own theme custom JS-->
      <script type="text/javascript" src="js/custom-script.js"></script> 
      <script>
   $(document).ready(function() {
     $('#appointmentForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
   
        $.ajax({
           url: 'appointment-book-process.php', // Update with the correct URL for your PHP script
           type: 'POST',
           data: formData,
           dataType: 'json',
           success: function(response) {
              // Handle the JSON response
              if (response.success) {
                 // Display success message or perform other actions
                 $('#responseMessage').text('Appointment booked successfully!\nDate: ' + response.appointment_date + '\nStart Time: ' + response.start_time + '\nEnd Time: ' + response.end_time);
                 $('#responseMessage').addClass('success').removeClass('error');
              } else {
                 // Display error message or perform other actions
                 $('#responseMessage').text('Error: ' + response.message);
                 $('#responseMessage').addClass('error').removeClass('success');

                 // Show the error modal
                 $('#errorModal').modal('show');
              }
           },
           error: function(xhr, status, error) {
              // Handle the AJAX request error
              $('#responseMessage').text('An error occurred while processing the request.');
              $('#responseMessage').addClass('error').removeClass('success');
           }
        });
     });
   });
</script>

      <script>
         $("select[name='categorypick']" ).change(function () {
            var categoryID = $(this).val();
            if(categoryID) {
               $.ajax({
                  url: "ajaxData.php",
                  dataType: 'Json',
                  data: {'category_id':categoryID},
                  success: function(data) {
                        $('select[name="servicepick"]').empty();
                        $.each(data, function(key, value) {
                           var duration = value.duration.split(':'); // split the duration string into hours, minutes, and seconds
                           var hours = parseInt(duration[0]);
                           var minutes = parseInt(duration[1]);
                           var durationText = '';
                           if (hours > 0) {
                              durationText += hours + ' hour' + (hours > 1 ? 's' : '') + ' ';
                           }
                           if (minutes > 0) {
                              durationText += minutes + ' minute' + (minutes > 1 ? 's' : '');
                           }
                           $('select[name="servicepick"]').append('<option value="'+ key +'" data-price="'+ value.price +'" data-duration="'+ value.duration +'">'+ value.name +' Duration: '+ durationText +'</option>');
                        });
                  }
               });
            } else {
               $('select[name="servicepick"]').empty();
            }
         });
         
         function docName(doctor_Id){ 
            $('#docSchedule').html('');
            $.ajax({
               type:'post',
               url: 'myAjax.php',
               data : { doctor_Id : doctor_Id}, 
               success : function(data){
                  $('#docSchedule').html(data);
               }
            })
         }
      </script>
   </body>
</html>