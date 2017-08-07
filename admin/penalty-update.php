<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editName = $_POST['name'];
$editType = $_POST['type'];
$editRate = $_POST['rate'];
$editRemarks = $_POST['remarks'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblpenalty SET penaltyName='$editName', penaltyRateType='$editType', penaltyRate='$editRate', penaltyRemarks='$editRemarks' WHERE penaltyID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: penalties.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>