<?php
   // Initialize the session
   include 'config2.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   $full_name = $_SESSION['full_name'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
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
   </style>
   <body>
   <?php include'nav_patient.php'; ?>



<div class="">

<div class="row row_1">
  
<div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 header_column_photo">
<img  class=" header_photo" src="assets/image/about_container_1_photo.png" alt="">
</div>
<div class="col-sm-6 col-md-5 col-lg-6">
<div class="header_text">
<h1 class="header_h1">
ABOUT <span style="color: #65cad7">US</span>
</h1>
<p class="header_p">
Healthteeth dentists offer specialized care for all dental needs at our full-service clinic. With expertise, advanced technology, and a convenient location, we provide unmatched safety and beautiful smiles for a lifetime of happiness.
</p>
</div>
</div>
</div>
</div>

<div class="row row_2">
<div class="col-sm-6 col-md-5 col-lg-6">
<div class="header_text">
<h1 class="header_h1">
OUR <span style="color: #fff">STORY</span>
</h1>
<p class="header_p">
our story is one of passion and dedication to revolutionizing dental care. With specialized dentists, state-of-the-art technology, and a welcoming environment, we provide comprehensive services tailored to your needs. Our mission is to ensure your dental health, comfort, and confidence, so you can enjoy a beautiful smile that brings joy to your life.
</p>
</div>
</div>
<div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 header_column_photo">
<img  class=" story_photo" src="assets/image/ourstory.png" alt="">
</div>
</div>
</div>



<div class="row row_3">
  
<div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 header_column_photo">
<img  class=" header_photo" src="assets/image/mission_photo.png" alt="">
</div>
<div class="col-sm-6 col-md-5 col-lg-6">
<div class="header_text">
<h1 class="header_h1">
<span style="color: #65cad7">Mission</span>
</h1>
<p class="header_p">
Healthteeth is resolutely dedicated to operating an expansive and exceptional dental clinic chain, committed to providing our esteemed clients with unrivaled quality dental care at the most affordable and accessible prices.
</p>
</div>
</div>
</div>
</div>



<div class="row row_3">
  

<div class="col-sm-6 col-md-5 col-lg-6">
<div class="header_text">
<h1 class="header_h1">
Vision
</h1>
<p class="header_p">
Through the clinics we build, the procedures we establish, the people we hire, the customer service we give, the quality of goods and services we supply, and the overall experience we create for our clients, Healthteeth's aim is to be the most admired and desired name in dental care.
</p>
</div>
</div>
<div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 header_column_photo">
<img  class=" header_photo" src="assets/image/vision_photo.png" alt="">
</div>
</div>
</div>


    </div>
  </div>
</div>

   <!-- footer section -->

   <footer class="text-center text-white footer" style="background-color: #65cad7;">
<!-- Grid container -->
<div class="container pt-4">
  <!-- Section: Social media -->
  <section class="mb-4">
    <!-- Facebook -->
    <a
      class="btn btn-link btn-floating btn-lg text-dark m-1"
      href="#!"
      role="button"
      data-mdb-ripple-color="dark"
      ><i class="fab fa-facebook-f icon"></i
    ></a>

    <!-- Twitter -->
    <a
      class="btn btn-link btn-floating btn-lg text-dark m-1"
      href="#!"
      role="button"
      data-mdb-ripple-color="dark"
      ><i class="fab fa-twitter icon"></i
    ></a>

    <!-- Google -->
    <a
      class="btn btn-link btn-floating btn-lg text-dark m-1"
      href="#!"
      role="button"
      data-mdb-ripple-color="dark"
      ><i class="fab fa-google icon"></i
    ></a>

    <!-- Instagram -->
    <a
      class="btn btn-link btn-floating btn-lg text-dark m-1"
      href="#!"
      role="button"
      data-mdb-ripple-color="dark"
      ><i class="fab fa-instagram icon"></i
    ></a>

    <!-- Linkedin -->
    <a
      class="btn btn-link btn-floating btn-lg text-dark m-1"
      href="#!"
      role="button"
      data-mdb-ripple-color="dark"
      ><i class="fab fa-linkedin icon"></i
    ></a>
    
  </section>
  <!-- Section: Social media -->
</div>
<!-- Grid container -->

<!-- Copyright -->
<div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
  © 2023 Copyright:
  <b>Healteeth</b>
</div>
<!-- Copyright -->
</footer>

<!-- End of .container -->
         </div>
      </div>
   </body>
</html>