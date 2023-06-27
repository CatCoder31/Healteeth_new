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
$password = $row['password'];
}

if(isset($_POST['action'])){
    if($action = 'Submit')
    {
        $emailupdt = $_POST['email'];
        $numupdt = $_POST['phone'];
        $addupdt = $_POST['address'];

        $update_data = "UPDATE user SET email_address='$emailupdt', contact_number = '$numupdt', full_address='$addupdt' WHERE id = $id;";
        $run_data = mysqli_query($con,$update_data);

        if($run_data){
            $added = true;
        }else{
            echo ("Error description: " . $con -> error);
        }
    }
    if($action == 'Update Password')
    {
        $pwupdt =  htmlspecialchars($_POST['password']);
        $update_pw = "UPDATE users SET password='$pwupdt' WHERE id = $user_id;";
        $run_pw = mysqli_query($con,$update_pw);
        if($run_pw){
            $added = true;
        }else{
            echo ("Error description: " . $con -> error);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HealTeeth</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
  left: 0px;
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
  left: 35px;
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
  left: 70px;
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
  left: 135px;
  box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
  overflow: hidden;
}

.custom6 {
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

.custom7 {
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
.custom5:active {
  background-color: #445c6d;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.custom6:active {
  background-color: #445c6d;
  box-shadow: 0 5px #666;
  transform: translateY(4px);

}
.custom7:active {
  background-color: #445c6d;
  box-shadow: 0 5px #666;
  transform: translateY(4px);

}

body {
    font-family: 'Lato', sans-serif;
}

h1 {
    margin-bottom: 40px;
}

label {
    color: #333;
}

.btn-send {
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    width: 80%;
    margin-left: 3px;
    }
.help-block.with-errors {
    color: #ff5050;
    margin-top: 5px;

}

.card{
    margin-left: 10px;
    margin-right: 10px;
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
              <button class="custom" onclick="window.location='welcome.php';">Home</button>
            </li>
            <li class="nav-item">
                <button class="custom1" onclick="window.location='appointmentbook.php';">Book an Appointment</button>
            </li>
            <li class="nav-item">
                <button class="custom2" onclick="window.location='appointmentlist.php';">See List of Appointments</button>
            </li>
            <li class="nav-item">
                <button class="custom3">Contact Us</button>
            </li>
            <li class="nav-item">
                <button class="custom4">About</button>
            </li>
            <li class="nav-item">
                <button class="custom5" onclick="window.location='userprofile.php';">User Profile</button>
            </li>
            <li class="nav-item">
                <button class="custom6">Welcome <?php echo $full_name;?></button>
            </li>
            <li class="nav-item">
                <button class="custom7" onclick="window.location='logout.php';">Sign Out</button>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      
    </div>
</nav>

<div class="container">
    <br>
    <h1 align="center">Edit Profile</h1>
     <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
       
            <div class = "container">
           <form method="POST" enctype="multipart/form-data">
            <div class="controls">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">Name *</label>
                            <input id="form_name" type="text" name="patient_name" class="form-control" 
                            value ="<?php echo $full_name;?>" disabled required="required" data-error="Firstname is required.">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_email">Email *</label>
                            <input id="form_email" type="text" name="email" class="form-control" 
                            value ="<?php echo $email_address;?>" required="required" data-error="Valid email is required.">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">Phone *</label>
                            <input id="form_name" type="text" name="phone" class="form-control" value ="<?php echo $contact_number;?>" required="required" data-error="Firstname is required.">
                            
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">Address *</label>
                            <input id="form_name" type="text" name="address" class="form-control" value ="<?php echo $full_address;?>" required="required" data-error="Firstname is required.">
                            
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">Password *</label>
                            <input id="form_name" type="password" name="password" class="form-control" value =""  data-error="Firstname is required.">
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_name">User Id *</label>
                            <input id="form_name" type="text" name="userid" class="form-control" disabled value ="<?php echo $id;?>" required="required" data-error="Firstname is required.">
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col-md-12"> 
                <input type="submit" class="btn btn-success btn-send  pt-2 btn-block " value="Submit" name="action" >
            </div>
            <div class="col-md-12"> 
                <input type="submit" class="btn btn-info btn-send  pt-2 btn-block " value="Update Password" name="action" >
            </div>
        </div>
         </form>
    </div>
    </div>
</div>
    <!-- /.row-->
</div>
</body>
</html>
    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>   
    <script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>   
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
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
                    $('select[name="servicepick"]').append('<option value="'+ key +'">'+ value +'</option>');
                });
            }
        });


    }else{
        $('select[name="service"]').empty();
    }
});
</script>