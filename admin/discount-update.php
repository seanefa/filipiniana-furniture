<?php

include "dbconnect.php";

$id = $_POST["id"];
$discountname = $_POST["discount_name"];
$discountpercent = $_POST["discount_percentage"];

$updatediscount = "UPDATE tbldiscounts SET discountName='$discountname', discountPercentage='$discountpercent' where discountID = '$id'";

if($conn->query($updatediscount) === true)
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