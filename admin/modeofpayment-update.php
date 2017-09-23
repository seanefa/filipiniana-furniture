<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editDescription = $_POST['desc'];

$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentDesc='$editDescription' WHERE modeofpaymentID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: mode-of-payment.php?updateSuccess" );
}
else {
	header( "Location: mode-of-payment.php?actionFailed" );
}
?>