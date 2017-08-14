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
$ordershipadd = $_POST['deladd'];
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

$_SESSION['cart'] = $selected;
$_SESSION['quant'] = $selectedQuant;
$_SESSION['price'] = $selectedPrice;
$_SESSION['totalPrice'] = $totalPrice;
$sample = 'Pending';


$orderid = 0;

if($isBool == "new"){
  $sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd')";
  echo "<br>sql1: " . $sql;

  if (mysqli_query($conn, $sql)){
    $custid = mysqli_insert_id($conn); //last id ng na-input na data

    $pssql = "INSERT INTO `tblorders` (`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
    echo "<br>orderr: " . $pssql;
    $ctr = 0;
    if (mysqli_query($conn, $pssql)) {
    $orderid = mysqli_insert_id($conn); //last id ng na-input na data
      foreach($selected as $str) {
       $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
       mysqli_query($conn,$sql1);
       
      $orderReqID = mysqli_insert_id($conn);
      $prodSQL = "INSERT INTO tblproduction(productionOrderReq,productionStatus) VALUES ('$orderReqID','Pending')";
      mysqli_query($conn,$prodSQL);
      $prID = mysqli_insert_id($conn);
      $phSQL = "INSERT INTO tblproduction_phase(prodID,prodPhase, prodEmp,prodStatus) VALUES ('$prID','0','0','Pending')";
      mysqli_query($conn,$phSQL);
      echo "Error: " . $phSQL . "<br>" . mysqli_error($conn);
       echo "<br>sql1: " . $sql1;
       $ctr++;
   }
   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";//waley pa yung delrate and penalty. :()

  echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);
   $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '1', 'Paid');";
   mysqli_query($conn,$paysql);
   $paymentID = mysqli_insert_id($conn);
  echo "<br>inv: " . $paysql;

    echo '<script type="text/javascript">';
          $loc = "Location: receipt2.php?pID=" .$paymentID. "&id=". $orderid;
          header($loc); 
     echo '</script>';
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
  $orderid = mysqli_insert_id($conn);
  echo "<br>orderID: " . $orderid;
    foreach($selected as $str) {
       $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
       mysqli_query($conn,$sql1);
       echo "<br>sql1: " . $sql1;
       $ctr++;

      $orderReqID = mysqli_insert_id($conn);
      $prodSQL = "INSERT INTO tblproduction(productionOrderReq,productionStatus) VALUES ('$orderReqID','Pending')";
      mysqli_query($conn,$prodSQL);
      $prID = mysqli_insert_id($conn);
      $phSQL = "INSERT INTO tblproduction_phase(prodID,prodPhase, prodEmp,prodStatus) VALUES ('$prID','1','1','Pending')";
      mysqli_query($conn,$phSQL);
      echo "Error: " . $phSQL . "<br>" . mysqli_error($conn);
   }
   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";//waley pa yung delrate and penalty. :()

  echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);
   $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '1', 'Paid');";
   mysqli_query($conn,$paysql);

   $paymentID = mysqli_insert_id($conn);
  echo "<br>inv: " . $paysql;


   echo '<script type="text/javascript">';
          $loc = "Location: receipt2.php?pID=" .$paymentID. "&id=". $orderid;
          header($loc); 
   echo '</script>';

 }
}

mysqli_close($conn);

?>