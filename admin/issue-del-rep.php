<?php
include "dbconnect.php";

$recID = $_POST['recID'];

$sql1 = "UPDATE `tbldelivery` SET `deliveryStatus`='Start Delivery' WHERE `deliveryID`='$recID'";
if(mysqli_query($conn,$sql1)){

	$date = new DateTime();
	$date = date_format($date, "Y-m-d");

	$sql = "SELECT * FROM tbldelivery WHERE deliveryID = '$recID'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$emp = $row['deliveryEmpAssigned'];

	$delHistSQL = "INSERT INTO `tbldelivery_history` (`delHist_recID`, `delHistDate`, `delHistDeliveryMan`,`delHistStatus`) VALUES ('$recID', '$date', '$emp','Start Delivery');";
	mysqli_query($conn,$delHistSQL);

	echo '<script type="text/javascript">
	window.open("delivery-receipt.php?id='.$recID.'","_blank")
	</script>';

	echo "<script>
	window.location.href='releasing.php';
	</script>";
	//header("Location: delivery-receipt.php?id=".$recID);
}
else{
	header("Location: releasing.php?actionFailed");
}

?>