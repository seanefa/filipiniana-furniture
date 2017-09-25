<?php
include "session-check.php";
include 'dbconnect.php';

$custid = "";

if(isset($_POST['customerIds'])){
  $custid = $_POST['customerIds'];
  echo "<br>customId " . $custid;
}

$selected = $_POST['cart'];
$selectedQuant = $_POST['quant'];
$selectedPrice = $_POST['prices'];
$totalPrice = $_POST['totalPrice'];
$orderid = $_POST['updateOrder'];

$_SESSION['cart'] = $selected;
$_SESSION['quant'] = $selectedQuant;
$_SESSION['price'] = $selectedPrice;
$_SESSION['totalPrice'] = $totalPrice;
$sample = 'Pending';

$ssql = "SELECT orderPrice from tblorders WHERE orderID = '$orderid'";
$res = mysqli_query($conn,$ssql);
$rrow = mysqli_fetch_assoc($res);
$newPrice = $totalPrice + $rrow['orderPrice'];

$pssql = "UPDATE `tblorders` SET `orderPrice` = '$newPrice' WHERE orderID = '$orderid'";
echo "update" . $pssql . "<br>";
mysqli_query($conn,$pssql);

$ctr = 0;
foreach($selected as $str) {
 $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
 mysqli_query($conn,$sql1);
 echo "<br>sql1: " . $sql1;
 $ctr++;
}

if($ctr>0){
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: orders.php');
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: orders.php');
  }
mysqli_close($conn);
?>