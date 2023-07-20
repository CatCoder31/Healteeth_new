<!-- <?php
// // Include config file
// require_once "config.php";

// // Verify the token
// if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
//     $verification_token = $_GET["token"];

//     // Prepare a select statement to check the verification token
//     $sql = "SELECT id, email_address, token_created_at FROM user WHERE verification_token = ?";

//     if ($stmt = mysqli_prepare($con, $sql)) {
//         // Bind variables to the prepared statement as parameters
//         mysqli_stmt_bind_param($stmt, "s", $param_verification_token);

//         // Set parameters
//         $param_verification_token = $verification_token;

//         // Attempt to execute the prepared statement
//         if (mysqli_stmt_execute($stmt)) {
//             // Store the result
//             mysqli_stmt_store_result($stmt);

//             if (mysqli_stmt_num_rows($stmt) == 1) {
//                 // Fetch the email address and token creation time from the result
//                 mysqli_stmt_bind_result($stmt, $user_id, $email, $token_created_at);

//                 // Fetch the values
//                 mysqli_stmt_fetch($stmt);

//                 // Check if the token is valid and not expired (e.g., within 24 hours)
//                 $token_expiration = strtotime('+24 hours', strtotime($token_created_at));
//                 $current_time = time();

//                 if ($current_time <= $token_expiration) {
//                     // Mark the email address as verified in the database
//                     $sql = "UPDATE user SET email_verified = 1 WHERE id = ?";
//                     if ($stmt = mysqli_prepare($con, $sql)) {
//                         // Bind variables to the prepared statement as parameters
//                         mysqli_stmt_bind_param($stmt, "i", $user_id);

//                         // Attempt to execute the prepared statement
//                         if (mysqli_stmt_execute($stmt)) {
//                             // Redirect to the confirmation page
//                             header("Location: confirmation.php");
//                             exit();
//                         }
//                     }
//                 } else {
//                     echo "The verification token has expired.";
//                 }
//             } else {
//                 echo "Invalid verification token.";
//             }
//         } else {
//             echo "Oops! Something went wrong. Please try again later.";
//         }

//         // Close statement
//         mysqli_stmt_close($stmt);
//     } else {
//         echo "Oops! Something went wrong. Please try again later.";
//     }
// } else {
//     echo "Invalid request.";
// }
?> -->
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
                    // Mark the email address as verified in the database
                    $sql = "UPDATE user SET email_verified = 1 WHERE id = ?";
                    if ($stmt = mysqli_prepare($con, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect to the confirmation page with the verification token
                            header("Location: confirmation.php?token=" . $verification_token);
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
} else {
    echo "Invalid request.";
}
?>
