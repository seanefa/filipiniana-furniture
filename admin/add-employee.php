<?php
	include "dbconnect.php";
	
	$fn = $_POST['fn'];
	$mn = $_POST['mn'];
	$ln = $_POST['ln'];
	$job = $_POST['job'];
	$remarks = $_POST['remarks'];
	$status = "Active";
	
	$sql = "INSERT INTO `tblemployee` (`empFirstName`, `empLastName`, `empMidName`, `empRemarks`, `empStatus`) VALUES ('$fn', '$ln', '$mn','$remarks', '$status')";
	mysqli_query($conn,$sql);
	echo $sql. "<br>";
	$empID = mysqli_insert_id($conn);
	echo $empID . "<br>";

	foreach ($job as $j){
		$sql1 = "INSERT INTO `tblemp_job` (`emp_empID`, `emp_jobDescID`, `emp_jobStatus`) VALUES ('$empID', '$j', '$status');";
		mysqli_query($conn,$sql1);
		echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
		echo $sql1. "<br>";
	}

	header( "Location: employees.php?newSuccess" );
	mysqli_close($conn);
?>