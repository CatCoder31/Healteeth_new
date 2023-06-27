<?php

include('config.php');
$id = $_GET['service_id'];
$delete = "DELETE FROM services WHERE service_id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:manage_services.php');
}else{
	echo "Donot Delete";
}


?>