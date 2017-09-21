<?php
include "userconnect.php";
$fn = $_POST["fname"];
$mn = $_POST["mname"];
$ln = $_POST["lname"];
$email = $_POST["email"];
$adr = $_POST["address"];
$cn = $_POST["number"];
$exist_image = $_POST["exist_image"];
$pic = "";

$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$adr= mysqli_real_escape_string($conn, $adr);
$cn= mysqli_real_escape_string($conn, $cn);
$email= mysqli_real_escape_string($conn, $email);

if($_FILES["image"]["error"] > 0){
	echo "Error: NO CHOSEN FILE";
 	echo"INSERT TO DATABASE FAILED";
}
else{
	move_uploaded_file($_FILES["image"]["tmp_name"], "pics/userpictures/" . date('Y-m-d') . time() . ".png");
 	$pic = date('Y-m-d') . time() . ".png";
	header("Location: profile.php");
}
if($pic=="")
{
	$pic = $exist_image;
}
$customersql="UPDATE tblcustomer SET customerFirstName='$fn', customerMiddleName='$mn', customerLastName='$ln', customerAddress='$adr', customerContactNum='$cn', customerEmail='$email', customerDP = '$pic'";

if($conn->query($customersql)==true)
{
	header("Location: profile.php");
}
$conn->close();
?>