<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['compname'];
$add = $_POST['compadd'];
$telnum = $_POST['telnum'];
$posi = $_POST['posi'];
$conper = $_POST['conper'];
$status = "Listed";

$sql = "INSERT INTO `filfurnituredb`.`tblsupplier` (`supCompName`, `supCompAdd`, `supCompNum`, `supContactPerson`, `supPosition`,`supStatus`) VALUES ('$name', '$add', '$telnum', '$conper', '$posi', '$status');";

if (mysqli_query($conn,$sql)) {
  	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new supplier ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Supplier', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: supplier.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>