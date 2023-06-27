<?php
   require('config.php');

   $sql = "SELECT service_id, service_name, service_price, service_duration FROM services WHERE category_id LIKE '%".$_GET['category_id']."%'"; 

   $result = $con->query($sql);
   
   $json = [];
   while($row = $result->fetch_assoc()){
       $json[$row['service_id']] = array(
           'name' => $row['service_name'],
           'price' => $row['service_price'],
           'duration' => $row['service_duration']
       );
   }
   
   echo json_encode($json);
   
?>