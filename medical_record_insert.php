<?php
// Retrieve the medical record content from the form submission
$medicalRecord = $_POST['medical_record'];
$user_id = $_POST['user_id'];
// Perform necessary validation and sanitization on the data

// Assuming you have a database connection established
// Insert the medical record content into the "user" table
$sql = "UPDATE user SET medical_record = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $medicalRecord, $userId);
$stmt->execute();

// Check if the insertion was successful and handle any errors

// Close the database connection
$stmt->close();
$mysqli->close();

// Return a response
$response = array(
    'success' => true,
    'message' => 'Medical record successfully inserted.'
);
echo json_encode($response);
