<?php
session_start();
$id = $_POST['id'];
$reason = "No reason.";
if($_POST['reason']!=""){
	$reason = $_POST['reason'];
}
include 'dbconnect.php';
$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>