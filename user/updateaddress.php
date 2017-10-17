<?php
include "session.php";
include "userconnect.php";
$ar = $_POST["address"];

$ar= $a1.','.$a2.','.$a3.','.$a4.','.$a5.','.$a6.'';
$ar= mysqli_real_escape_string($conn, $ar);

$customersql="UPDATE tblcustomer a join tbluser b SET a.customerAddress='$ar' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: account.php");
}
$conn->close();
?>