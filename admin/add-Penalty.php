<?php
include "session-check.php";
include 'dbconnect.php';

$pRate = $_POST['rate'];
$pName = $_POST['name'];
$remarks = $_POST['remarks'];
$type = $_POST['type'];
$status = "Active";

$remarks = mysqli_real_escape_string($conn,$remarks);

$sql = "INSERT INTO `tblpenalty` (`penaltyRate`, `penaltyRemarks`, `penStatus`, `penaltyName`, `penaltyRateType`) VALUES ('$pRate', '$remarks','$status','$pName','$type')";
if($sql){
  if (mysqli_query($conn, $sql)) {
    $_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
  mysqli_close($conn);
}
?>