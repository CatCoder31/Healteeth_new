<?php
include('config.php');

$id = $_GET['service_id'];

if(isset($_POST['submit']))
{
	$service_name = $_POST['se_name'];
	$service_price = $_POST['se_price'];

	$update = "UPDATE services SET service_name = '$service_name', service_price = '$service_price' WHERE service_id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:manage_services.php');
	}else{
		 echo ("Error description: " . $con -> error);
	}
}

?>