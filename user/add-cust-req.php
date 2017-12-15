<?php
session_start();
include "userconnect.php";
$array = json_decode(stripslashes($_POST['arr']));

$arraycount = count($array);
$customerid = $_SESSION['userID'];

$data = "SELECT * from tbluser a, tblcustomer b where a.userCustID = b.customerID AND a.userID = '$customerid'";
$result = mysqli_query($conn,$data);
$row = mysqli_fetch_assoc($result);
$customerid = $row["customerID"];

$desc = $_POST['descr'];

$date = date("Y-m-d");
$time = time();

$desc = mysqli_real_escape_string($conn,$desc);


$sql = "INSERT INTO `tblcustomize_request` (`tblcustomerID`,`customizedDescription`, `customStatus`,`dateRequest`) VALUES ('$customerid','$desc', 'WFA','$date')";
$logSQL = "INSERT into tbllogs(category, action, date, description, userID) values('Customization', 'New', '$date', 'New customization', '$customerid')";

if(mysqli_query($conn,$sql))
{
	$cid = mysqli_insert_id($conn);
	mysqli_query($conn, $logSQL);
	foreach ($array as $a) {
		$a = mysqli_real_escape_string($conn,$a);
		$sql1 = "INSERT INTO `tblcust_req_images` (`cust_req_ID`,`cust_req_images`) VALUES ('$cid','$a')";
		if(!mysqli_query($conn,$sql1))
		{
			echo "Error" . mysqli_error($conn);
		}
	}
	echo 'okay na';
}else{
	echo "Error" . mysqli_error($conn);
}
?>