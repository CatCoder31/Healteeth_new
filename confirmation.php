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
  <title>Complete your Profile | HealTeeth</title>
  <link rel="icon" type="image/x-icon" href="assets/healteeth.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Add viewport meta tag -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Montserrat';
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
      margin-top: 5%;
      padding: 20px;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="email"],
    input[type="text"],
    select {
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

    .center-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .form-group {
      margin-bottom: 25px;
    }

    @media (max-width: 768px) {
      .container {
        max-width: 90%;
      }

      .text-center2 {
        font-size: 2rem;
      }
    }
  </style>
</head>

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
        <input type="text" name="contact_number" placeholder="Contact Number" class="form-control" required>
    </div>

    <div class="form-group">
        <input type="text" name="street_address" placeholder="Enter Street Address" class="form-control" required>
    </div>

      <div class="form-group">
        <input type="text" name="barangay_address" placeholder="Enter Barangay" class="form-control" required>
    </div>

      <div class="form-group">
        <input type="text" name="city_address" placeholder="Enter City" class="form-control" required>
    </div>

      <div class="form-group">
        <input type="text" name="postal_address" placeholder="Enter Postal Code" class="form-control" required>
    </div>

    <div class="form-group">
        <input type="text" name="emergency_contact_name" class="form-control" placeholder="Emergency Contact Name" required>
    </div>

    <div class="form-group">
        <input type="text" name="emergency_contact_number" class="form-control" placeholder="Emergency Contact Number" required>
    </div>

    <div class="form-group">
        <label for="birthday">Birthday:</label>
        <input type="date" name="language" class="form-control" required>
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

