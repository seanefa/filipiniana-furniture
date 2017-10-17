<?php
include "session-check.php";
include 'dbconnect.php';

$custid = $_POST['customer'];

$payment = $_POST['aTendered'];
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $orderdaterec;
$orderstat = "Ready for release"; 
$ordertype = "On-Hand";

$discount = $_POST['discountPercent'];

$selected = $_POST['Pcart'];
$selectedQuant = $_POST['Pquant'];
$selectedPrice = $_POST['Pprice'];
$totalPrice = $_POST['PtotalPrice'];

$_SESSION['Pcart'] = $selected;
$_SESSION['Pquant'] = $selectedQuant;
$_SESSION['Pprice'] = $selectedPrice;
$_SESSION['PtotalPrice'] = $totalPrice;
$sample = 'paid';

$delRate = $_POST['dRate'];
$ordershipadd  = "N/A";

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
// echo "<br>pssql" . $pssql;

if (mysqli_query($conn, $pssql)) {
  $ctr = 0;
  $P_ctr = 0;
  $orderid = mysqli_insert_id($conn);
  echo "<br>orderID: " . $orderid;

  foreach($selected as $str) {
    onPromo($str,$orderid,$selectedQuant[$ctr]);
    $unitPrice = unitPrice($str);
    $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Ready for release')"; 
    mysqli_query($conn,$sql1);
    $orReqID = mysqli_insert_id($conn);
    $sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`, `orreq_prodFinish`) VALUES ('$orReqID','".$selectedQuant[$ctr]."','".$selectedQuant[$ctr]."');";
    mysqli_query($conn,$sql3);
    onHandUpdate($str,$selectedQuant[$ctr]);
      // echo "<br>sql1: " . $sql1;
      // echo $sql3;
    $ctr++;
  }


  $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`,`invDiscount`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '$delRate', '0','$discount');";
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

    echo '<script type="text/javascript">
    window.open("receipt.php?id='.$receiptID.'","_blank")
    </script>';

    echo "<script>
    window.location.href='point-of-sales.php';
    alert('Record Saved.');
    </script>";
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
    // header( "Location: receipt.php?id=".$pdID);

    echo '<script type="text/javascript">
    window.open("receipt.php?id='.$receiptID.'","_blank")
    </script>';

    echo "<script>
    window.location.href='point-of-sales.php';
    alert('Record Saved.');
    </script>";
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

function onPromo($id,$orderID,$cnt){
  include "dbconnect.php";
  $prodID = "";
  $sql1 = "SELECT * FROM tblprodsonpromo WHERE prodPromoID = '$id' AND onPromoStatus = 'Active';";
  $res = mysqli_query($conn,$sql1);
  $row = mysqli_num_rows($res);
  if($row==0){
    return 0;
  }
  else{
    echo "onpromo";
    $row1 = mysqli_fetch_assoc($res);
    $promoID = $row1['promoDescID'];
    $sql2 = "SELECT * FROM tblpromos where promoID = '$promoID' AND promoStatus = 'Active';";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $prodID = $row2['tblproductID'];
    $sql3 = "SELECT * from tblonhand WHERE ohProdID = '$prodID' and ohQuantity != 0";
    $res3 = mysqli_query($conn,$sql3);
    $row3 = mysqli_num_rows($res3);
    if($row3==0){
      return 0;
    }
    else{
      echo "onhand";
      $row4 = mysqli_fetch_assoc($res3);
      $ohQuan = $row4['ohQuantity'];
      if($cnt<=$ohQuan){
        $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$prodID','0', '$orderID','Free','$cnt','Ready for release')"; 
        if(!mysqli_query($conn,$sql1)){
          echo mysqli_error($conn);
        }
        $orReqID = mysqli_insert_id($conn);
        $sql4 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`, `orreq_prodFinish`) VALUES ('$orReqID','$cnt','$cnt');";
        if(!mysqli_query($conn,$sql4)){
          mysqli_error($conn);
        }
        onHandUpdate($prodID,$cnt);
      }
    }
  }
}

mysqli_close($conn);

?>