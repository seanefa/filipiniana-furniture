<?php
session_start();
include "userconnect.php";

$id = $_GET['id'];
$customerid = $_SESSION["userID"];

$sql = "UPDATE tblorders SET orderStatus = 'Cancelled' WHERE orderID = '$id'";
$logSQL = "INSERT into tbllogs (category, action, date, description, userID) values ('Order', 'Cancelled', '" . date("Y-m-d") . "', 'Order request $id cancelled', '$customerid')";
if(mysqli_query($conn,$sql)){
	$conn->query($logSQL);
	echo "<script>
	window.location.href='orders.php';
	alert('Successfully cancelled order request.');
	</script>";
}
else{
	echo "<script>
	window.location.href='orders.php';
	alert('Failed to cancel order request.');
	</script>";
}

?>
