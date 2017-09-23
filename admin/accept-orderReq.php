<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['id'];
$remarks = $_POST['orderremarks'];
$date = $_POST['pidate'];

$updateSql = "UPDATE tblorders SET orderStatus = 'Pending', orderRemarks =  '$remarks',dateOfRelease = '$date' WHERE orderID = $id";
if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
	echo '</script>';
}
else {
	header( "Location: orders.php?actionFailed" );
}
?>