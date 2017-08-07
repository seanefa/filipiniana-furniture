<?php
	include "dbconnect.php";
	
	$fn = $_POST['fn'];
	$mn = $_POST['mn'];
	$ln = $_POST['ln'];
	$job = $_POST['job'];
	$remarks = $_POST['remarks'];
	$status = "Active";
	
	$sql = "INSERT INTO `tblemployee` (`empFirstName`, `empLastName`, `empMidName`, `empJobID`, `empRemarks`, `empStatus`) VALUES ('$fn', '$ln', '$mn', '$job', '$remarks', '$status')";
	
	if(mysqli_query($conn,$sql)){
		   header( "Location: employees.php?newSuccess" );
		 } 
		 else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	mysqli_close($conn);
?>