<?php

include('config.php');
$id = $_GET['category_id'];
$delete = "DELETE FROM category WHERE category_id = $id";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:manage_category.php');
}else{
	echo "Donot Delete";
}


?>