<?php
   // Initialize the session
   include 'config2.php';
   $user_id=$_SESSION['id'];
   $full_name = $_SESSION['full_name'];
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Appointment List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HealTeeth</title>
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
         width: 100%;
      }
      .header_text{
         padding-top: 20%;
         padding-bottom: 20%;
         padding-left: 13%;
         font-family: 'Montserrat';
      }
      .header_h1{
         font-weight:bold;
         font-size:4rem;
         color: #4052a4;
      }
      .header_p{
         font-size:1.5rem;
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
         font-size:1.2rem;
         color: #4052a4;
         font-family: 'Montserrat';
  position: relative;
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



@media all and (max-width: 775px) {
   .service_cards{
   margin: auto;
   
  top: 0;
}
   .card_service{
   width: 70%;
   margin-bottom: 5%;
}

.services_h2 {
  text-align: center;
  font-weight:bold;
         font-size:8vw;
         color: #4052a4;
         font-family: 'Montserrat';
  position: relative;
}

.services_p {
  text-align: center;
  margin-bottom: 60px;
  font-weight:light;
         font-size:4vw;
         color: #4052a4;
         font-family: 'Montserrat';
  position: relative;
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

.card_container{
   border-radius: 15px;
   width:50%;
   
}
.card{
   text-align: center;
   padding:1%;
   transition: 0.2s transform;
   border:1px solid #fafafa;
}

.card:hover{
   color: white;
   background-color: #fafafa;
   transform: scale(1.1);
   border:none;
}

.labels{
   font-family: 'montserrat';
   font-weight:light;
   font-size:1rem;
   color: #4052a4;
}
.view_btn:hover{
   color:white;
}
.container-fluid{
   margin-left:5%;
   margin-right:5%;
}
.container-fluid-card{
   padding:1%;
   width: 15rem
}

.card{
   
   padding-top:3%;
}

.form-group {
   margin-bottom: 0.4rem; 
}
   </style>
   <body>
      <?php include'nav_patient.php'; ?>

      <div class="container">

      <h2 class="services_h2">Manage <span style="color: #65cad7">Appointments</span></h2>
        <p class="services_p">Organize and schedule your appointments with our user-friendly appointment management system, streamlining your workflow and saving you time.</p>
      </div>

 
      <div class="container-fluid">
         <div class="card-group">
               <?php
                  if(isset($_GET['status'])){
                      $status = $_GET['status'];
                  }
                  else{
                      $status = '%';
                  }
                  
                  $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE patient_id = $user_id AND status LIKE '$status';";
                  $run_data = mysqli_query($con,$get_data);
                  $i = 0;
                  while($row = mysqli_fetch_array($run_data))
                  {
                  $sl = ++$i;
                  $id = $row['id'];
                  $name = $row['patient_name'];
                  $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                  $atime = ['appointment_time'];
                  $service = $row['service_name'];
                  $category = $row['category_name'];
                  $status = $row['status'];
                  ?>
                  <div class="container-fluid-card">
                  <div class="card ">
                     <div class="container">
                        <form action="" id="contact-form" role="form" name="contact-form">
                           <div class="controls">
                  <div class="row">
                                 <div class="cards">
                                    <div class="form-group">
                                       <label for="form_name" class="labels"><b>Name</b> <?php echo $name?></label>
                                    </div>
                                 </div>
                              </div>
                  <div class="row">
                                 <div class="cards">
                                    <div class="form-group">
                                       <label for="form_name" class="labels"><b>Appointment Date</b> <?php echo $adate?></label>
                                    </div>
                                 </div>
                              </div>
                  <div class="row">
                                 <div class="cards">
                                    <div class="form-group">
                                       <label for="form_name" class="labels"><b>Status</b> <?php echo $status?></label>
                                    </div>
                                 </div>
                              </div>
                  <div class="row">
                                 <div class="cards">
                                    <div class="form-group">
                                      <a href="view-appointment.php?appointment-id='<?php echo $row['id']?>'" class="btn btn-outline-info view_btn">View Appointment </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <?php
                  }
                  ?>
            </div>
         </div>
      </div>
      </div>
   </body>
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