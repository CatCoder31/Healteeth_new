<?php
include('config.php');

$id = $_POST['idnum'];

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'Submit') {
        $emailupdt = $_POST['email'];
        $numupdt = $_POST['phone'];
        $addupdt = $_POST['address'];
        $bdayupdt = $_POST['birthdate'];
        $genderupdt = $_POST['gender'];
        $medhisupdt = $_POST['medical_history'];
        $langupdt = $_POST['language'];
        $emercontupdt = $_POST['emergency_contact'];
        //$commupdt = $_POST['comments_and_questions'];

        // Use prepared statements to prevent SQL injection
        $update_data = "UPDATE user SET email_address=?, contact_number=?, full_address=?, birth_date=?, gender=?, language=?, emergency_contact=?, medical_history=? WHERE id = ?";
        $stmt = $con->prepare($update_data);
        $stmt->bind_param('ssssssssi', $emailupdt, $numupdt, $addupdt, $bdayupdt, $genderupdt, $langupdt, $emercontupdt, $medhisupdt, $id);
        $run_data = $stmt->execute();

        if ($run_data) {
            $added = true;
            header('Location: user-profile.php');
            exit(); // Terminate script execution after redirect
        } else {
            echo "Error description: " . $stmt->error;
        }
    } else if ($action == 'Update Password') {
        $newPassword = $_POST['password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Use prepared statements to prevent SQL injection
        $update_pw = "UPDATE user SET password=? WHERE id = ?";
        $stmt = $con->prepare($update_pw);
        $stmt->bind_param('si', $hashedPassword, $id);
        $run_pw = $stmt->execute();

        if ($run_pw) {
            $added = true;
            header('Location: user-profile.php');
            exit(); // Terminate script execution after redirect
        } else {
            echo "Error description: " . $stmt->error;
        }
    }
}
?>