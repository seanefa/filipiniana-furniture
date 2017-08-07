<?php
include "dbconnect.php";
$name = $_POST['name'];
$desc = $_POST['desc'];
$status = "Listed";

$sql = "INSERT INTO `tblfabric_texture` (`textureName`, `textureDescription`, `textureStatus`) VALUES ('$name', '$desc', '$status')";
if(mysqli_query($conn,$sql)){
	header( "Location: fabric-texture.php?newSuccess" );
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>