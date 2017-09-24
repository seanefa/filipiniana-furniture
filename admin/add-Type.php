<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['ctgName'];
$cat = $_POST['cat'];
$desc = $_POST['desc'];
$status = "Listed";

$desc = mysqli_real_escape_string($conn,$desc);

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
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>