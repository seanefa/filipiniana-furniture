<?php
include "session-check.php";
include 'dbconnect.php';


$ordershipadd  = "For management";
$remarks = $_POST['orderremarks'];

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $_POST['pidate'];
$orderstat = "Pending";
$ordertype = "Management Order";

$selected = $_POST['cart'];
$selectedQuant = $_POST['quant'];
$selectedPrice = $_POST['prices'];
$totalPrice = $_POST['totalPrice'];
$employee = $_SESSION['userID'];

//PACKAGE VARIABLES
$P_selected = $_POST['P_cart'];
$P_selectedQuant = $_POST['P_quant'];
$P_selectedPrice = $_POST['P_prices'];


$_SESSION['P_cart'] = $P_selected;
$_SESSION['P_quant'] = $P_selectedQuant;
$_SESSION['P_price'] = $P_selectedPrice;
//


$_SESSION['cart'] = $selected;
$_SESSION['quant'] = $selectedQuant;
$_SESSION['price'] = $selectedPrice;
$_SESSION['totalPrice'] = $totalPrice;
$sample = 'Pending';

$orderid = 0;
$remarks = mysqli_real_escape_string($conn,$remarks);

$pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','0','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
echo "<br>pssql" . $pssql;

if (mysqli_query($conn, $pssql)) {
  $ctr = 0;
  $P_ctr = 0;
  $orderid = mysqli_insert_id($conn);
  echo "<br>orderID: " . $orderid;
  foreach($selected as $str) {
    $unitPrice = unitPrice($str);
    $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
    mysqli_query($conn,$sql1);
    echo "<br>sql1: " . $sql1;
    $ctr++;
  }

  foreach($P_selected as $P_str) {
    $unitPrice = packPrice($P_str);
    $sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str','$unitPrice', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
    mysqli_query($conn,$sql1);
    $P_ctr++;
  }
}
else{
  header("Location: new-production?actionFailed");
}

$orderID = str_pad($orderid, 6, '0', STR_PAD_LEFT);
$logDesc = "New management order #OR" . $orderID;
$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Order', 'New', '$orderdaterec', '$logDesc', '$employee')";
if(mysqli_query($conn,$logSQL)){
  header("Location: new-production?actionSuccess");
}
else{
  header("Location: new-production?actionFailed");
}
// echo $logSQL;

function unitPrice($id){
  include "dbconnect.php";
  $price = 0;
  $sql = "SELECT * from tblproduct WHERE productID = '$id'";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $price = $row['productPrice'];
  }
  return $price;
}

function packPrice($id){
  include "dbconnect.php";
  $price = 0;
  $sql = "SELECT * from tblpackages WHERE packageID = '$id'";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $price = $row['packagePrice'];
  }
  return $price;
}

mysqli_close($conn);

?>