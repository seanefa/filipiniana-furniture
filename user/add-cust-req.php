<?php
session_start();
include "userconnect.php";
$array = json_decode(stripslashes($_POST['arr']));

$arraycount = count($array);
$customerid = $_SESSION['userID'];
$desc = $_POST['descr'];

$date = date("Y-m-d");
$time = time();

$desc = mysqli_real_escape_string($conn,$desc);


$sql = "INSERT INTO `tblcustomize_request` (`tblcustomerID`,`customizedDescription`, `customStatus`,`dateRequest`) VALUES ('$customerid','$desc', 'WFA','$date')";
if(mysqli_query($conn,$sql)){
$cid = mysqli_insert_id($conn);

foreach ($array as $a) {
	$a = mysqli_real_escape_string($conn,$a);
	$sql1 = "INSERT INTO `tblcust_req_images` (`cust_req_ID`,`cust_req_images`) VALUES ('$cid','$a')";
	if(!mysqli_query($conn,$sql1)){
		echo "Error" . mysqli_error($conn);
	}
}

echo 'okay na';
}

?>