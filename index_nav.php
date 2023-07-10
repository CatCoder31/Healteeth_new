<!-- 
<?php
session_start();

// Rest of your PHP code goes here
// ...
?> -->

<style>
  .navbar-nav{
    align-items: center;
  }

  .profile_btn{
    padding-top:2px !important;
    padding-bottom:2px !important;
    padding-left:4px !important;
  }
</style>
<nav class="navbar navbar-expand-md bg-body-tertiary ">
  <div class="container-xl">
    <a class="navbar-brand" onclick="window.location='welcome.php';">
    <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" onclick="window.location='index.php';">HOME</a>
        </li>


        
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='login.php';">BOOK AN APPOINTMENT</a>
        </li>
        
       
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='index.php#contact';">CONTACT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="window.location='index_about.php';">ABOUT</a>
        </li>


    <li class="nav-item">
          <a class="nav-link btn btn-outline-info dropdown_btn" onclick="window.location='login.php';">SIGN IN/REGISTER</a>
        </li>
    




       
      </ul>      
    </div>
  </div>
</nav>