<?php
include "dbconnect.php";

$invID = 0;
$orderID = $_POST['orderID'];
$paid = $_POST['paid'];
$sql = "SELECT * FROM tblinvoicedetails WHERE invorderID = '$orderID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$invID = $row['invoiceID'];

$mop = $_POST['mop'];
$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');

	$tendered = $_POST['aTendered'];
	$sql = "SELECT * FROM tblpayment_details WHERE invID = '$invID'";
	$res = mysqli_query($conn,$sql);
	$paid = 0;
	while($row = mysqli_fetch_assoc($res)){
		$sqlU = "UPDATE * tblpayment_details SET paymentStatus = 'Returned' WHERE '" . $row['payment_detailsID']. "'";
		mysqli_query($conn,$sqlU);
	}

	$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$paid', '$mop', 'Paid');";
	//echo $paysql . "<br>";
	mysqli_query($conn,$paysql);
	$receiptID = mysqli_insert_id($conn);
	//header( "Location: receipt.php?id=".$receiptID);
	paidInvoice($invID);
	echo '<script type="text/javascript">
	window.open("receipt.php?id='.$receiptID.'","_blank")
	</script>';

	echo "<script>
	window.location.href='collections.php';
	alert('Record Saved.');
	</script>";

mysqli_close($conn);
?>