<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "healteeth";
$name = $_SESSION['name'];
$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HealTeeth</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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

.custom5 {
  width: 120px;
  height: 50px;
  background: url("../images/v16_28.png");
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  opacity: 1;
  position: relative;
  left: 350px;
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
    </style>
</head>
<body>

<nav class="navbar navbar-white bg-white flex-nowrap">
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
    <div class="w-100"><!--spacer--></div>
</nav>

<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="navbar-brand" href="#">
                    <img src="assets/image/LOGO.png" alt="" width="320" height="150">
                </a>
            </li>
        </ul>
    </div>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <div class="mx-auto order-0">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <button class="custom" onclick="window.location='index.php';">Home</button>
            </li>
            <li class="nav-item">
                <button class="custom1">Services</button>
            </li>
            <li class="nav-item">
                <button class="custom2">Contact Us</button>
            </li>
            <li class="nav-item">
                <button class="custom3">About</button>
            </li>
            <li class="nav-item">
                <button class="custom4">Welcome <?php echo $name;?></button>
            </li>
            <li class="nav-item">
                <button class="custom5" onclick="window.location='logout.php';">Sign Out</button>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      
    </div>
</nav>

<div
  class="bg-image"
  style="
    background: url('assets/image/BG PHOTO.png');
    height: 600px;
  "
>
</div>

<div class="container">
    <h2 align="center">Services</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a short card.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>
</div>

<div class="container-fluid bg-light">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post">
          <fieldset>
            <h2 class="text-center">Contact us</h2>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Your E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="container-fluid">
    <h2 align="center">About Us</h2>
</div>

</body>
</html>