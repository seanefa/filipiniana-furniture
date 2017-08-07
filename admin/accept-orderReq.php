<?php
session_start();

$id = $_POST['id'];
$remarks = $_POST['orderremarks'];
$date = $_POST['pidate'];

include 'dbconnect.php';
$updateSql = "UPDATE tblorders SET orderStatus = 'Pending', orderRemarks =  '$remarks',dateOfRelease = '$date' WHERE orderID = $id";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	header( "Location: orders.php" );
	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>