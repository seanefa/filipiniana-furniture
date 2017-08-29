<?php
include "session-check.php";
include 'dbconnect.php';

$custid = $_POST['customer'];

$payment = $_POST['aTendered'];
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $orderdaterec;
$orderstat = "Pending"; 
$ordertype = "On-Hand";

$selected = $_POST['Pcart'];
$selectedQuant = $_POST['Pquant'];
$selectedPrice = $_POST['Pprice'];
$totalPrice = $_POST['PtotalPrice'];

$_SESSION['Pcart'] = $selected;
$_SESSION['Pquant'] = $selectedQuant;
$_SESSION['Pprice'] = $selectedPrice;
$_SESSION['PtotalPrice'] = $totalPrice;
$sample = 'paid';

$ordershipadd  = "N/A. This order is for pick-up";

if(isset($_POST['deladd'])){
  $add = $_POST['deladd'];
  foreach($add as $a){
    $ordershipadd  = $ordershipadd . $a . " ";
  }
}

$mop = $_POST['mop'];
$employee = $_SESSION['userID'];
$remarks = "An order.";


$pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
echo "<br>pssql" . $pssql;

if (mysqli_query($conn, $pssql)) {
  $ctr = 0;
  $P_ctr = 0;
  $orderid = mysqli_insert_id($conn);
  echo "<br>orderID: " . $orderid;

  foreach($selected as $str) {
    $unitPrice = unitPrice($str);
    $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Ready for release')"; 
    mysqli_query($conn,$sql1);
    onHandUpdate($str,$selectedQuant[$ctr]);
    echo "<br>sql1: " . $sql1;
    $ctr++;
  }


  $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";
  echo "<br>inv: " . $inv;
  mysqli_query($conn,$inv);
  $invID = mysqli_insert_id($conn);
  echo "Error: " . $inv . "<br>" . mysqli_error($conn);

  if($mop==1){
    $tendered = $_POST['aTendered'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $receiptID = mysqli_insert_id($conn);
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
}
else{
  //echo "Error: " . $pssql . "<br>" . mysqli_error($conn);
  echo "<script>
      window.location.href='point-of-sales.php';
      alert('Record not saved. There are some errors on the data');
      </script>";

}

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

function onHandUpdate($id,$qnt){
  include "dbconnect.php";
  $quant = 0;
  $sql = "SELECT * from tblonhand WHERE ohProdID = '$id'";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $quant = $row['ohQuantity'];
  }
  $quant = $quant - $qnt;
  $uSQL = "UPDATE tblonhand SET ohQuantity = '$quant' WHERE ohProdID = '$id';";
  mysqli_query($conn,$uSQL);
  echo "quant " . $quant . "<br>";
}

mysqli_close($conn);

?>