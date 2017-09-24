<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$remarks = $_POST['remarks'];
$status = "Listed";

$remarks = mysqli_real_escape_string($conn,$remarks);

$sql = "INSERT INTO `tblfabric_pattern` (`f_patternName`, `f_patternRemarks`, `f_patternStatus`) VALUES ('$name', '$remarks', '$status')";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new fabric pattern ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Fabric Pattern', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>