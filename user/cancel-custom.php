<?php
session_start();
include "userconnect.php";

$id = $_GET['id'];
$customerid = $_SESSION["userID"];

$sql = "UPDATE tblcustomize_request SET customStatus = 'Cancelled' WHERE customizedID = '$id'";
$logSQL = "INSERT into tbllogs (`category`, `action`, `date`, `description`, `userID`) values ('Customization', 'Cancelled', '" . date("Y-m-d") . "', 'Customization request $id cancelled', '$customerid')";

if(mysqli_query($conn,$sql)){
	mysqli_query($conn, $logSQL);
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
