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
$editWeaves = $_POST['weaves'];
$editTexture= $_POST['texture'];
        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblfabric_type SET f_typeName='$editName', f_typeWeaves='$editWeaves', f_typeTextureID='$editTexture' WHERE f_typeID= '$id'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-type.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>