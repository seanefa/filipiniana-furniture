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
$editRemarks = $_POST['remarks'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblframe_material SET materialName='$editName', materialRemarks='$editRemarks' WHERE materialID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: framework-material.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>