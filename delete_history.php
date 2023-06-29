<?php
include('config.php');

// Retrieve the appointment ID from the URL parameter
$id = $_GET['id'];

// Retrieve the user ID from the URL parameter
$userId = $_GET['userId'];

// Perform the deletion
$delete = "DELETE FROM appointments WHERE id = $id";
$run_data = mysqli_query($con, $delete);

if ($run_data) {
    header("location: patient_details.php?id=$userId");
} else {
    echo "Failed to delete the appointment.";
}
?>