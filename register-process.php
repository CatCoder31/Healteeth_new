<?php
// Enable error reporting and logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include config file
require_once "config.php";

// Include PHPMailer
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define variables and initialize with empty values
$username = $name = $password = $confirm_password = $email = "";
$username_err = $name_err = $password_err = $confirm_password_err = $email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

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

    // Validate full name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your full name.";
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

    // Check input errors before inserting into the database
    if (empty($username_err) && empty($email_err) && empty($name_err) && empty($password_err) && empty($confirm_password_err)) {
        // Generate a verification token
        $verification_token = bin2hex(random_bytes(32));

        // Prepare an insert statement
        $sql = "INSERT INTO user (username, full_name, email_address, password, verification_token,token_created_at) VALUES (?, ?, ?, ?, ?, NOW())";

        if ($stmt = mysqli_prepare($con, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_name, $param_email, $param_password, $param_verification_token);

            // Set parameters
            $param_username = $username;
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_verification_token = $verification_token;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Send verification email


                $confirmationLink = "http://localhost/Healteeth/verify.php?token=$verification_token";




                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                //$mail->SMTPDebug = 2;
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'healteethph@gmail.com';
                $mail->Password = 'lektzbyfwtljbqpd';

                // Set up sender and recipient
                $mail->setFrom('healteethph@gmail.com', 'no-reply@healteethph.com');
                $mail->addAddress($email, $name);

                // Set email content
                $mail->Subject = 'Email Verification';
                // Compose the email
                            $subject = 'Password Reset';
                            $message = <<<HTML
                            <!DOCTYPE html>
                            <html>
                                    <head>
                                
                                        <style>
                                        /* Reset CSS */
                                        body, h1, h2, h3, h4, h5, h6, p, ul, ol, li {
                                            margin: 0;
                                            padding: 0;
                                        }
                                        body {
                                            font-family: 'Montserrat';
                                            background-color: #f1f1f1;
                                        }
                                        /* Container */
                                        .container {
                                            max-width: 600px;
                                            margin: 0 auto;
                                            border: 1px solid #dddddd;
                                            border-radius: 6px;
                                        }
                                        /* Header */
                                        .header {
                                            border-bottom: thin solid #dadce0;
                                            padding: 30px;
                                            text-align: center;
                                            margin-left: 10%;
                                            margin-right: 10%;
                                        }
                                        .header img {
                                            max-width: 150px;
                                            margin-bottom: 20px;
                                        }
                                        /* Content */
                                        .content {
                                            padding: 30px;
                                            color: #333333;
                                            line-height: 1.5;
                                        }
                                        .content h2 {
                                            font-size: 24px;
                                            margin-bottom: 20px;
                                        }
                                        .content p {
                                            font-size: 16px;
                                            margin-bottom: 10px;
                                        }
                                        /* Footer */
                                        .footer {
                                            background-color: #f1f1f1;
                                            padding: 30px;
                                            text-align: center;
                                        }
                                        .footer p {
                                            font-size: 14px;
                                            margin-bottom: 10px;
                                        }

                                        .button {
                                            display: inline-block;
                                            background-color: #007bff;
                                            color: #fff !important;
                                            padding: 10px 20px;
                                            border-radius: 4px;
                                            text-decoration: none;
                                            font-weight: bold;
                                            font-size: 16px;
                                            }

                                            .button:hover {
                                            background-color: #0056b3;
                                            }
                                            p{
                                            font-family: 'Montserrat';
                                            }
                                        </style>
                                            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                <script src="https://kit.fontawesome.com/b1be178591.js" crossorigin="anonymous"></script>
                                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,800;0,900;1,100;1,200;1,300;1,400;1,800;1,900&display=swap" rel="stylesheet">
                                    </head>
                                    <body>
                                        <div class="container">
                                        <div class="header">
                                            <h3>CONFIRM YOUR EMAIL</h3>
                                        </div>
                                        <div class="content">
                                            <h2>Please Confirm your Healteeth Account</h2>
                                            <p>
                                           You've entered <b>$email</b> as the email address for your account.
                                            Please verity this email address by clicking button below. The link is valid for <b>24 hours</b>.</p>
                                            <br>
                                            <p><a href="$confirmationLink" class="button">Confirm Your Email</a></p>
                                            <br>
                                            <p>Or copy and paste the link on yout browser</p>
                                            <a href="">http://localhost/Healteeth/verify.php?token=$verification_token</a>
                                        </div>
                                        
                                        </div>
                                        <p style="text-align: center;">&copy; 2023 Healteeth PH. All rights reserved.</p>

                                    </body>
                                    </html>
                            HTML;

                $mail->Body = $message;
                $mail->isHTML(true);

                // Send the email
                $mailSent = $mail->send();
                // Prepare the response
                $response = [
                    'success' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to insert user into the database.',
                ];
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to prepare statement.',
            ];
        }
    } else {
        $response = [
            'success' => false,
            'usernameError' => $username_err,
            'emailError' => $email_err,
            'nameError' => $name_err,
            'passwordError' => $password_err,
            'confirmPasswordError' => $confirm_password_err,
        ];
    }

    // Close connection
    mysqli_close($con);

    // Send the response back in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Verification Page
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
                // Fetch the email address and token creation time from the result
                mysqli_stmt_bind_result($stmt, $user_id, $email, $token_created_at);

                // Fetch the values
                mysqli_stmt_fetch($stmt);

                // Check if the token is valid and not expired (e.g., within 24 hours)
                $token_expiration = strtotime('+24 hours', strtotime($token_created_at));
                $current_time = time();

                if ($current_time <= $token_expiration) {
                    // Mark the email address as verified in the database
                    $sql = "UPDATE user SET email_verified = 1 WHERE id = ?";
                    if ($stmt = mysqli_prepare($con, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect to the confirmation page
                            header("Location: confirmation.php");
                            exit();
                        }
                    }
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
}
?>
