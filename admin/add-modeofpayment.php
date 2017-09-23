<?php
include "session-check.php";
include 'dbconnect.php';

$desc = $_POST['desc'];
$status = "Active";

$desc = mysqli_real_escape_string($conn,$desc);

$sql = "INSERT INTO `tblmodeofpayment` (`modeofpaymentDesc`, `modeofpaymentStatus`) VALUES ('$desc', '$status');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: mode-of-payment.php?newSuccess" );
  } 
  else {
    header( "Location: mode-of-payment.php?actionFailed" );
  }
}
mysqli_close($conn);
?>