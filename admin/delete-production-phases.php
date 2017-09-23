<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$updateSql = "UPDATE tbl SET Status = '' WHERE ID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: production-phases.php?deactivateSuccess" );
}
else {
	header( "Location: production-phases.php?actionFailed" );
}
?>