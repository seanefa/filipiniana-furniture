<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$edit = $_POST[''];

$updateSql = "UPDATE tbl SET ='', ='$' WHERE ID=$id";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>