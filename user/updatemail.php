<?php
include "session.php";
include "userconnect.php";
$email = $_POST["email"];

$email= mysqli_real_escape_string($conn, $email);

$customersql="UPDATE tblcustomer a join tbluser b SET a.customerEmail='$email' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: account.php");
}
$conn->close();
?>