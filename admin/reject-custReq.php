<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['id'];
$reason = "No reason.";
if($_POST['reason']!=""){
	$reason = $_POST['reason'];
}

$flag = 0;

$updateSql = "UPDATE tblcustomize_request SET customStatus = 'Rejected' WHERE customizedID = $id";
if(mysqli_query($conn,$updateSql)){
	$flag++;
}
$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Rejected Customization', '$reason');";
if(mysqli_query($conn,$action)){
	$flag++;
}
if($flag>0){
	echo '<script type="text/javascript">';
	header( "Location: dashboard.php" );
	echo 'alert("SUCCESSFULLY REJECTED ORDER!")';
	echo '</script>';
}
else {
	header( "Location: dashboard.php" );
}
?>