<?php
session_start();

include 'dbconnect.php';

session_start();
if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];


$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$updateSql = "UPDATE tblfabric_type SET f_typeStatus = 'Archived'  WHERE f_typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-type.php?deactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>