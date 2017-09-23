<?php
include "session-check.php";
include 'dbconnect.php';

$quan = $_POST['quan'];
$prodID = $_POST['name'];
$eQuan = 0;

$sql = "SELECT * FROM tblproduct WHERE productID ='$prodID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$eQuan = $quan + $row['prodQuantity'];

$updateSql = "UPDATE tblproduct SET prodQuantity='$eQuan', prodStat = 'On-Hand' WHERE productID='$prodID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: product-management.php?updateSuccess" );
}
else {
	header( "Location: product-management.php?actionFailed" );
}
?>