<?php
session_start();

$receivedate=date("Y/m/d");
$releasedate=$_POST['dateofrelease'];
$id=$_SESSION["userID"];
$address=array($_POST["street"], $_POST["barangay"], $_POST["city"]);
$shippingaddress=implode(", ", $address);
$remarks=$_POST["orderremarks"];

include "userconnect.php";

$sql="INSERT into tblorders(dateOfReceived, dateOfRelease, custOrderID, orderStatus, shippingAddress, orderType, orderRemarks) values('$receivedate', '$releasedate', '$id', 'pending', '$shippingaddress', 'Pre-order', '$remarks')";
$insert=$conn->query($sql);

if($insert)
{
	echo "Okay na, nasa database na.";
	header("Location: receipt.php");
}
else
{
	echo "may mali pa brodie, <b>" . $conn->error . "</b> daw. Ayusin mo na kase! Wag kang tamad.";
}
?>