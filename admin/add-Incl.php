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
    	header( "Location: products.php?newSuccess" );
	} 
	else {
		header( "Location: products.php?actionFailed" );
	}

	mysqli_close($conn);
}
?>