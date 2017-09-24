<?php
include "session-check.php";
include 'dbconnect.php';

$iPname = $_POST['iProdName'];
$qty = $_POST['qty'];
$iDesc = $_POST['iDesc'];

$iDesc = mysqli_real_escape_string($conn,$iDesc);

$sql = "INSERT INTO tblprod_inclusions(prodIncQuantity, prodIncDesc, productIncID) VALUES('$qty','$iDesc','$iPname')";
if($sql){
	if (mysqli_query($conn, $sql)) {
		echo $iPname;
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