<?php
session_start();
include "userconnect.php";

$bc = $_POST["branchcode"];
$ap = $_POST["amountpaid"];
$dp = $_POST["datepaid"];
$oi = $_POST["orderid"];
$photo = "";


$bc= mysqli_real_escape_string($conn, $bc);
$ap= mysqli_real_escape_string($conn, $ap);
$dp= mysqli_real_escape_string($conn, $dp);
$oi= mysqli_real_escape_string($conn, $oi);

$data = "SELECT * from tbluser a join tblcustomer b where a.userCustID = b.customerID AND a.userID = " . $_SESSION["userID"] . "";
$result = $conn->query($data);
$row = $result->num_rows;
$customerID = $row["customerID"];

if($_FILES["receiptphoto"]["error"] > 0){
	
}
else{
	move_uploaded_file($_FILES["receiptphoto"]["tmp_name"], "pics/paymentproof/" . date("Y-m-d") . time() . ".png");
	$pic = date("Y-m-d") . time() . ".png";
}

$sendproofofpayment = "INSERT into tblnotification(tblcustomerID, amountPaid, bankBranch, proofPicture) values('$customerID', '$ap', '$bc', '$photo')";

if($conn->query($sendproofofpayment) === true){
	header("Location: profile.php");
}
else{
	echo "query:" . $sendproofofpayment . "<br>error:" . $conn->error;
	echo "<br><br> SESSION value: ";
	echo $customerID;
}
$conn->close();
?>