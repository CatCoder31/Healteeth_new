<?php
session_start();
include 'config.php';

// Check if the user is logged in, if not then redirect him to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

date_default_timezone_set('Asia/Manila');
$date_today = date('Y-m-d');
$full_name = $_SESSION['full_name'];

$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $patient_name = $_POST['patient_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $categorypick = $_POST['categorypick'];
    $servicepick = $_POST['servicepick'];
    $doctor_id = $_POST['doctorId'];
    $schedule = $_POST['schedule'];

    $query = "SELECT *
            FROM schedule 
            WHERE date_sched = CURRENT_DATE AND doctor_id = '$doctor_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $date_sched = $row['date_sched'];
    $time_sched_start = strtotime($row['time_sched_start']);
    $time_sched_end = strtotime($row['time_sched_end']);
    $breaktime_start = strtotime($row['breaktime_start']);
    $breaktime_end = strtotime($row['breaktime_end']);

    $query = "SELECT *
            FROM services 
            WHERE service_id = '$servicepick'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $service_duration = $row['service_duration'];

    // Query the database to get the existing appointments for the selected schedule
    $query = "SELECT *
            FROM appointments 
            WHERE appointment_date = '$date_sched'
            AND schedule = '$schedule'
            AND status = 'Approved' 
            ORDER BY appointment_time DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $last_appointment_time = strtotime($row['time_finish']);
    } else {
        // If there are no existing appointments, set the start time to the opening time
        $last_appointment_time = $time_sched_start;
    }

    // Calculate the start and end time of the new appointment
    if ($schedule == "Schedule 1") {
        $start_time = max($last_appointment_time, $time_sched_start);
        $end_time = $start_time + (strtotime($service_duration) - strtotime('00:00'));

        $appointment_date = date('F j, Y', strtotime($date_sched));
        $appointment_start_time = date('h:i A', $start_time);
        $appointment_end_time = date('h:i A', $end_time);

        $query = "INSERT INTO appointments (doctor_Id, patient_id, patient_name, email, phone, address, category, service, schedule, appointment_date, appointment_time, time_finish, status) 
                    VALUES ('$doctor_id ', '$id', '$patient_name', '$email', '$phone', '$address', '$categorypick', '$servicepick', '$schedule' ,'$date_sched', '" . date('H:i:s', $start_time) . "', '" . date('H:i:s', $end_time) . "', 'Approved')";

        mysqli_query($con, $query);

        $response = [
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment_date' => $appointment_date,
            'start_time' => $appointment_start_time,
            'end_time' => $appointment_end_time
        ];

        // Redirect to appointment-book.php with the response as a query parameter
        header("location: appointment-book.php?response=" . urlencode(json_encode($response)));
        exit();
    } else if ($schedule == "Schedule 2") {
        $start_time = max($last_appointment_time, $breaktime_end);
        $end_time = $start_time + (strtotime($service_duration) - strtotime('00:00'));

        $appointment_date = date('F j, Y', strtotime($date_sched));
        $appointment_start_time = date('h:i A', $start_time);
        $appointment_end_time = date('h:i A', $end_time);

        $query = "INSERT INTO appointments (doctor_Id, patient_id, patient_name, email, phone, address, category, service, schedule, appointment_date, appointment_time, time_finish, status) 
                     VALUES ('$doctor_id ', '$id', '$patient_name', '$email', '$phone', '$address', '$categorypick', '$servicepick', '$schedule' ,'$date_sched', '" . date('H:i:s', $start_time) . "', '" . date('H:i:s', $end_time) . "', 'Approved')";

        mysqli_query($con, $query);

        $response = [
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment_date' => $appointment_date,
            'start_time' => $appointment_start_time,
            'end_time' => $appointment_end_time
        ];

        // Redirect to appointment-book.php with the response as a query parameter
        header("location: appointment-book.php?response=" . urlencode(json_encode($response)));
        exit();
    }
}
?>
