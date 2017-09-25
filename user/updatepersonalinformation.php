<?php
include "session.php";
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
	header("Location: profile.php");
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
$customersql="UPDATE tblcustomer a join tbluser b SET a.customerFirstName='$fn', a.customerMiddleName='$mn', a.customerLastName='$ln', a.customerAddress='$adr', a.customerContactNum='$cn', a.customerEmail='$email', a.customerDP = '$pic' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: profile.php");
}
$conn->close();
?>