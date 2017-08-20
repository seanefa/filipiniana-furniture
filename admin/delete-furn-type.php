<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$updateSql = "UPDATE tblfurn_type SET typeStatus = 'Archived' WHERE typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $jsID; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Deactivated furniture type ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Furniture Type', 'Deactivate', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: furniture-type.php?deactivateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>