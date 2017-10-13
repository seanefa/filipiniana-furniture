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

if($mop==1){
	$tendered = $_POST['aTendered'];
	$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$tendered', '$mop', 'Paid');";
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

}
else if($mop==2){
	$number = $_POST['cNumber'];
	$amount = $_POST['cAmount'];
	$remarks = $_POST['remarks'];
	$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$amount', '$mop', 'Paid');";
	//echo $paysql . "<br>";
	mysqli_query($conn,$paysql);
	$pdID = mysqli_insert_id($conn);
	paidInvoice($invID);
	$ch = "INSERT INTO `tblcheck_details` (`p_detailsID`, `checkNumber`, `checkAmount`, `checkRemarks`) VALUES ('$pdID', '$number', '$amount', '$remarks')";
	//echo $ch . "<br>";
	mysqli_query($conn,$ch);
	//header( "Location: receipt.php?id=".$pdID);
	echo '<script type="text/javascript">
	window.open("receipt.php?id='.$pdID.'","_blank")
	</script>';

	echo "<script>
	window.location.href='collections.php';
	alert('Record Saved.');
	</script>";

}

function paidInvoice($id){
	include "dbconnect.php";
	$sql = "SELECT * FROM tblinvoicedetails WHERE invoiceID = '$id'";
	$res = mysqli_query($conn,$sql);
	$total = 0;
	while($row = mysqli_fetch_assoc($res)){
		$total = $row['balance'] + $row['invDelrateID'] + $row['invPenID'];
	}

	$sql = "SELECT * FROM tblpayment_details WHERE invID = '$id'";
	$res = mysqli_query($conn,$sql);
	$paid = 0;
	while($row = mysqli_fetch_assoc($res)){
		$paid = $paid + $row['amountPaid'];
	}

	echo "Total" . $total . "<br>";
	echo "Paid" . $paid . "<br>";
	if($total==$paid){
		echo "true!";
		$invSQL = "UPDATE tblinvoicedetails SET invoiceStatus = 'Paid' WHERE invoiceID = '$id'";
		if(mysqli_query($conn,$invSQL)){
			echo "jksdhkjsa" . $invSQL;
		}
		else{
			echo "Error" . mysqli_error($conn) ;
		}
	}

}

mysqli_close($conn);
?>