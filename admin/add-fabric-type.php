<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$weaves = $_POST['weaves'];	
$texture = $_POST['rem'];
$status = "Listed";

$weaves = mysqli_real_escape_string($conn,$weaves);

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
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>