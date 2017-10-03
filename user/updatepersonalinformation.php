<?php
include "session.php";
include "userconnect.php";
$fn = $_POST["fname"];
$mn = $_POST["mname"];
$ln = $_POST["lname"];
$cn = $_POST["number"];
$exist_image = $_POST["exist_image"];
$pic = "";

$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$cn= mysqli_real_escape_string($conn, $cn);

if($_FILES["image"]["error"] > 0){
	header("Location: account.php");
}
else{
	move_uploaded_file($_FILES["image"]["tmp_name"], "pics/userpictures/" . date('Y-m-d') . time() . ".png");
 	$pic = date('Y-m-d') . time() . ".png";
	header("Location: account.php");
}
if($pic=="")
{
	$pic = $exist_image;
}
$customersql="UPDATE tblcustomer a join tbluser b SET a.customerFirstName='$fn', a.customerMiddleName='$mn', a.customerLastName='$ln', a.customerContactNum='$cn', a.customerDP = '$pic' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: account.php");
}
$conn->close();
?>