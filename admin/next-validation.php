<?php
include "dbconnect.php";

$t = $_POST['t'];

if($t==0){
	$num = $_POST['id'];
	$sql = "SELECT *, COUNT(customerID) AS num FROM tblcustomer WHERE customerContactNum = '$num';";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	if($row['num']>0){
		echo "This number already exists in records";
	}
}
if($t==1){
	$email = $_POST['id'];
	$sql = "SELECT *, COUNT(customerID) AS num FROM tblcustomer WHERE customerEmail = '$email';";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	if($row['num']>0){
		echo "This email address is already in use";
	}
}
?>