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
    header( "Location: penalties.php?newSuccess" );
  } 
  else {
    header( "Location: penalties.php?actionFailed" );
  }
  mysqli_close($conn);
}
?>