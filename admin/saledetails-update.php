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
	header( "Location: saledetails.php?updateSuccess" );
}
else {
	header( "Location: saledetails.php?actionFailed" );
}
?>