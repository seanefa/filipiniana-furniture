<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editName = $_POST['name'];
$editRemarks = $_POST['remarks'];

$editRemarks = mysqli_real_escape_string($conn,$editRemarks);

$updateSql = "UPDATE tblframe_material SET materialName='$editName', materialRemarks='$editRemarks' WHERE materialID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated frame material ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frame Material', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: framework-material.php?updateSuccess" );
} else {
	header( "Location: framework-material.php?actionFailed" );
  }
?>