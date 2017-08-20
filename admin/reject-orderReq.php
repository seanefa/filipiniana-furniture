<?php
session_start();

$id = $_POST['id'];
$reason = "No reason.";
if($_POST['reason']!=""){
	$reason = $_POST['reason'];
}

$flag = 0;
include 'dbconnect.php';
$updateSql = "UPDATE tblorders SET orderStatus = 'Rejected', orderRemarks =  '$reason' WHERE orderID = $id";
if(mysqli_query($conn,$updateSql)){
	$flag++;
}
$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Rejected', '$reason');";
if(mysqli_query($conn,$action)){
	$flag++;
}
if($flag>0){
	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>