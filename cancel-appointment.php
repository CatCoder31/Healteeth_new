<?php
include 'config2.php';
$user_id=$_SESSION['id'];
$appoint_id = $_POST['appointid'];
$reason_cancel = $_POST['reason_cancel'];
$insert_data = "UPDATE appointments SET status = 'Cancelled', cancel_reason = '$reason_cancel' WHERE patient_id = '$user_id' AND id = '$appoint_id';";
$run_data = mysqli_query($con,$insert_data);

if($run_data){
 $added = true;
 header("location:appointment-list.php");
}else{
 echo ("Error description: " . $con -> error);
}


?>