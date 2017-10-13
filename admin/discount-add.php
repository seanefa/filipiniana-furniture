<?php

include "dbconnect.php";

$name = $_POST["discount_name"];
$percent = $_POST["discount_percentage"];

$adddiscount = "INSERT into tbldiscounts(discountName, discountPercentage, discountStatus) values('$name', '$percent', 'Active')";

if($conn->query($adddiscount) === true)
{
	header("Location: discounts.php");
}
else
{
	echo "error, " . $conn->error . "lagyan mo to ng toaster";
}
$conn->close();
?>