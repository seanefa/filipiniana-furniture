<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editFN = $_POST['fn'];
$editMN = $_POST['mn'];
$editLN = $_POST['ln'];
$editJob = $_POST['addJ'];

$editRemarks = $_POST['remarks'];

$editRemarks = mysqli_real_escape_string($conn,$editRemarks);

$updateSql = "UPDATE tblemployee SET empFirstName='$editFN', empMidName='$editMN', empLastName='$editLN', empRemarks='$editRemarks' WHERE empID=$id";

$result = mysqli_query($conn,$updateSql);

$removeJob = $_POST['removeJ'];

foreach ($removeJob as $rj){
	$sql1 = "UPDATE tblemp_job SET emp_jobStatus='Archived' WHERE emp_empID = $id and emp_jobDescID = $rj;";
	mysqli_query($conn,$sql1);
	header( "Location: employees.php?actionFailed" );
}
$status = 'Active';
foreach ($editJob as $j){
	$sql2 = "INSERT INTO `tblemp_job` (`emp_empID`, `emp_jobDescID`, `emp_jobStatus`) VALUES ('$id', '$j', '$status')";
	mysqli_query($conn,$sql2);
	header( "Location: employees.php?actionFailed" );
	echo $sql1. "<br>";
}


if($result){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated employee ".$editFN." ".$editMN." ".$editLN.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Employees', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>