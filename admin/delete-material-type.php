<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Archived' WHERE matTypeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $jsID; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Deactivated material type ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Type', 'Deactivate', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-type.php?deactivateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>