<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editDescription = $_POST['desc'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentDesc='$editDescription' WHERE modeofpaymentID=$id";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: mode-of-payment.php" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>