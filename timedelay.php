<?php
include('config.php');

if(isset($_POST['tdelay']))
{
	$timedelay = $_POST['tdelay'];
	$update_data = "UPDATE appointments SET appointment_time = DATE_ADD(appointment_time, INTERVAL $timedelay MINUTE),time_finish = DATE_ADD(time_finish, INTERVAL $timedelay MINUTE) WHERE appointment_date = CURRENT_DATE AND status = 'Approved';";
	$run_data = mysqli_query($con,$update_data);

	if($run_data){
		$added = true;
		header('location:view_appointment.php');
	}else{
		echo ("Error description: " . $con -> error);
	}
}

?>