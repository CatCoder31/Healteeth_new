<!-- reset_password.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Your Password | HealTeeth</title>
<link rel="icon" type="image/x-icon" href="assets/healteeth.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
  body {
    font-family: Arial, sans-serif;
  }

  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 80%;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
    border-radius: 50px;
  }

  button {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }

  p {
    margin-bottom: 10px;
  }

  .success {
    color: green;
  }

  .error {
    color: red;
  }

  .logo_img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 35%;
  }

  .resetButton {
    width: 100%;
    border-radius: 50px;
  }

  .signin_h2 {
    text-align: center;
    font-family: 'Montserrat';
    font-weight: bold;
    font-size: 1rem;
    color: #4052a4;
    position: relative;
    padding-bottom: 10px;
    padding-bottom: 20px;
  }

  .center-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
  }

  .register_link_btn {
    font-family: 'Montserrat';
    color: #65cad7;
    transition: 0.2s;
    font-weight: bold;
    text-decoration: none;
  }

  .register_p {
    font-family: 'Montserrat';
    color: #4052a4;
    font-weight: light;
  }

  .back-2signin {
    padding-top: 10px;
  }

  .text-center {
    text-align: center;
    font-family: 'Montserrat';
    font-weight: light;
    font-size: 1rem;
    color: #4052a4;
    position: relative;
    padding-bottom: 10px;
    padding-bottom: 20px;
  }

  .text-center2 {
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
    padding: 7%;
  }

  .modal-content {
    border-radius: 60px;
  }

  .form-control {
    width: 100%;
    border-radius: 50px;
    height: 50px;
    margin-bottom: 15px;
  }
  .field-icon {
  float: right;
  margin-right: 10px;
  margin-top: -60px;
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
  <div class="center-container">
    <div class="container">
      <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
      <form method="POST" id="resetForm">
        <h2 class="signin_h2 text-center">Choose a new password</h2>
        <input type="hidden" name="token" id="token" value="<?php echo $_GET['token']; ?>">
        <input type="password" id="new_password" class="form-control" placeholder="Enter New Password" name="new_password" required>
        <div class="btn_change field-icon">
                                        <button class="btn_change" onclick="change(); return false;">
                                            <i class="fa-solid fa-eye" style="color: #65cad7;" aria-hidden="true"></i>
                                        </button>
                                  </div>   
        <button type="submit" class="btn btn-outline-info btn-lg resetButton">Reset Password</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
           <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
          <p class="text-center2">Password Reset <span style="color: #65cad7">Successful</span></p>
          <p class="text-center">You can now log in with your new password.</p>
          <button type="button" class="btn btn-outline-info btn-lg resetButton" onclick="redirectToLogin()">Go to Login</button>
        </div>
      </div>
    </div>
  </div>

  <script>

     function change() {
        var x = document.getElementById("new_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }   

    // Function to redirect to login.php
    function redirectToLogin() {
      window.location.href = "login.php";
    }

    $(document).ready(function() {
      // Handle form submission
      $("#resetForm").submit(function(event) {
        event.preventDefault();

        // Get form data
        var formData = $(this).serialize();

        // Send AJAX request to update_password.php
        $.ajax({
          url: "update_password2.php",
          type: "POST",
          data: formData,
          success: function(response) {
            // Show success modal
            $("#successModal").modal("show");
          }
        });
      });
    });
  </script>
</body>
</html>
