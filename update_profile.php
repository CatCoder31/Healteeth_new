<?php
// Include config file
require_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form inputs
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];
    $full_address = $_POST['full_address'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_number = $_POST['emergency_contact_number'];

    // Process profile photo upload
    $profile_photo = null;
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $temp_file = $_FILES['profile_photo']['tmp_name'];
        $extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $profile_photo = 'assets/upload_images/' . uniqid() . '.' . $extension;
        move_uploaded_file($temp_file, $profile_photo);
    }

    // Get the user ID from your authentication system or session
    $user_id = $_POST['user_id']; // Replace with your actual user ID

    // Update the user's information in the database
    $sql = "UPDATE user SET full_name = ?, username = ?, email_address = ?, contact_number = ?, full_address = ?, gender = ?, birthdate = ?, emergency_contact_name = ?, emergency_contact_number = ?";
    $params = array($full_name,  $username, $email_address, $contact_number, $full_address, $gender, $birthdate, $emergency_contact_name, $emergency_contact_number);

    // Add profile photo update to the SQL query and parameters if a profile photo is uploaded
    if (!empty($profile_photo)) {
        $sql .= ", profile_photo = ?";
        $params[] = $profile_photo;
    }

    $sql .= " WHERE id = ?";
    $params[] = $user_id;

    if ($stmt = mysqli_prepare($con, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Close statement
            mysqli_stmt_close($stmt);

            // Send AJAX response (optional)
            $response = array('status' => 'success', 'message' => 'User information updated successfully.');
            echo json_encode($response);
            exit();
        } else {
            // Close statement
            mysqli_stmt_close($stmt);

            // Send AJAX response (optional)
            $response = array('status' => 'error', 'message' => 'Oops! Something went wrong. Please try again later.');
            echo json_encode($response);
            exit();
        }
    } else {
        // Send AJAX response (optional)
        $response = array('status' => 'error', 'message' => 'Oops! Something went wrong. Please try again later.');
        echo json_encode($response);
        exit();
    }
} else {
    // Send AJAX response (optional)
    $response = array('status' => 'error', 'message' => 'Invalid request.');
    echo json_encode($response);
    exit();
}
?>
