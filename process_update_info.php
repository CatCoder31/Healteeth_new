<?php
// Include config file
require_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the verification token and other form inputs
    $verification_token = $_POST['token'];
    $number = $_POST['contact_number'];
    $street_address = $_POST['street_address'];
    $barangay_address = $_POST['barangay_address'];
    $city_address = $_POST['city_address'];
    $postal_address = $_POST['postal_address'];
    $gender = $_POST['gender'];
    $emergencyContact = $_POST['emergency_contact_name'];
    $emergencyContactNumber = $_POST['emergency_contact_number'];
    $language = $_POST['language'];


    $full_address = $street_address . " " . $barangay_address . " " . $city_address. " " . $postal_address;
    
    //$full_address = $_POST['full_address'];

    // Update the user's profile information in the database
    $sql = "UPDATE user SET contact_number = ?, full_address = ?, gender = ?, emergency_contact_name = ?, emergency_contact_number = ?, language = ? WHERE verification_token = ?";

    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $number, $full_address, $gender, $emergencyContact, $emergencyContactNumber, $language, $verification_token);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to a success page or perform any other necessary actions
            header("Location: confirmation2.php");
            exit();
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
