<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$updateSql = "UPDATE tblbranches SET branchStatus = 'Archived' WHERE branchID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: branches.php?deactivateSuccess" );
}
else {
	header( "Location: branches.php?actionFailed" );
}
?>