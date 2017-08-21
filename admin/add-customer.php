<?php

include 'dbconnect.php';
session_start();

$custid = "";

if(isset($_POST['customerIds'])){
  $custid = $_POST['customerIds'];
  echo "<br>customId " . $custid;
}

$isBool = $_POST['isBool'];

echo "<br>isBool " . $isBool;

$ln = $_POST['lastn'];
$fn = $_POST['firstn'];
$mn = $_POST['midn'];
$addrss = $_POST['custoadd'];
$cont = $_POST['custocont'];
$emailadd = $_POST['custoemail'];
$add = $_POST['deladd'];
$remarks = $_POST['orderremarks'];

$payment = $_POST['aTendered'];
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $_POST['pidate'];
$orderstat = "Pending";
$ordertype = "Pre-Order";

$selected = $_POST['cart'];
$selectedQuant = $_POST['quant'];
$selectedPrice = $_POST['prices'];
$totalPrice = $_POST['totalPrice'];
$employee = $_POST['emp'];

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

$mop = $_POST['mop'];
$orderid = 0;

foreach($add as $a){
  $ordershipadd  = $ordershipadd . $a . " ";
}

if($isBool == "new"){
  $sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd')";
  echo "<br>sql1: " . $sql;

  if (mysqli_query($conn, $sql)){
    $custid = mysqli_insert_id($conn); //last id ng na-input na data

    $pssql = "INSERT INTO `tblorders` (`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
    echo "<br>orderr: " . $pssql;
    $ctr = 0;
    $P_ctr = 0;
    if (mysqli_query($conn, $pssql)) {
    $orderid = mysqli_insert_id($conn); //last id ng na-input na data
    foreach($selected as $str) {
     $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
     mysqli_query($conn,$sql1);
     $ctr++;
   }
   foreach($P_selected as $P_str) {
     $sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
     mysqli_query($conn,$sql1);
     $P_ctr++;
   }



   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";//waley pa yung delrate and penalty. :()

   echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);

   if($mop==1){
    $tendered = $_POST['aTendered'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $receiptID = mysqli_insert_id($conn);
    header( "Location: receipt2.php?id=".$receiptID);

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
    mysqli_query($conn,$ch);
    header( "Location: receipt2.php?id=".$pdID);
  }
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

else if($isBool=="existing"){ //EXISTING


  echo "<br>EXISTING ";

  $pssql = "INSERT INTO `tblorders` (`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
  echo "<br>pssql" . $pssql;

  if (mysqli_query($conn, $pssql)) {
    $ctr = 0;
    $P_ctr = 0;
    $orderid = mysqli_insert_id($conn);
    echo "<br>orderID: " . $orderid;
    foreach($selected as $str) {
     $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
     mysqli_query($conn,$sql1);
     echo "<br>sql1: " . $sql1;
     $ctr++;
   }
   foreach($P_selected as $P_str) {
     $sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
     mysqli_query($conn,$sql1);
     $P_ctr++;
   }


   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";//waley pa yung delrate and penalty. :()
   echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);
   if($mop==1){
    $tendered = $_POST['aTendered'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $receiptID = mysqli_insert_id($conn);
    header( "Location: receipt2.php?id=".$receiptID);

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
    mysqli_query($conn,$ch);
    header( "Location: receipt2.php?id=".$pdID);
  }

 }
}

mysqli_close($conn);

?>