<?php
include "session-check.php";
include 'dbconnect.php';

$fn = $_POST['fn'];
$mn = $_POST['mn'];
$ln = $_POST['ln'];
$job = $_POST['job'];
$remarks = $_POST['remarks'];
$status = "Active";

$remarks = mysqli_real_escape_string($conn,$remarks);

$sql = "INSERT INTO `tblemployee` (`empFirstName`, `empLastName`, `empMidName`, `empRemarks`, `empStatus`) VALUES ('$fn', '$ln', '$mn','$remarks', '$status')";
echo $sql. "<br>";
$result = mysqli_query($conn,$sql);
$empID = mysqli_insert_id($conn);
echo $empID . "<br>";
echo count($job);

foreach ($job as $j){
	$sql1 = "INSERT INTO `tblemp_job` (`emp_empID`, `emp_jobDescID`, `emp_jobStatus`) VALUES ('$empID', '$j', '$status');";
	mysqli_query($conn,$sql1);
	header( "Location: employees.php?actionFailed" );
}

if ($result) {
  	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new employee ".$fn." ".$mn." ".$ln.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Employees', 'New', '$date', '$logDesc', '$empID')";
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