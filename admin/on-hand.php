<?php
session_start();
include 'dbconnect.php';

$category = $_POST['func'];

if($category=="new"){
$quan = $_POST['quan'];
$prodID = $_POST['prod'];

$updateSql = "UPDATE tblproduct SET prodQuantity='$quan', prodStat = 'On-Hand' WHERE productID='$prodID'";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: product-management.php?newSuccess" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

else if($category=="add"){
$quan = $_POST['quan'];
$prodID = $_POST['name'];
$eQuan = 0;

$sql = "SELECT * FROM tblproduct WHERE productID ='$prodID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$eQuan = $quan + $row['prodQuantity'];

$updateSql = "UPDATE tblproduct SET prodQuantity='$eQuan', prodStat = 'On-Hand' WHERE productID='$prodID'";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: product-management.php?updateSuccess" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

else if($category=="deduct"){
$quan = $_POST['quan'];
$prodID = $_POST['name'];
$eQuan = 0;

$sql = "SELECT * FROM tblproduct WHERE productID ='$prodID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$eQuan = $row['prodQuantity'] - $quan;

$updateSql = "UPDATE tblproduct SET prodQuantity='$eQuan', prodStat = 'On-Hand' WHERE productID='$prodID'";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: product-management.php?updateSuccess" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}


?>