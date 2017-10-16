<?php
include "session-check.php";
include 'dbconnect.php';

$custid = "";

if(isset($_POST['customerIds'])){
  $custid = $_POST['customerIds'];
  //echo "<br>customId " . $custid;
}

$isBool = $_POST['isBool'];

$ln = $_POST['lastn'];
$fn = $_POST['firstn'];
$mn = $_POST['midn'];
$addrss = $_POST['custadd'];
$cont = $_POST['custocont'];
$emailadd = $_POST['custoemail'];

$discount = $_POST['discountPercent'];

$delRate = 0;
if(isset($_POST['paydRate'])){
  $delRate = $_POST['paydRate'];
}

$ordershipadd  = "N/A";

if(isset($_POST['deladd'])){
  $ordershipadd = "";
  $add = $_POST['deladd'];
  foreach($add as $a){
    $ordershipadd  = $ordershipadd . $a . " ";
  }
}

$remarks = $_POST['orderremarks'];

$payment = $_POST['aTendered'];
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');
$orderdatepick = $_POST['pidate'];
$orderstat = "Pending";
$ordertype = "Pre-Order";


$forUN = $date->format('m-d');

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

$mop = $_POST['mop'];
$orderid = 0;

$ln = mysqli_real_escape_string($conn,$ln);
$mn = mysqli_real_escape_string($conn,$mn);
$fn = mysqli_real_escape_string($conn,$fn);
$addrss = mysqli_real_escape_string($conn,$addrss);
$cont = mysqli_real_escape_string($conn,$cont);
$remarks = mysqli_real_escape_string($conn,$remarks);
$ordershipadd = mysqli_real_escape_string($conn,$ordershipadd);

//echo $mop;

