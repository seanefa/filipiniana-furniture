<?php
include "dbconnect.php";
$name = $_POST['name'];
$weaves = $_POST['weaves'];	
$texture = $_POST['rem'];
$status = "Listed";

$sql = "INSERT INTO `tblfabric_type` (`f_typeName`, `f_typeWeaves`, `f_typeTextureID`, `f_typeStatus`) VALUES ('$name', '$weaves', '$texture', '$status')";
if(mysqli_query($conn,$sql)){
	header( "Location: fabric-type.php?newSuccess" );
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>