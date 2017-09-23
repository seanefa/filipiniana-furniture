<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['id'];
$name = $_POST['compname'];
$add = $_POST['compadd'];
$telnum = $_POST['telnum'];
$posi = $_POST['posi'];
$conper = $_POST['conper'];
$status = "Listed";

$updateSql = "UPDATE `tblsupplier` SET supCompName='$name', supCompAdd='$add', supCompNum='$telnum', supContactPerson='$conper', supPosition='$posi' WHERE supplierID='$id'";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated supplier ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Supplier', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: supplier.php?updateSuccess" );
} else {
	header( "Location: supplier.php?actionFailed" );
  }
?>