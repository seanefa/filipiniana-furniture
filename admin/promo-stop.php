<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_GET['id'];
$status = "Inactive";

$sql = "UPDATE tblpromos SET promoStatus = '$status' WHERE promoID = $id";
if(mysqli_query($conn,$sql)){
	$sql2 = "UPDATE tblprodsonpromo SET onPromoStatus = '$status' WHERE promoDescID = $id";
	if(mysqli_query($conn,$sql2)){
		$_SESSION['updateSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		

	}
	else{
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);

	}
}
else{
	$_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);

}

mysqli_close($conn);

?>