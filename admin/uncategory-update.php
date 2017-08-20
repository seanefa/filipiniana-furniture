<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];
$editType = $_POST['type'];
$editName = $_POST['name'];
$editRemarks = $_POST['remarks'];

$updateSql = "UPDATE tblunitofmeasurement_category SET uncategoryName='$editName', uncategoryDescription='$editRemarks' WHERE uncategoryID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated unit of measurement category ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Unit of Measurement Category', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: unit-of-measurement-category.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>