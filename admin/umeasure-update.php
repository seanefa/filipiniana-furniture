<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editType = $_POST['unType'];
$editUnit = $_POST['unUnit'];


  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblunitofmeasure SET unType='$editType', unUnit='$editUnit' WHERE unID=$id;";

if(mysqli_query($conn,$updateSql)){
	header( "Location: unit-of-measurement.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>