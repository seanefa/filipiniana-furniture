<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$desc = $_POST['desc'];
$measures = "measuring is on materials.";
$status = "Listed";

$measures = substr(trim($measures), 0, -1);

$desc = mysqli_real_escape_string($conn,$desc);

$sql = "INSERT INTO `tblmat_type` (`matTypeName`, `matTypeRemarks`,`matTypeMeasure`, `matTypeStatus`) VALUES ('$name','$desc','$measures','$status');";
echo $sql . "<br>";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material type ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Type', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-type.php?newSuccess" );
} else {
	header( "Location: material-type.php?actionFailed" );
  }
mysqli_close($conn);
?>