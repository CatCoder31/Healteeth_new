<?php
include('config.php');

$id = $_POST['idnum'];

   if(isset($_POST['action']))
   {
      $action = $_POST['action'];
       if($action == 'Submit')
       {
           $emailupdt = $_POST['email'];
           $numupdt = $_POST['phone'];
           $addupdt = $_POST['address'];
           $update_data = "UPDATE user SET email_address='$emailupdt', contact_number = '$numupdt', full_address='$addupdt' WHERE id = $id;";
           $run_data = mysqli_query($con,$update_data);
           if($run_data){
               $added = true;
               header('location:user-profile.php');
           }else{
               echo ("Error description: " . $con -> error);
           }
       }
       else if($action == 'Update Password')
       {
           $pwupdt =  md5($_POST['password']);
           $update_pw = "UPDATE user SET password='$pwupdt' WHERE id = $id;";
           $run_pw = mysqli_query($con,$update_pw);
           if($run_pw){
               $added = true;
               header('location:user-profile.php');
           }else{
               echo ("Error description: " . $con -> error);
           }
       }
   }

?>