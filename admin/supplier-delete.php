<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}

$jsID = $_GET['id'];

$updateSql = "UPDATE `tblsupplier` SET supStatus='Archived' WHERE supplierID ='$jsID'";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $jsID; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Deactivated supplier ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Supplier', 'Deactivate', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: supplier.php?deactivateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>