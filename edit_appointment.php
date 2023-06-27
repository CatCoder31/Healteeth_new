<?php
include('config.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$status = $_POST['stats'];
	$timedelay = $_POST['timedel'];
	if($status=='')
	{	
		$update = "UPDATE appointments SET status = '$status' WHERE id = $id;";
		$run_update = mysqli_query($con,$update);

		if($run_update){
			header('location:view_appointment.php');
		}else{
			 echo ("Error description:	 " . $con -> error);
		}
	}
	else if($status=="Done")
	{	
		$update = "UPDATE appointments SET status = '$status' WHERE id = $id;";
		$run_update = mysqli_query($con,$update);
		$update_data = "UPDATE appointments SET appointment_time = DATE_ADD(appointment_time, INTERVAL $timedelay MINUTE),time_finish = DATE_ADD(time_finish, INTERVAL $timedelay MINUTE) WHERE appointment_date = CURRENT_DATE AND status = 'Approved';";
		$run_data = mysqli_query($con,$update_data);

		if($run_update){
			$added = true;
			header('location:view_appointment.php');
		}else{
			echo ("Error description: " . $con -> error);
		}
	}
	else if($status=="No Show")
	{	
		$update = "UPDATE appointments SET status = '$status' WHERE id = $id;";
		$run_update = mysqli_query($con,$update);

		if($run_update){
			header('location:view_appointment.php');
		}else{
			 echo ("Error description: " . $con -> error);
		}
	}

}

?>