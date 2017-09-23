<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$temp = "";
$temp2 = 9;

$updateSql = "UPDATE tblpenalty SET penStatus = 'Archived' WHERE penaltyID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: penalties.php?deactivateSuccess" );
}
else {
	header( "Location: penalties.php?actionFailed" );
}
?>