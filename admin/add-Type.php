<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['ctgName'];
$cat = $_POST['cat'];
$desc = $_POST['desc'];
$status = "Listed";

$sql = "INSERT INTO `tblfurn_type` (`typeName`, `typeDescription`, `typeStatus`, `typeCategoryID`) VALUES ('$name', '$desc','$status' , '$cat');";

if (mysqli_query($conn, $sql)){
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new furniture type ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Furniture Type', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: furniture-type.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>