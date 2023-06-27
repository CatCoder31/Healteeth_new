<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$full_name = $_POST['f_name'];
	$email_address = $_POST['e_mail'];
	$contact_number = $_POST['c_num'];
	$full_address = $_POST['a_ddress'];

	$update = "UPDATE user SET full_name = '$full_name', email_address = '$email_address', contact_number = '$contact_number', full_address = '$full_address' WHERE id=$id AND role in ('Doctor','Staff') ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:manage_user.php');
	}else{
		 echo ("Error description: " . $con -> error);
	}
}

?>