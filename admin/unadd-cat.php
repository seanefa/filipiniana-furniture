<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['username'];
$remarks = $_POST['remarks'];
$status = "Active";

$sql = "INSERT INTO `tblunitofmeasurement_category` (`uncategoryName`, `uncategoryStatus`, `uncategoryDescription`) VALUES ('$name', '$status','$remarks');";

if (mysqli_query($conn,$sql)) {
  	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new unit of measurement category ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Unit of Measurement Category', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
    $_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>