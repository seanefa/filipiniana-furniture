<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editfName = $_POST['ename'];
$editfremarks= $_POST['eremarks'];
        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$editfremarks = mysqli_real_escape_string($conn,$editfremarks);

$updateSql = "UPDATE tblfabric_pattern SET f_patternName='$editfName', f_patternRemarks='$editfremarks' WHERE f_patternID= '$id'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-pattern.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>