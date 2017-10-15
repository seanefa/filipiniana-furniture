<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$name = $_POST['name'];
$edit = $_POST[''];

$updateSql = "UPDATE tblphases SET phaseName='$name' WHERE phaseID=$id";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>