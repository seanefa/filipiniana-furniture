<?php

include "dbconnect.php";

$name = $_POST["discount_name"];
$percent = $_POST["discount_percentage"];

$adddiscount = "INSERT into tbldiscounts(discountName, discountPercentage, discountStatus) values('$name', '$percent', 'Active')";

if($conn->query($adddiscount) === true)
{
  	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>