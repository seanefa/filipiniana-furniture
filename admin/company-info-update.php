<?php
session_start();
include 'dbconnect.php';

$name = $_POST['name'];
$address = $_POST['address'];
$num = $_POST['number'];
$abt=$_POST['about'];
$email=$_POST['email'];
$pic = "";

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED" ;
 $pic = date("Y-m-d") . time() . ".png";

}

if($pic=="")
{
	$pic = $exist_image;
}

$sql = "SELECT * from tblcompany_info;";
$result = mysqli_query($conn,$sql);
$row = mysqli_num_rows($result);
$exec = "";

if($row == 0){
	$exec = "INSERT INTO `tblcompany_info` (`comp_recID`, `comp_logo`, `comp_name`, `comp_num`, `comp_email`, `comp_address`, `comp_about`) VALUES ('1', '$pic', '$name', '$num', '$address', '$abt')";
}
else{
	$exec = "UPDATE `tblcompany_info` SET `comp_logo`='$pic', `comp_name`='$name', `comp_num`='$num', `comp_email`='$email', `comp_address`='$address', `comp_about`='$abt' WHERE `comp_recID`='1'";

}

if(mysqli_query($conn,$exec))
{
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: company-information.php" );
	echo '</script>';
}
else
{
	echo "Error: " . $exec . "<br>" . mysqli_error($conn);
}

?>
