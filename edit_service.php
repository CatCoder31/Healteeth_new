<?php
include('config.php');

$id = $_GET['service_id'];

if(isset($_POST['submit']))
{
	$service_name = $_POST['se_name'];
	$service_duration = $_POST['se_duration'];

	$update = "UPDATE services SET service_name = '$service_name', service_duration = '$service_duration' WHERE service_id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:manage_services.php');
	}else{
		 echo ("Error description: " . $con -> error);
	}
}

?>