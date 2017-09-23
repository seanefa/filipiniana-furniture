<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$temp = "";
$temp2 = 9;

$updateSql = "UPDATE tblsale_details SET saleStatus = null WHERE saledetailID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: saledetails.php?deactivateSuccess" );
}
else {
	header( "Location: saledetails.php?actionFailed" );
}
?>