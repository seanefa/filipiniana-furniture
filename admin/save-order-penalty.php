<?php
include "dbconnect.php";

$invID = 0;
$orderID = $_POST['orderID'];
$sql = "SELECT * FROM tblinvoicedetails WHERE invorderID = '$orderID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$invID = $row['invoiceID'];

$mop = $_POST['mop'];
$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');
$tendered = $_POST['aTendered'];
$paysql = "UPDATE tblinvoicedetails SET invPenID = '$tendered' WHERE invoiceID = '$invID'";
mysqli_query($conn,$paysql);
echo "<script>
window.location.href='collections.php';
alert('Record Saved.');
</script>";
mysqli_close($conn);
?>