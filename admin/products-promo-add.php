<?php
include "session-check.php";
include 'dbconnect.php';

$promo = $_POST['promoedit'];
$status = "Active";
$flag = 0;

if(isset($_POST['allProd'])){

	$sql = "SELECT * from tblproduct where prodStat != 'Archived' and productID NOT IN (SELECT productID from tblproduct a, tblprodsonpromo b WHERE a.productID = b.prodPromoID and b.onPromoStatus = 'Active');";
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)){
	$sql1 = "INSERT INTO `tblprodsonpromo` (`prodPromoID`, `promoDescID`, `onPromoStatus`) VALUES ('".$row['productID']."', '$promo','$status');";
	mysqli_query($conn,$sql1);
	echo $sql1 . "<br>";
	$flag++;
	}
}
else{
$prods = $_POST['onPromoProd'];
foreach($prods as $a){
	$sql = "INSERT INTO `tblprodsonpromo` (`prodPromoID`, `promoDescID`, `onPromoStatus`) VALUES ('$a', '$promo','$status');";
	mysqli_query($conn,$sql);
	$flag++;
	echo $sql . "<br>";
}
}

 if ($flag>0) {
   $_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

mysqli_close($conn);

?>