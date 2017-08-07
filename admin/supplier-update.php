<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

$id = $_POST['id'];
$name = $_POST['compname'];
$add = $_POST['compadd'];
$telnum = $_POST['telnum'];
$posi = $_POST['posi'];
$conper = $_POST['conper'];
$status = "Listed";

$updateSql = "UPDATE `tblsupplier` SET supCompName='$name', supCompAdd='$add', supCompNum='$telnum', supContactPerson='$conper', supPosition='$posi' WHERE supplierID='$id'";


if(mysqli_query($conn,$updateSql)){
	header( "Location: supplier.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

//echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
?>