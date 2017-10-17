<?php
include "dbconnect.php";

$invID = 0;
$orderID = $_POST['orderID'];
$notifID = $_POST['notifID'];

$sql = "SELECT * FROM tblinvoicedetails WHERE invorderID = '$orderID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$invID = $row['invoiceID'];

$mop = $_POST['mop'];
$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');

$uSQL = "UPDATE tblnotification SET notifStatus = 'Confirmed' WHERE id='$notifID'";
if(mysqli_query($conn,$uSQL)){
	$tendered = $_POST['aTendered'];
	$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$tendered', '$mop', 'Paid');";
	if(mysqli_query($conn,$paysql)){
		$oSQL = "UPDATE tblorders SET orderStatus = 'Pending' WHERE orderID='$orderID'";
		if(mysqli_query($conn,$oSQL)){
		echo "<script>
		window.location.href='dashboard.php';
		alert('Record Saved.');
		</script>";
	}else{
		echo "<script>
		window.location.href='dashboard.php';
		alert('Failed to save record.');
		</script>";
	}
	}
	else{
		echo "<script>
		window.location.href='dashboard.php';
		alert('Failed to save record.');
		</script>";
	}
}
else{
	echo "<script>
	window.location.href='dashboard.php';
	alert('Failed to save record.');
	</script>";
}


//$receiptID = mysqli_insert_id($conn);
	//header( "Location: receipt.php?id=".$receiptID);

// echo '<script type="text/javascript">
// window.open("receipt.php?id='.$receiptID.'","_blank")
// </script>';

echo "<script>
window.location.href='dashboard.php';
alert('Record Saved.');
</script>";
mysqli_close($conn);
?>