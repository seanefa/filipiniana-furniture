<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editsRate = $_POST['editsaleRate'];
$editsRemarks = $_POST['editsaleRemarks'];
$editstartDate = $_POST['editstartDate'];
$editendDate = $_POST['editendDate'];

$updateSql = "UPDATE tblsale_details SET saleRate='$editsRate', saleRemarks='$editsRemarks', saleStartDate='$editstartDate', saleEndDate='$editendDate' WHERE saledetailID=$id";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>