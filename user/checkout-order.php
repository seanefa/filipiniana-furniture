<?php
include 'userconnect.php';
session_start();

$custid = "";

if(isset($_SESSION['custID'])){
  
  echo "<br>customId " . $custid;
}
$custid = $_SESSION['custID'];
$isBool = 'existing';

echo "<br>isBool " . $isBool;

$ln = $_POST['lastn'];
$fn = $_POST['firstn'];
$mn = $_POST['midn'];
$addrss = $_POST['custadd'];
$cont = $_POST['custocont'];
$emailadd = $_POST['custoemail'];

$ordershipadd  = "N/A. This order is for pick-up";

if(isset($_POST['deladd'])){
  $ordershipadd = "";
  $add = $_POST['deladd'];
  foreach($add as $a){
    $ordershipadd  = $ordershipadd . $a . " ";
  }
}

$remarks = $_POST['orderremarks'];

$payment = 0;
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $orderdaterec;
$orderstat = "Pending";
$ordertype = "Pre-Order";

$selected = $_POST['cart'];
$selectedQuant = $_POST['quant'];
$selectedPrice = $_POST['prices'];
$totalPrice = $_POST['tPrice'];
$employee = 1;

//PACKAGE VARIABLES
$P_selected = $_POST['P_cart'];
$P_selectedQuant = $_POST['P_quant'];
$P_selectedPrice = $_POST['P_prices'];


$_SESSION['P_cart'] = $P_selected;
$_SESSION['P_quant'] = $P_selectedQuant;
$_SESSION['P_price'] = $P_selectedPrice;
//$totalPrice = $_SESSION['total_price'];
//


$_SESSION['cart'] = $selected;
$_SESSION['quant'] = $selectedQuant;
$_SESSION['price'] = $selectedPrice;
//$_SESSION['totalPrice'] = $totalPrice;
$sample = 'Pending';

$mop = 1;
$orderid = 0;

$ln = mysqli_real_escape_string($conn,$ln);
$mn = mysqli_real_escape_string($conn,$mn);
$fn = mysqli_real_escape_string($conn,$fn);
$addrss = mysqli_real_escape_string($conn,$addrss);
$cont = mysqli_real_escape_string($conn,$cont);
$remarks = mysqli_real_escape_string($conn,$remarks);
$ordershipadd = mysqli_real_escape_string($conn,$ordershipadd);


if($isBool=="existing"){ //EXISTING


  echo "<br>EXISTING ";

  $pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";

  echo " ".mysqli_error($conn);
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


   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";
   echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);
   echo "Error: " . $inv . "<br>" . mysqli_error($conn);
   header( "Location: home.php");
/*
   if($mop==1){
    $tendered = $_POST['aTendered'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $receiptID = mysqli_insert_id($conn);
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    header( "Location: receipt.php?id=".$receiptID);

  }
  else if($mop==2){
    $number = $_POST['cNumber'];
    $amount = $_POST['cAmount'];
    $remarks = $_POST['remarks'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$amount', '$mop', 'Paid');";
    echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $pdID = mysqli_insert_id($conn);
    $ch = "INSERT INTO `tblcheck_details` (`p_detailsID`, `checkNumber`, `checkAmount`, `checkRemarks`) VALUES ('$pdID', '$number', '$amount', '$remarks')";
    echo $ch . "<br>";
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    mysqli_query($conn,$ch);
    header( "Location: receipt.php?id=".$pdID);
  }
  */
}
}
$orderID = str_pad($orderid, 6, '0', STR_PAD_LEFT);
$logDesc = "New order #OR" . $orderID;
$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Order', 'New', '$orderdaterec', '$logDesc', '$employee')";
mysqli_query($conn,$logSQL);
echo $logSQL;

function unitPrice($id){
  include "userconnect.php";
  $price = 0;
  $sql = "SELECT * from tblproduct WHERE productID = '$id'";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $price = $row['productPrice'];
  }
  return $price;
}

function packPrice($id){
  include "userconnect.php";
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