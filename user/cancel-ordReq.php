<?php
session_start();
include "userconnect.php";

$id = $_GET['id'];

$sql = "UPDATE tblorders SET orderStatus = 'Cancelled' WHERE orderID = '$id'";
if(mysqli_query($conn,$sql)){
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