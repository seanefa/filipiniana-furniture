<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editBranch = $_POST['branch'];
$editLocation = $_POST['location'];
$editRateType = $_POST['type'];
$editRate = $_POST['rate'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tbldelivery_rates SET delBranchID='$editBranch', delLocation='$editLocation', delRateType='$editRateType', delRate='$editRate' WHERE delivery_rateID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: delivery-rates.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>