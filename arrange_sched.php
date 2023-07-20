<?php
include 'config.php';
function useInterval($apptstart, $apptend){
	$index = count($apptstart);
	$max_set = array();
	$prev_time = 0;

	for($i = 0; $i<$index; $i++){
		if($apptstart[$i] >= $prev_time)
		{
			array_push($max_set, $i);
			$prev_time = $apptend[$i];
		}
	}
	return $max_set;
}


//AND status = 'Pending';
$sql = mysqli_query($con, "SELECT * FROM appointments WHERE appointment_date=CURRENT_DATE;");
    while($row = mysqli_fetch_array($sql)){
        $start[] = strtotime($row['appointment_time']);
        $finish[] = strtotime($row['time_finish']);
    }
$result = useInterval($start, $finish);

foreach($result as $i){
	$apptid = $i+1;
	$sql = mysqli_query($con, "UPDATE appointments SET status = 'Approved' WHERE id = $apptid;");
}
header("location:view_appointment.php");
?>