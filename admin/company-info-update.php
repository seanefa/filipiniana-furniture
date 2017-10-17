<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$address = $_POST['address'];
$num = $_POST['number'];
$abt=$_POST['about'];
$email=$_POST['email'];
$emailpass=$_POST['epass'];
$pic = "";

$exist_image = $_POST["exist_image"];

$sql = "SELECT * from tblcompany_info;";
$result = $conn->query($sql);
$row = $result->num_rows;
$oldimage = $row["comp_logo"];

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/logo/" . date('Y-m-d') . time() . ".png");
 echo "SAVED" ;
 $pic = date('Y-m-d') . time() . ".png";
}



if($pic=="")
{
  $pic = $exist_image;
}

// echo $pic;
// echo $exist_image;

if($row == 0)
{
	$exec = "INSERT INTO `tblcompany_info` (`comp_recID`, `comp_logo`, `comp_name`, `comp_num`, `comp_email`, `comp_address`, `comp_about`, 'comp_emailPassword') VALUES ('1', '$pic', '$name', '$num', '$address', '$email', '$abt', '$emailpass')";
}
else
{
  if($pic=="")
  {
  	$pic = $exist_image;
  }
  $exec = "UPDATE `tblcompany_info` SET `comp_logo`='$pic', `comp_name`='$name', `comp_num`='$num', `comp_email`='$email', `comp_address`='$address', `comp_about`='$abt', `comp_emailPassword`='$emailpass' WHERE `comp_recID`=1";
}

if(mysqli_query($conn,$exec))
{
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
$conn->close();
?>