<?php

include('config.php');
$id = $_GET['id'];
$delete = "DELETE FROM user WHERE id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:manage_patient.php');
}else{
	echo "Do not Delete";
}


?>