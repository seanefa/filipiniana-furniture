<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['name'];
$weaves = $_POST['weaves'];	
$texture = $_POST['rem'];
$status = "Listed";

$sql = "INSERT INTO `tblfabric_type` (`f_typeName`, `f_typeWeaves`, `f_typeTextureID`, `f_typeStatus`) VALUES ('$name', '$weaves', '$texture', '$status')";

if(mysqli_query($conn,$sql)){
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new fabric type ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Fabric Type', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: fabric-type.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>