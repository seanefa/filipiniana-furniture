<?php
include "dbconnect.php";

$recID = $_POST['recID'];

$sql1 = "UPDATE `tbldelivery` SET `deliveryStatus`='Start Delivery' WHERE `deliveryID`='$recID'";
if(mysqli_query($conn,$sql1)){
	header("Location: delivery-receipt.php?id=".$recID);
}
else{
	header("Location: releasing.php?actionFailed");
}

?>