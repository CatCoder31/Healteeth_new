<?php
include 'config.php';
$start = $_POST['appointment_time'];
$sstart = strtotime($start);
$dstart = date("h:i A", $sstart);
$service = $_POST['servicepick'];
$category = $_POST['categorypick'];

$sql = mysqli_query($con, "SELECT * FROM services WHERE service_id = $service;");
    while($row = mysqli_fetch_array($sql)){
      $servname = $row['service_name'];
      $duration = $row['service_duration'];
      $sduration = strtotime($row['service_duration']);
      $dduration = date("h:i A", $sduration);
    }

$sql1 = mysqli_query($con, "SELECT * FROM category WHERE category_id = $category;");
    while($row = mysqli_fetch_array($sql1)){
      $catname = $row['category_name'];
    }

$sfinish = strtotime($start) + (strtotime($duration) - strtotime('00:00:00'));
$finish = date("H:i", $sfinish);
$dfinish = date("h:i A", $sfinish);
//$finish = TimeSum($start,$duration);
//$sfinish = strtotime($finish);
//$dfinish = date("h:i A", $sfinish);

/*function TimeSum($a,$b){
  list ($hour1, $min1) = explode(':', $a);
  list ($hour2, $min2) = explode(':', $b);
//counting number of minutes and getting extra hours outs
  $total_min= $min1+$min2;
  $sumMin = $total_min%60;
  $extra_hr = ($total_min-$sumMin)/60;
//counting number of hours
  $sumHour = $hour1 + $hour2 + $extra_hr;
  if($sumHour>24)
  {
    $sumHour = $sumHour - 24;
  }
  return $sumHour.':'.$sumMin;
}*/

echo "Category: ".$category;
echo "<br>";
echo "Category: ".$catname;
echo "<br>";
echo "Service: ".$service;
echo "<br>";
echo "Service Name: ".$servname;
echo "<br>";
echo "<br>";
echo "Submitted Value: ".$start;
echo "<br>";
echo "String to Time: ".$sstart;
echo "<br>";
echo "Date Format: ".$dstart;
echo "<br>";
echo "<br>";
echo "Submitted Value: ". $duration;
echo "<br>";
echo "String to Time: ".$sduration;
echo "<br>";
echo "Date Format: ".$dduration;
echo "<br>";
echo "<br>";
echo "End Time: ".$finish;
echo "<br>";
echo "String to Time: ".$sfinish;
echo "<br>";
echo "Date Format: ".$dfinish;
//$sql = mysqli_query($con,"INSERT INTO appointment (cusID, cat_id, serv_id, timeIN, timeOUT) VALUES (1, $category, $service, '$start', '$finish');");
//$con->query($sql);
//header("location: sampletimeform.php");
?>