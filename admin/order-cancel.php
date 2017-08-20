<?php
session_start();
$id = $_POST['id'];
$flag = 0;
$reason = "No reason.";
if($_POST['reason']!=""){
	$reason = $_POST['reason'];
}
include 'dbconnect.php';

$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
mysqli_query($conn,$updateSql);
//echo $updateSql;
$flag++;

$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Cancelled', '$reason');";
//echo $action;
mysqli_query($conn,$action);
$flag++;

if($flag){
	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>