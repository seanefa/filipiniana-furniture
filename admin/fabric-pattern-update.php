<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editfName = $_POST['ename'];
$editfremarks= $_POST['eremarks'];

$editfremarks = mysqli_real_escape_string($conn,$editfremarks);

$updateSql = "UPDATE tblfabric_pattern SET f_patternName='$editfName', f_patternRemarks='$editfremarks' WHERE f_patternID= '$id'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>