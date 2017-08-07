<?php
include "dbconnect.php";
$ = $_POST[''];
$status = "Listed";

$sql = "INSERT INTO `tbl` (``, ``, ``) VALUES ('$', '$', '$')";
if(mysqli_query($conn,$sql)){
	header( "Location: production-phases.php?newSuccess" );
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>