<?php
// Include config file
require_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form inputs
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Get the user ID from your authentication system or session
    $user_id = $_POST['user_id']; // Replace with your actual user ID

    // Retrieve the current password from the database
    $sql = "SELECT password FROM user WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the current password
    if (password_verify($current_password, $hashed_password)) {
        // Validate the new password
        if ($new_password === $confirm_password) {
            // Hash the new password
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $sql = "UPDATE user SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hashed_new_password, $user_id);
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully
                mysqli_stmt_close($stmt);
                $response = array('status' => 'success', 'message' => 'Password changed successfully.');
                echo json_encode($response);
                // Terminate the session and log out the user
                session_start();
                session_destroy();

                exit();
            } else {
                // Error updating password
                mysqli_stmt_close($stmt);
                $response = array('status' => 'error', 'message' => 'Oops! Something went wrong. Please try again later.');
                echo json_encode($response);
                exit();
            }
        } else {
            // New password and confirm password do not match
            $response = array('status' => 'error', 'message' => 'New password and confirm password do not match.');
            echo json_encode($response);
            exit();
        }
    } else {
        // Incorrect current password
        $response = array('status' => 'error', 'message' => 'Incorrect current password.');
        echo json_encode($response);
        exit();
    }
} else {
    // Invalid request
    $response = array('status' => 'error', 'message' => 'Invalid request.');
    echo json_encode($response);
    exit();
}

?>