<?php
session_start();
include 'dbconnect.php';

$category = $_POST['func'];

if($category=="new"){
$quan = $_POST['quan'];
$prodID = $_POST['prod'];

$updateSql = "INSERT INTO `tblonhand` (`ohProdID`, `ohQuantity`) VALUES ('$prodID', '$quan')";

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

$sql = "SELECT * FROM tblonhand WHERE ohProdID ='$prodID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$eQuan = $quan + $row['ohQuantity'];

$updateSql = "UPDATE tblonhand SET ohQuantity='$eQuan' WHERE ohProdID='$prodID'";

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

$sql = "SELECT * FROM tblonhand WHERE ohProdID ='$prodID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$eQuan = $row['ohQuantity'] - $quan;

$updateSql = "UPDATE tblonhand SET ohQuantity='$eQuan' WHERE ohProdID='$prodID'";

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