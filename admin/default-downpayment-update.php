<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];
$editDownpayment = $_POST['name'];

$updateSql = "UPDATE tbldownpayment SET downpaymentPercentage='$editDownpayment' WHERE downpaymentID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: default-downpayment.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>