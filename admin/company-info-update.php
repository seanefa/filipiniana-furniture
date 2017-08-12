<?php
session_start();
include 'dbconnect.php';

$id = $_SESSION["varname"];

$name = $_POST['name'];
$address = $_POST['address'];
$num = $_POST['number'];
$abt=$_POST['about'];
$email=$_POST['email'];
$pic = "";
$exist_image = $_POST["exist_image"];

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED" ;
 $pic = date("Y-m-d") . time() . ".png";
}

$sql = "SELECT * from tblcompany_info;";
$result = mysqli_query($conn,$sql);
$row = mysqli_num_rows($result);

if($row == 0)
{
	$insertSql = "INSERT INTO `tblcompany_info` (`comp_logo`, `comp_name`, `comp_num`, `comp_address`, `comp_about`, `comp_email`) VALUES ('$pic', '$name', '$num', '$address', '$abt', '$email')";
}
else
{
	if($pic=="")
	{
		$pic=$exist_image;
	}
	//create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$updateSql = "UPDATE `tblcompany_info` SET `comp_logo`='$pic', `comp_name`='$name', `comp_num`='$num', `comp_address`='$address', `comp_about`='$abt', `comp_email`='$email' WHERE `comp_recID`=$id";
}

if(mysqli_query($conn, $updateSql))
{
	header("Location: company-information.php");
}
else if(mysqli_query($conn, $insertSql))
{
	header("Location: company-information.php");
}
else 
{
	echo "Error: " . $exec . "<br>" . mysqli_error($conn);
}
?>