if($isBool == "new"){
  $sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd')";

  if (mysqli_query($conn, $sql)){
    $custid = mysqli_insert_id($conn); //last id ng na-input na data

    $un = $ln . $forUN;
    $pw = $ln;

    $sqlUser = "INSERT INTO tbluser(userName, userPassword, userStatus, userType, userCustID, dateCreated, confirmedUser) VALUES('$un', '$pw', 'active', 'customer', '$custid', '$orderdaterec','1')";
    mysqli_query($sqlUser);

    $pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
    //echo "<br>orderr: " . $pssql;
    $ctr = 0;
    $P_ctr = 0;
    if (mysqli_query($conn, $pssql)) {
    $orderid = mysqli_insert_id($conn); //last id ng na-input na data
    foreach($selected as $str) {
      $unitPrice = unitPrice($str);
      $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
      mysqli_query($conn,$sql1);
      $orReqID = mysqli_insert_id($conn);
      $sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID','".$selectedQuant[$ctr]."');";
      mysqli_query($conn,$sql3);
      $ctr++;
    }
    
    foreach($P_selected as $P_str) {
      $unitPrice = packPrice($P_str);

     $sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str','$unitPrice', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
     if(mysqli_query($conn,$sql1)){

      $orReqID = mysqli_insert_id($conn);
      $sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID','".$P_selectedQuant[$P_ctr]."');";
      mysqli_query($conn,$sql3);
      $P_ctr++;
      
      $orderReqID = mysqli_insert_id($conn);
      $sql1 = "SELECT * FROM tblpackages a, tblpackage_inclusions b, tblproduct c WHERE c.productID = b.product_incID and b.package_incID = a.packageID and a.packageID = '$P_str'";
      $res1 = mysqli_query($conn,$sql1);
      while($row1 = mysqli_fetch_assoc($res1)){
        $str = $row1['productID'];
        $sql2 = "INSERT INTO `tblpackage_orderreq` (`por_orReqID`, `por_prID`) VALUES ('$orderReqID', '$str');";
        mysqli_query($conn,$sql2);
      }
     }
    }



   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`, `invDiscount`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '$delRate', '0','$discount');";

   //echo "<br>inv: " . $inv;
   mysqli_query($conn,$inv);
   $invID = mysqli_insert_id($conn);

   if($mop==1){
    $tendered = $_POST['aTendered'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    //echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $receiptID = mysqli_insert_id($conn);
    //header( "Location: receipt.php?id=".$receiptID);
    echo '<script type="text/javascript">
        window.open("receipt.php?id='.$receiptID.'","_blank")
        </script>';

    echo "<script>
      window.location.href='orders.php';
      alert('Record Saved.');
      </script>";

  }
  else if($mop==2){
    $number = $_POST['cNumber'];
    $amount = $_POST['cAmount'];
    $remarks = $_POST['remarks'];
    $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$amount', '$mop', 'Paid');";
    //echo $paysql . "<br>";
    mysqli_query($conn,$paysql);
    $pdID = mysqli_insert_id($conn);
    $ch = "INSERT INTO `tblcheck_details` (`p_detailsID`, `checkNumber`, `checkAmount`, `checkRemarks`) VALUES ('$pdID', '$number', '$amount', '$remarks')";
    //echo $ch . "<br>";
    mysqli_query($conn,$ch);
    //header( "Location: receipt.php?id=".$pdID);

    echo '<script type="text/javascript">
        window.open("receipt.php?id='.$pdID.'","_blank")
        </script>';

    echo "<script>
      window.location.href='orders.php';
      alert('Record Saved.');
      </script>";
  }
}
else {
  $_SESSION['actionFailed'] = 'Failed';
  header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}
}
else {
  $_SESSION['actionFailed'] = 'Failed';
  header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}

}

else if($isBool=="existing"){ //EXISTING

   $sql = "UPDATE tblcustomer SET customerLastName='$ln',customerFirstName = '$fn',customerMiddleName='$mn',customerAddress='$addrss', customerContactNum='$cont',customerEmail='$emailadd' WHERE customerID = '$custid'";
   mysqli_query($conn,$sql);

  //echo "<br>EXISTING ";

  $pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
  //echo "<br>pssql" . $pssql;

  if (mysqli_query($conn, $pssql)) {
    $ctr = 0;
    $P_ctr = 0;
    $orderid = mysqli_insert_id($conn);
    //echo "<br>orderID: " . $orderid;
    foreach($selected as $str) {
      $unitPrice = unitPrice($str);
      $prodID = $str;
      if(substr($str, 0,5)=='Promo'){
        $prodID = str_replace('Promo', '', $str);
      }

      $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$prodID','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
      mysqli_query($conn,$sql1);

      $orReqID = mysqli_insert_id($conn);
      $sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID','".$selectedQuant[$ctr]."');";
      mysqli_query($conn,$sql3);
      //echo "<br>sql1: " . $sql1;
      $ctr++;
    }

    foreach($P_selected as $P_str) {
      $unitPrice = packPrice($P_str);

     $sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str','$unitPrice', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
     if(mysqli_query($conn,$sql1)){

      $orReqID = mysqli_insert_id($conn);
      $sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID','".$P_selectedQuant[$P_ctr]."');";
      mysqli_query($conn,$sql3);
      $P_ctr++;

      $orderReqID = mysqli_insert_id($conn);
      $sql1 = "SELECT * FROM tblpackages a, tblpackage_inclusions b, tblproduct c WHERE c.productID = b.product_incID and b.package_incID = a.packageID and a.packageID = '$P_str'";
      $res1 = mysqli_query($conn,$sql1);
      while($row1 = mysqli_fetch_assoc($res1)){
        $str = $row1['productID'];
        $sql2 = "INSERT INTO `tblpackage_orderreq` (`por_orReqID`, `por_prID`) VALUES ('$orderReqID', '$str');";
        mysqli_query($conn,$sql2);
      }
     }
    }

    $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`, `invDiscount`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '$delRate', '0','$discount');";
   //echo "<br>inv: " . $inv;
    mysqli_query($conn,$inv);
    $invID = mysqli_insert_id($conn);
   //echo "Error: " . $inv . "<br>" . mysqli_error($conn);

    if($mop==1){
      $tendered = $_POST['aTendered'];
      $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$payment', '$mop', 'Paid');";
    //echo $paysql . "<br>";
      mysqli_query($conn,$paysql);
      $receiptID = mysqli_insert_id($conn);
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      //header( "Location: receipt.php?id=".$receiptID);

    echo '<script type="text/javascript">
        window.open("receipt.php?id='.$receiptID.'","_blank")
        </script>';

    echo "<script>
      window.location.href='orders.php';
      alert('Record Saved.');
      </script>";

    }
    else if($mop==2){
      $number = $_POST['cNumber'];
      $amount = $_POST['cAmount'];
      $remarks = $_POST['remarks'];
      $paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$amount', '$mop', 'Paid');";
      //echo $paysql . "<br>";
      mysqli_query($conn,$paysql);
      $pdID = mysqli_insert_id($conn);
      $ch = "INSERT INTO `tblcheck_details` (`p_detailsID`, `checkNumber`, `checkAmount`, `checkRemarks`) VALUES ('$pdID', '$number', '$amount', '$remarks')";
      //echo $ch . "<br>";
      //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      mysqli_query($conn,$ch);
      //header( "Location: receipt.php?id=".$pdID);

    echo '<script type="text/javascript">
        window.open("receipt.php?id='.$pdID.'","_blank")
        </script>';

    echo "<script>
      window.location.href='orders.php';
      alert('Record Saved.');
      </script>";
    }

  }
}
$orderID = str_pad($orderid, 6, '0', STR_PAD_LEFT);
$logDesc = "New order #OR" . $orderID;
$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Order', 'New', '$orderdaterec', '$logDesc', '$employee')";
mysqli_query($conn,$logSQL);
//echo $logSQL;

function unitPrice($id){
  include "dbconnect.php";
  if(strpos($id,"Promo")){
    return 0;
  }
  else{
  $price = 0;
  $sql = "SELECT * from tblproduct WHERE productID = '$id'";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $price = $row['productPrice'];
    return $price;
  }
}
  
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