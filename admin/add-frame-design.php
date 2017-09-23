<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$desc = $_POST['desc'];
$status = "Listed";

$desc = mysqli_real_escape_string($conn,$desc);

$sql = "INSERT INTO `tblframe_design` (`designName`, `designDescription`, `designStatus`) VALUES ('$name','$desc', '$status')";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new frame design ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frame Design', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: frame-design.php?newSuccess" );
} else {
	header( "Location: frame-design.php?actionFailed" );
  }
mysqli_close($conn);
?>