<?php
// Include config file
require_once "config.php";

// Verify the token
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    $verification_token = $_GET["token"];

    // Prepare a select statement to check the verification token
    $sql = "SELECT id, email_address, token_created_at FROM user WHERE verification_token = ?";

    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_verification_token);

        // Set parameters
        $param_verification_token = $verification_token;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store the result
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Fetch the user ID, email address, and token creation time from the result
                mysqli_stmt_bind_result($stmt, $user_id, $email, $token_created_at);

                // Fetch the values
                mysqli_stmt_fetch($stmt);

                // Check if the token is valid and not expired (e.g., within 24 hours)
                $token_expiration = strtotime('+24 hours', strtotime($token_created_at));
                $current_time = time();

                if ($current_time <= $token_expiration) {
                    // Display the form to enter additional information
                    ?>

                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Profile Completion</title>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">


                    </head>
                    <style>
                         body {
                        font-family: 'montserrat';
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
    margin-top:5%;
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
    font-size: 3rem;
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

.logo_img{
    width: 20%;
}

   @media (max-width:590px) {

    .logo_img{
    width: 70%;
}
   }
                    </style>
                    <body>
                       <div class="container">
                         <img src="assets/image/Healteeth Logo.png" class="logo_img" alt="">
        <br>
                         <h1 class="text-center2">Complete Your Profile</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="process_update_info.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $verification_token; ?>">
                <div class="form-group">
                    <input type="text" name="contact_number" placeholder="Contact Number" class="form-control" required style="border-radius: 50px;">
                </div>

                <div class="form-group">
                    <input type="text" name="full_address" placeholder="Enter Address" class="form-control" required style="border-radius: 50px;">
                </div>

                <div class="form-group">
                    <input type="text" name="emergency_contact_name" class="form-control"  placeholder="Emergency Contact Name" required style="border-radius: 50px;">
                </div>

                <div class="form-group">
                    <input type="text" name="emergency_contact_number" class="form-control"  placeholder="Emergency Contact Number" required style="border-radius: 50px;">
                </div>

                <div class="form-group">
                    <select name="language" class="form-control" placeholder="Select Language" required style="border-radius: 50px;">
                        <?php
                        // Array of languages
                        $languages = array(
                            "English",
                            "Filipino",
                            "Cebuano",
                            "Ilocano",
                            "Hiligaynon",
                            "Waray-Waray",
                            "Kapampangan",
                            "Bicolano",
                            "Pangasinense",
                            "Maranao",
                            "Tausug",
                            "Maguindanaoan",
                            "Ibanag",
                            "Chavacano",
                            "Surigaonon",
                            "Ivatan",
                            // Add more languages as needed
                        );

                        // Sort the languages alphabetically
                        sort($languages);

                        // Iterate over the languages and generate the options
                        foreach ($languages as $language) {
                            echo "<option value=\"$language\">$language</option>";
                        }
                        ?>
                    </select>
                </div>

                 <div class="form-group">
                    <label for="gender">Gender:</label>
                    <div>
                        <input type="radio" name="gender" value="Male" required> Male
                        <input type="radio" name="gender" value="Female" required> Female
                        <input type="radio" name="gender" value="Other" required> Other
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" value="Submit Profile" class="btn btn-outline-info btn-lg resetButton">
                </div>
            </form>
        </div>
    </div>
</div>

                    </body>
                    </html>

                    <?php
                } else {
                    echo "The verification token has expired.";
                }
            } else {
                echo "Invalid verification token.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>

