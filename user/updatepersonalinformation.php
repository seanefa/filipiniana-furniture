<?php
include "session.php";
include "userconnect.php";
$fn = $_POST["fname"];
$mn = $_POST["mname"];
$ln = $_POST["lname"];
$cn = $_POST["number"];
$exist_image = $_POST["exist_image"];
$pic = "";

$getdata = "SELECT * from tblcustomer where customerStatus = 'Active'";
$datapool = $conn->query($getdata);
$row = $datapool->fetch_assoc();


$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$cn= mysqli_real_escape_string($conn, $cn);

if($_FILES["image"]["error"] > 0){
	header("Location: account.php");
}
else{
	move_uploaded_file($_FILES["image"]["tmp_name"], "pics/userpictures/" . $fn . $mn . $ln . ".png");
 	$pic = $fn . $mn . $ln . ".png";
	header("Location: account.php");
}
if($pic=="")
{
	$pic = $exist_image;
}

$customersql="UPDATE tblcustomer a join tbluser b SET a.customerFirstName='$fn', a.customerMiddleName='$mn', a.customerLastName='$ln', a.customerContactNum='$cn', a.customerDP = '$pic' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

$logs = "INSERT into tbllogs(category, action, date, description, userID) values('Customer', 'Update', '" . date("Y-m-d") . "', '$customerID', " . $_SESSION["userID"] . ")";

if($conn->query($customersql)==true)
{
	$conn->query($logs);
	header("Location: account.php");
}
$conn->close();
?>
