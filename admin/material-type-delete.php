<?php
session_start();
if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

include 'dbconnect.php';

$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Archived' WHERE matTypeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-type.php?deactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>