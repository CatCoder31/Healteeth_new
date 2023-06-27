<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HealTeeth</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/nav.css">
      <link rel="stylesheet" type="text/css" href="css/indexnav.css">
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
   </style>
   <body>
     <?php include 'index_nav.php'; ?>
      
     <div class=" ">
  
  <div class="row">
    <div class="col-sm-6 col-md-5 col-lg-6">
    <div class="header_text">
      <h1 class="header_h1">
      Transforming <span style="color: #65cad7">Smiles</span>, Elevating <span style="color: #65cad7">Lives</span>
      </h1>
      <p class="header_p">Transforming lives through stunning smiles. Exceptional dental care that empowers, boosts confidence, and elevates overall well-being.</p>
      <button type="button" class="btn btn-outline-info btn-lg about_btn" onclick="window.location='index_about.php';">GET TO KNOW US</button>
      <button type="button" class="btn btn-outline-primary btn-lg appointment_btn" onclick="window.location='login.php';">BOOK AN APPOINTMENT</button>
      </div>
    </div>
    <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0 header_column_photo">
    <img  class=" header_photo" src="assets/image/container_head_photo.png" alt="">
    </div>
  </div>
</div>


<!-- ======= About Section ======= -->
<section id="about why_us" class="about why_us">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch position-relative">
          <img  class=" header_photo" src="assets/image/why-us-photo.png" alt="">
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3 class="why_us_h3">Why Choose <span style="color: #65cad7">Healteeth?</span></h3>
            <p class="why_us_p">Comprehensive care, advanced technology, patient-centered approach. Choose HealTeeth for all your dental needs, ensuring top-quality treatments, comfort, and personalized attention.</p>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title why_us_title">Comprehensive Dental Care</h4>
              <p class="description why_us_p">Get all your dental needs met at HealTeeth. From routine check-ups to advanced procedures, our experienced team provides comprehensive care under one roof.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title why_us_title">State-of-the-Art Facilities and Technology</h4>
              <p class="description why_us_p">Experience top-quality dental care with our modern clinics and advanced technology. We use cutting-edge equipment for precise diagnoses and comfortable treatments.</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-atom"></i></div>
              <h4 class="title why_us_title">Patient-Centered Approach</h4>
              <p class="description why_us_p">At HealTeeth, your comfort comes first. Our friendly team listens to your concerns, answers your questions, and creates personalized treatment plans tailored to your preferences. Expect compassionate care and exceptional service.</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <div class="container container_service" id="services">
        
        <h2 class="services_h2">Our Services</h2>
        <p class="services_p">fillings, root canals, extractions, cosmetic dentistry, teeth whitening, and implants. Exceptional care in a friendly environment for a healthy, beautiful smile.</p>
<?php
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 6;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
?>
<div class="row service_row">
<?php
include 'config.php';
$result = mysqli_query($con, "SELECT * FROM category");
foreach ($result as $row){
   $image = $row['image'];
   $service_name = $row['category_name'];
   $service_price = $row['descr'];
?>  

       <div class="col-md-<?php echo $bootstrapColWidth; ?> service_cards">
       <div class="col col_service">
            <div class="card card_service ">
                  <img src='assets/upload_images/<?php echo $image;?>' class="service_card_img">
                  <div class="card-body">
                    <h5 class="card-title align-bottom"><?php echo $service_name;?></h5>
                    <p class="card-text"><?php echo $service_price;?></p>
                  </div>
               </div>
               
        </div>
        </div>


<?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><br><div class="row">';
}
?>
</div>
      </div>
      <br>


 <!-- ======= Contact Section ======= -->
 <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
        <h2 class="contact_h2">Contact Us</h2>
        <p class="services_p">HealTeeth: Exceptional dental care that puts your smile first. Contact us today for expert services and personalized treatments. Your oral health is our top priority.</p>
      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed/v1/place?q=874-898+P.+Herrera,+Maynila,+Kalakhang+Maynila&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8" frameborder="0" allowfullscreen></iframe>
      </div>


      <div class="container">
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <h4 class="contact_us_title">Location</h4>
                <p class="contact_us_p">874 P. Herrera Manila Metro Manila</p>
              </div>

              <div class="email">
                <h4 class="contact_us_title">Email</h4>
                <p class="contact_us_p">contactUs@healteeth.com</p>
              </div>

              <div class="phone">
                <h4 class="contact_us_title">Call</h4>
                <p class="contact_us_p">+63 45 859 0667</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message"  style="resize: none;" rows="5" placeholder="Message" required></textarea>
              </div>
             
              <div class="text-center"><button type="button" class="btn btn-lg btn-outline-info contact_us_btn">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->


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



<!--
      <div class="container-fluid bg-light">
         <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
               <div class="well well-sm">
                  <form class="form-horizontal" action="" method="post">
                     <fieldset>
                        <h2 class="text-center">Contact us</h2>
                      
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="name">Name</label>
                           <div class="col-md-12">
                              <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                           </div>
                        </div>
                       
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="email">Your E-mail</label>
                           <div class="col-md-12">
                              <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="message">Your message</label>
                           <div class="col-md-12">
                              <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                           </div>
                        </div>
                        <br>
                        <div class="form-group">
                           <div class="col-md-12 text-center">
                              <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                           </div>
                        </div>
                        <br>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid">
         <div class="bg-white py-5">
  <div class="container py-5">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
        <h2 class="font-weight-light">About Us</h2>
        <p class="font-italic text-muted mb-4">Healthteeth dentists are specialized in different fields to address all your dental concerns and to make sure that you will be provided with unmatched care and safety. Healthteeth Clinic is a full-service general and cosmetic dentistry clinic, providing patients with expertise, technology and a convenient location. We offer a relaxing environment far from your regular dental practices. Our clinic can give a beautiful smile to our patients and a lifetime of happiness.
Healthteeth dentists are specialized in different fields to address all your dental concerns and to make sure that you will be provided with unmatched care and safety. Healthteeth Clinic is a full-service general and cosmetic dentistry clinic, providing patients with expertise, technology and a convenient location. We offer a relaxing environment far from your regular dental practices. Our clinic can give a beautiful smile to our patients and a lifetime of happiness.
</p><a href="index_about.php" class="btn btn-dark px-5 rounded-pill shadow-sm">Read More</a>
      </div>
      <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="assets/image/LOGO.png" alt="" class="img-fluid mb-4 mb-lg-0"></div>
    </div>
  </div>
-->
   </body>
</html>