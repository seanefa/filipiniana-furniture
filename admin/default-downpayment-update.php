<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];
$editDownpayment = $_POST['name'];
$new = $editDownpayment;

$updateSql = "UPDATE tbldownpayment SET downpaymentPercentage='$new' WHERE downpaymentID='1'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>