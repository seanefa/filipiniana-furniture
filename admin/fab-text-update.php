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
$editDescription = $_POST['desc'];
$rating = $_POST['rating'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblfabric_texture SET textureName='$editName', textureRating='$rating', textureDescription='$editDescription' WHERE textureID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-texture.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>