<?php
session_start();
include "userconnect.php";

$id = $_GET['id'];

$sql = "UPDATE tblcustomize_request SET customStatus = 'Cancelled' WHERE customizedID = '$id'";
if(mysqli_query($conn,$sql)){
	echo "<script>
	window.location.href='customization.php';
	alert('Successfully cancelled customized request.');
	</script>";
}
else{
	echo "<script>
	window.location.href='customization.php';
	alert('Failed to cancel customized request.');
	</script>";
}

?>