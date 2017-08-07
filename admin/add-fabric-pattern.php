<?php
	
	include "dbconnect.php";
	
	$name = $_POST['name'];
	$remarks = $_POST['remarks'];
	$status = "Listed";
	
	$sql = "INSERT INTO `tblfabric_pattern` (`f_patternName`, `f_patternRemarks`, `f_patternStatus`) VALUES ('$name', '$remarks', '$status')";
	
	if (mysqli_query($conn, $sql)) {
		   header( "Location: fabric-pattern.php?newSuccess" );

		 } 
		 else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	
?>