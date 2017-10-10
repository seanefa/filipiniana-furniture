<?php
session_start();
include "userconnect.php";

$bc = $_POST["branchcode"];
$ap = $_POST["amountpaid"];
$dp = $_POST["datepaid"];
$oi = $_POST["orderid"];
$id= $_SESSION["ID"];
$photo = "";

echo $id;
echo $photo;

$bc= mysqli_real_escape_string($conn, $bc);
$ap= mysqli_real_escape_string($conn, $ap);
$dp= mysqli_real_escape_string($conn, $dp);
$oi= mysqli_real_escape_string($conn, $oi);



$data = "SELECT * from tbluser where userID = '$id';";
$result = mysqli_query($conn,$data);
$row = mysqli_fetch_assoc($result);
$customerID = $row['userCustID'];

if($_FILES["receiptphoto"]["error"] > 0){
	
}
else{
	move_uploaded_file($_FILES["receiptphoto"]["tmp_name"], "pics/paymentproof/" . date("Y-m-d") . time() . ".png");
	$photo = date("Y-m-d") . time() . ".png";
}

$sendproofofpayment = "INSERT into tblnotification(tblcustomerID,tblorderID, amountPaid, datePaid, bankBranch, proofPicture, notifStatus) values('$customerID','$oi', '$ap', '$dp', $bc', '$photo','Pending')";

if($conn->query($sendproofofpayment) === true){
	header("Location: account.php");
}
else{
	echo "query:" . $sendproofofpayment . "<br>error:" . $conn->error;
	echo "<br><br> customerID value: ";
	echo $customerID;
}
$conn->close();
?>