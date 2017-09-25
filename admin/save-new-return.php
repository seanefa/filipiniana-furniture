<?php
include "dbconnect.php";
$orderID = $_POST['order'];
$orderReqs = $_POST['orderReqs'];
$reDate = $_POST['reDate'];
$reasons = $_POST['reasons'];
$assessment = $_POST['assessment'];
$estDate = $_POST['estDate'];
$remarks = $_POST['remarks'];

$sql = "INSERT INTO `tblorder_return` (`tblorderReqID`, `dateReturned`, `returnReason`, `returnAssessment`, `returnRemarks`, `estDateReleased`, `returnStatus`) VALUES ('$orderReqs', '$reDate', '$reasons', '$assessment', '$remarks', '$estDate', 'Pending');";
if(mysqli_query($conn,$sql)){
	$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Active' WHERE order_requestID = '$orderReqs'";
	mysqli_query($conn,$sql1);
	$sql2 = "UPDATE tblorders SET orderStatus = 'Pending WHERE orderID = '$orderID'";
	mysqli_query($conn,$sql2);
	header( "Location: return-order.php?actionSuccess");
}
else{
	header( "Location: return-order.php?actionFailed");
}
mysqli_close($conn);
?>