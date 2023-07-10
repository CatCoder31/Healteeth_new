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

    // Check for existing schedule
    $query = "SELECT * FROM schedule WHERE date_sched = ? AND doctor_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $schedule, $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $date_sched = $row['date_sched'];
        $time_sched_start = strtotime($row['time_sched_start']);
        $time_sched_end = strtotime($row['time_sched_end']);
        $breaktime_start = strtotime($row['breaktime_start']);
        $breaktime_end = strtotime($row['breaktime_end']);

        // Get service duration
        $query = "SELECT * FROM services WHERE service_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $servicepick);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $service_duration = $row['service_duration'];

            // Get the last appointment time for the selected schedule
            $query = "SELECT * FROM appointments WHERE appointment_date = ? AND doctor_id = ? AND status = 'Approved' ORDER BY time_finish DESC LIMIT 1";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ss", $date_sched, $doctor_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $last_appointment_time = strtotime($row['time_finish']);
            } else {
                // If there are no existing appointments, set the start time to the opening time
                $last_appointment_time = $time_sched_start;
            }

            // Calculate the start and end time of the new appointment
            $start_time = max($last_appointment_time, $time_sched_start);
            $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
            $end_time = $start_time + $service_duration_seconds;

            // Check if $end_time exceeds $breaktime_start
            if ($end_time > $breaktime_start) {
                // Calculate the start and end time of the new appointment
                $start_time = max($last_appointment_time, $breaktime_end);
                $service_duration_seconds = strtotime($service_duration) - strtotime('00:00:00');
                $end_time = $start_time + $service_duration_seconds;
            }

            // Check if $end_time exceeds $time_sched_end
            if ($end_time > $time_sched_end) {
                // Reject the appointment
                $response = [
                    'success' => false,
                    'message' => 'Appointment cannot be scheduled as it exceeds the closing time.'
                ];

                // Redirect to appointment-book.php with the response as a query parameter
                header("location: appointment-book.php?response=" . urlencode(json_encode($response)));
                exit();
            }

            // Insert the new appointment into the database
            $query = "INSERT INTO appointments (doctor_id, patient_id, patient_name, email, phone, address, category, service, appointment_date, appointment_time, time_finish, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Approved')";
            
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssss", $doctor_id, $id, $patient_name, $email, $phone, $address, $categorypick, $servicepick, $date_sched, date('H:i:s', $start_time), date('H:i:s', $end_time));
            mysqli_stmt_execute($stmt);

            $appointment_date = date('F j, Y', strtotime($date_sched));
            $appointment_start_time = date('h:i A', $start_time);
            $appointment_end_time = date('h:i A', $end_time);

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
}
?>