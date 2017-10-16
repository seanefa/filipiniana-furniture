<?php
include "dbconnect.php";
$date = new DateTime();
$dateToday = date_format($date, "Y-m-d");
$sql = "SELECT * FROM tblpromos;";
$res = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($res)){
	$promo = date_create($row['promoEnd']);
	$promo = date_format($promo, "Y-m-d");
	if($dateToday >= $promo){
		$sql = "UPDATE tblpromos SET promoStatus = 'Inactive' WHERE promoID ='" .$row['promoID']. "';";
		mysqli_query($conn,$sql);
		prodOnPromo($row['promoID']);
	}
}

function prodOnPromo($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblprodsonpromo WHERE promoDescID = '$id'";
	$res = mysqli_query($conn,$sql1);
	while($row = mysqli_fetch_assoc($res)){
		$sql = "UPDATE tblprodsonpromo SET onPromoStatus = 'Inactive' WHERE onpromoID ='" .$row['onpromoID']. "';";
		mysqli_query($conn,$sql);
	}
	return 0;
}

?>