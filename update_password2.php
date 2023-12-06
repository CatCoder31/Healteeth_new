<?php
// update_password.php

// Retrieve the email and new password from the form submission
$token = $_POST['token'];
$newPassword = $_POST['new_password'];

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

// Update the password in the database
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
$updateQuery = "UPDATE user SET password = '$hashedPassword' WHERE token = '$token'";
//$previousToken=$token;
if ($conn->query($updateQuery) === TRUE) {
    // Display a success message to the user
    echo "Password reset successful. You can now log in with your new password.";
} else {
    // Display an error message to the user
    echo "Error updating password: " . $conn->error;
}

// Close the database connection
$conn->close();
?>