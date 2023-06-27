<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$status = $_POST['stats'];

	$update = "UPDATE appointments SET status = '$status' WHERE id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:pending_appointment.php');
	}else{
		 echo ("Error description: " . $con -> error);
	}
}

?>