<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editDescription = $_POST['desc'];

$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentDesc='$editDescription' WHERE modeofpaymentID=$id";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>