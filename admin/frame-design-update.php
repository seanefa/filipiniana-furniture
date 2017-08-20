<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];
$editName = $_POST['name'];
$editDescription = $_POST['desc'];

$updateSql = "UPDATE tblframe_design SET designName='$editName', designDescription='$editDescription' WHERE designID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated frame design ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frame Design', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: frame-design.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>