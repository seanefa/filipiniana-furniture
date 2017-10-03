<?php
include "session.php";
include "userconnect.php";
$adr = $_POST["address"];

$adr= mysqli_real_escape_string($conn, $adr);

$customersql="UPDATE tblcustomer a join tbluser b SET a.customerAddress='$adr' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: account.php");
}
$conn->close();
?>