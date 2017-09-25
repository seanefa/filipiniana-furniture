<?php
include "session-check.php";
include 'dbconnect.php';

$recID = $_POST['recID'];
$reasons = $_POST['reasons'];
$assessment = $_POST['assessment'];
$estDate = $_POST['estDate'];
$remarks = $_POST['remarks'];

$sql = "UPDATE `tblorder_return` SET `returnReason`='$reasons', `returnAssessment`='$assessment', `returnRemarks`='$remarks', `estDateReleased`='$estDate' WHERE `returnID`='$recID';";
if(mysqli_query($conn,$sql)){
	header( "Location: return-order.php?actionSuccess");
}
else{
	header( "Location: return-order.php?actionFailed");
}
mysqli_close($conn);
?>