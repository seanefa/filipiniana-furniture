<?php
include "userconnect.php";
$fn = $_POST["fname"];
$mn = $_POST["mname"];
$ln = $_POST["lname"];
$email = $_POST["email"];
$adr = $_POST["address"];
$cn = $_POST["number"];

$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$adr= mysqli_real_escape_string($conn, $adr);
$cn= mysqli_real_escape_string($conn, $cn);
$email= mysqli_real_escape_string($conn, $email);

$customersql="UPDATE tblcustomer SET customerFirstName='$fn', customerMiddleName='$mn', customerLastName='$ln', customerAddress='$adr', customerContactNum='$cn', customerEmail='$email'";

if($conn->query($customersql)==true){
	header("Location: profile.php");
}
$conn->close();
?>