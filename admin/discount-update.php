<?php

include "dbconnect.php";

$id = $_POST["id"];
$discountname = $_POST["discount_name"];
$discountpercent = $_POST["discount_percentage"];

$updatediscount = "UPDATE tbldiscounts SET discountName='$discountname', discountPercentage='$discountpercent' where discountID = '$id'";

if($conn->query($updatediscount) === true)
{
	header("Location: discounts.php");
}
else
{
	echo "Query: " . $updatediscount . "<br> Error: " . $conn->error();
}
$conn->close();
?>