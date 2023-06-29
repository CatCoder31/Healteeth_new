<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Include necessary scripts and stylesheets -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">

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
            max-width: 30%;
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

        .text-center{
             text-align: center;
            font-family: 'Montserrat';
            font-weight: light;
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
    </style>
</head>

<body>
    <?php
    // check_email.php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];

        // Database connection parameters
        $servername = 'localhost';
        $username = 'root';
        $password = ''; // Replace with your database password
        $dbname = 'healteeth';

        // Create a new mysqli instance
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement to check if the email exists
        $stmt = $conn->prepare('SELECT * FROM user WHERE email_address = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $validationPlaceholder = "Email";

        // If the email exists, display a success message and provide a button to trigger the password reset
        if ($result->num_rows > 0) {
            $validation = "is-valid";
            $validationPlaceholder = "Email exists in our records.";
            $validationMessage = "If there's an account associated with that email, we've
                sent a link to reset your password.";

            echo '
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                        <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
                        <br><br>
                         <p class="text-center2">Forgot your <span style="color: #65cad7">password?</span></p>
                            <p class="text-center">' . $validationMessage . '</p>
                            <br>
                            
                            <button type="button" class="btn btn-outline-info btn-lg resetButton" id="redirectButton">Done</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Set a 2-second timer before showing the modal
                    setTimeout(function() {
                        $("#myModal").modal("show");
                    }, 2000);
                    
                    // Redirect to login.php after clicking the OK button
                    $("#redirectButton").click(function() {
                        window.location.href = "login.php";
                    });
                });
            </script>
            ';
        } else {
            $validation = "is-invalid";
            $validationPlaceholder = "Email does not exist.";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <div class="center-container">
        <div class="container">
            <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
            <form method="POST" action="">
                <h2 class="signin_h2 text-center">Just provide your email and we can do the rest</h2>
                <input type="email" id="email" class="form-control <?php echo $validation; ?>" placeholder="<?php echo (empty($validationPlaceholder)) ? 'Enter Email' : $validationPlaceholder; ?>" name="email" required>
                <button class="btn btn-outline-info btn-lg resetButton" id="resetButton">Reset Password</button>
                <div class="d-flex align-items-center justify-content-center pb-4 back-2signin">
                    <p class="mb-0 me-2 register_p">Remember your password?</p>
                    <a href="login.php" class="register_link_btn">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Button click event handler
            $('#resetButton').click(function() {
                var email = $('#email').val();

                // Send the email value to send_reset_link.php using jQuery AJAX
                $.ajax({
                    url: 'send_reset_link.php',
                    method: 'POST',
                    data: { email: email },
                    success: function(response) {
                        console.log('Reset link sent successfully.');
                    }
                });
            });
        });
    </script>
</body>

</html>
