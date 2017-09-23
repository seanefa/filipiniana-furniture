<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentStatus = 'Archived' WHERE modeofpaymentID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: mode-of-payment.php?deactivateSuccess" );
}
else {
	header( "Location: mode-of-payment.php?actionFailed" );
}
?>