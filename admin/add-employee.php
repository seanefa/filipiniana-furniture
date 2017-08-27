<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$fn = $_POST['fn'];
$mn = $_POST['mn'];
$ln = $_POST['ln'];
$job = $_POST['job'];
$remarks = $_POST['remarks'];
$status = "Active";

$sql = "INSERT INTO `tblemployee` (`empFirstName`, `empLastName`, `empMidName`, `empRemarks`, `empStatus`) VALUES ('$fn', '$ln', '$mn','$remarks', '$status')";
echo $sql. "<br>";
$empID = mysqli_insert_id($conn);
echo $empID . "<br>";

foreach ($job as $j){
	$sql1 = "INSERT INTO `tblemp_job` (`emp_empID`, `emp_jobDescID`, `emp_jobStatus`) VALUES ('$empID', '$j', '$status');";
	mysqli_query($conn,$sql1);
	echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
	echo $sql1. "<br>";
}

if (mysqli_query($conn,$sql)) {
  	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new employee ".$fn." ".$mn." ".$ln.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Employees', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: employees.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>