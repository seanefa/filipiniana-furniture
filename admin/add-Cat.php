<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['ctgName'];
$remarks = $_POST['remarks'];
$status = "Listed";

$sql = "INSERT INTO `tblfurn_category` (`categoryName`, `categoryStatus`, `categoryRemarks`) VALUES ('$name', '$status','$remarks');";

if (mysqli_query($conn, $sql)){
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new category ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Category', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: category.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>