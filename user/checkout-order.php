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
$orderstat = "WFA";
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
      $prodID = $str;
      if(substr($str, 0,5)=='Promo'){
        $prodID = str_replace('Promo', '', $str);
      }

      $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$prodID','$unitPrice', '$orderid','$sample','".$selectedQuant[$ctr]."','Active')"; 
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
	  

$orderID = str_pad($orderid, 6, '0', STR_PAD_LEFT);
$logDesc = "New order #OR" . $orderID;
$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Order', 'New', '$orderdaterec', '$logDesc', '$employee')";

   $inv = "INSERT INTO `tblinvoicedetails` (`invorderID`, `balance`, `dateIssued`, `invoiceStatus`, `invoiceRemarks`, `invDelrateID`, `invPenID`) VALUES ('$orderid', '$totalPrice', '$orderdaterec', 'Pending', 'Initial Invoice', '1', '1');";
   
   if (mysqli_query($conn,$inv)){
	   if(mysqli_query($conn, $logSQL)){
   $invID = mysqli_insert_id($conn);
  $_SESSION['createSuccess'] = 'Success';
  header( 'Location: account.php');
	   }
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
  header( 'Location: home.php');
  }
}
}

function unitPrice($id){
  include "userconnect.php";
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