<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($_GET['id'])){
	$jsID = $_GET['id']; 
}

$jsID=$_GET['id'];

include 'dbconnect.php';
$updateSql = "UPDATE tblpackage_inclusions SET package_incStatus = 'Archived' WHERE package_inclusionID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['deactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>