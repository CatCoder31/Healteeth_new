<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $phonenumber = $address = "";
$name_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE email_address = ?";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phonenumber"]))) {
        $phonenumber_err = "Please enter your Contact Number.";
    } else {
        $phonenumber = trim($_POST["phonenumber"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($phonenumber_err) && empty($address_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO user (full_name, email_address, password, contact_number, full_address) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_password, $param_phonenumber, $param_address);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phonenumber = $phonenumber;
            $param_address = $address;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Prepare the response
                $response = [
                    'success' => true,
                    'message' => 'Registration successful. You can now login.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'emailError' => $email_err,
                    'passwordError' => $password_err,
                    'confpasswordError' => $confirm_password_err
                ];
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        $response = [
            'success' => false,
            'emailError' => $email_err,
                    'passwordError' => $password_err,
                    'confpasswordError' => $confirm_password_err
        ];
    }

    // Close connection
    mysqli_close($con);

    // Send the response back in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>