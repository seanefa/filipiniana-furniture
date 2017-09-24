<?php
include "session-check.php";
include 'dbconnect.php';

$desc = $_POST['desc'];
$status = "Active";

$desc = mysqli_real_escape_string($conn,$desc);

$sql = "INSERT INTO `tblmodeofpayment` (`modeofpaymentDesc`, `modeofpaymentStatus`) VALUES ('$desc', '$status');";

if($sql){
  if (mysqli_query($conn, $sql)) {
   $_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
mysqli_close($conn);
?>