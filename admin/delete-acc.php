<?php
include "session-check.php";
include 'dbconnect.php';

$updateSql = "UPDATE tbluser SET userStatus = null WHERE userID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['deactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>