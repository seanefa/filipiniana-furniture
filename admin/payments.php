<?php
include "dbconnect.php";
$orderID = $_POST['orderID'];
$amount = $_POST['amount'];
$invID = 0;
$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;

$sql = "SELECT * FROM tblinvoicedetails WHERE invorderID = '$orderID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$invID = $row['invoiceID'];

$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$amount', '1', 'Paid');";
mysqli_query($conn,$paysql);

$receiptID = mysqli_insert_id($conn);

if($paysql){
       header( "Location: receipt2.php?".$receiptID);
     } 
     else {
      echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }

mysqli_close($conn);

?>