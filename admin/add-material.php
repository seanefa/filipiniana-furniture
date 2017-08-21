<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['name'];
$remarks = $_POST['remarks'];
$status = "Listed";

$sql = "INSERT INTO `tblframe_material` (`materialName`, `materialRemarks`, `materialStatus`) VALUES ('$name', '$remarks','$status')";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new frame material ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frame Material', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: framework-material.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>