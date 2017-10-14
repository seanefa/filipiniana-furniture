<?php
include "session-check.php";
include 'dbconnect.php';

$orderid = $_POST['updateOrder'];
$exist = $_POST['existRec'];
$delete = "";

if(isset($_POST['deleted'])){
	$delete = $_POST['deleted'];
}

if(!isset($_POST['quan'])){
	$_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}

$quan = $_POST['quan'];
$tPrice = $_POST['price'];

$p = false;

foreach($quan as $q){
	if($q==0){
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else{
		$p = true;
	}
}

if($p){
	$dateD = date_create($_POST['pdDate']);
	$dateD = date_format($dateD,"Y-m-d");

	$rem = $_POST['remarks'];
	$ctr = 0;

//UPDATE ORDER INFO
	$sql = "UPDATE tblorders SET orderPrice = '$tPrice', dateOfRelease = '$dateD', orderRemarks = '$rem' WHERE orderID = $orderid";
	echo "SQL: " . $sql . "<br>";
	mysqli_query($conn,$sql);

	$sql = "UPDATE tblinvoicedetails SET balance = '$tPrice' WHERE invorderID = $orderid";
	echo "SQL: " . $sql . "<br>";
	mysqli_query($conn,$sql);


//UPDATE ORDER REQUEST INFO
	foreach ($exist as $a) {
		$sql = "UPDATE tblorder_request SET orderQuantity = ".$quan[$ctr]." WHERE order_requestID = '$a'";
		echo "SQL: " . $sql . "<br>";
		mysqli_query($conn,$sql);

		$sql = "UPDATE tblorder_requestcnt SET orreq_quantity = ".$quan[$ctr]." WHERE orreq_ID = '$a'";
		echo "SQL: " . $sql . "<br>";
		mysqli_query($conn,$sql);
		$ctr++;
	}

	foreach ($delete as $a) {
		$sql = "UPDATE tblorder_request SET orderRequestStatus = 'Deleted' WHERE order_requestID = $a";
		echo "SQL: " . $sql . "<br>";
		mysqli_query($conn,$sql);


		$sql = "UPDATE tblorder_requestcnt SET orreq_quantity = '0' WHERE orreq_ID = $a";
		mysqli_query($conn,$sql);
		$ctr++;
	}

	if($ctr>0){
		$_SESSION['updateSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
	else {
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
mysqli_close($conn);
?>