<?php
include "dbconnect.php";

$invID = 0;
$orderID = $_POST['orderID'];
$paid = $_POST['paid'];
$sql = "SELECT * FROM tblinvoicedetails WHERE invorderID = '$orderID'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$invID = $row['invoiceID'];

$uOrSQL = "UPDATE tblorders SET orderStatus = 'Pending', orderType = 'Management Order' WHERE orderID = '$orderID'";
mysqli_query($conn,$uOrSQL);
finishOrder($orderID);
addOnHand($orderID);

echo $invID;
echo $paid;
$mop = $_POST['mop'];
$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');

$sqlU = "UPDATE tblpayment_details SET paymentStatus = 'Returned' WHERE invID = '$invID'";
if(!mysqli_query($conn,$sqlU)){
	echo "Error" . mysqli_error($conn);
}

$paysql = "INSERT INTO `tblpayment_details` (`invID`, `dateCreated`, `amountPaid`, `mopID`, `paymentStatus`) VALUES ('$invID', '$orderdaterec', '$paid', '$mop', 'Paid');";
mysqli_query($conn,$paysql);
$receiptID = mysqli_insert_id($conn);
echo '<script type="text/javascript">
window.open("return-receipt.php?id='.$receiptID.'","_blank")
</script>';

echo "<script>
window.location.href='orders.php';
alert('Record Saved.');
</script>";



function finishOrder($id){
	include "dbconnect.php";
	$orderID = $id
	$ordReqCtr = 0;
	$finCtr = 0;
	$orType = "";
	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and a.orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$ordReqCtr++;
		if($row2['orderRequestStatus']=='Ready for release'){
			$finCtr++;
			changeStat($row['order_requestID']);
		}
	}

	$sql2 = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		if($orType!='Management Order'){
			$oSQL = "UPDATE tblorders SET orderStatus ='Ready for release' WHERE orderID = $orderID";
			mysqli_query($conn,$oSQL);
		}
		else{
			$oSQL = "UPDATE tblorders SET orderStatus ='Finished' WHERE orderID = $orderID";
			mysqli_query($conn,$oSQL);
		}
	}
	return 0;
}

function addOnHand($id){
	include "dbconnect.php";

	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and  a.orderID = '$id'";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		if(($row['orderRequestStatus']=='Finished') || ($row['orderRequestStatus']=='Ready for release')){
			$orType = $row2['orderType'];
			$productID = $row2['orderProductID'];
			$quan = $row2['orderQuantity'];
			if($orType!='Management Order'){
				return 0;
			}
			else{
				$ctr = 0;
				$sql3 = "SELECT * FROM tblonhand WHERE ohProdID = '$productID'";
				$res3 = mysqli_query($conn,$sql3);
				$ctr = mysqli_num_rows($res3);
				if($ctr!=0){
					$row = mysqli_fetch_assoc($res3);
					$origCount = $row['ohQuantity'];
					$newCount = $origCount + $quan;
					$sql5 = "UPDATE tblonhand SET ohQuantity = '$newCount' WHERE ohProdID = '$productID'";
					mysqli_query($conn,$sql5);
				}
				else{
					$sql4 = "INSERT INTO `tblonhand` (`ohProdID`, `ohQuantity`) VALUES ('$productID', 1)";
					mysqli_query($conn,$sql4);
				}
			}
		}
	}
	return 0;
}

function changeStat($id){
	include "dbconnect.php";
	$uSQL = "UPDATE tblorder_request SET orderRequestStatus = 'Finished'";
	mysqli_query($conn,$uSQL);
	return 0;
}

mysqli_close($conn);
?>