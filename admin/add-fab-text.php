<?php
include "dbconnect.php";
$name = $_POST['name'];
$desc = $_POST['desc'];
$rating = $_POST['rating'];
$status = "Listed";

$sql = "INSERT INTO `tblfabric_texture` (`textureName`,`textureRating`, `textureDescription`, `textureStatus`) VALUES ('$name', '$rating','$desc', '$status')";
if(mysqli_query($conn,$sql)){
	header( "Location: fabric-texture.php?newSuccess" );
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>