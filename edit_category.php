<?php
include('config.php');

$id = $_GET['category_id'];

if(isset($_POST['submit']))
{
	$category_name = $_POST['cc_name'];
	$descr = $_POST['ddescription'];
	//image upload

  $msg = "";
  $image = rand().time().$_FILES['image']['name'];
  $imageName=rand().time();
  $target = "assets/upload_images/".basename($image);
  // Valid extension
  $valid_ext = array('png','jpeg','jpg');

  // file extension
  $file_extension = pathinfo($target, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);

  // Check extension
  if(in_array($file_extension,$valid_ext)){

    // Compress Image
    compressImage($_FILES['image']['tmp_name'],$target,30);

  }else{
    echo "Invalid file type.";
  }

	$update = "UPDATE category SET category_name = '$category_name', descr = '$descr', image = '$image'WHERE category_id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:manage_category.php');
	}else{
		 echo ("Error description: " . $con -> error);
	}
}

 // Compress image
function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}
?>