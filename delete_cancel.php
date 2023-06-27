<?php

include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM appointments WHERE id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:cancel_appointment.php');
}else{
	echo "Donot Delete";
}


?>