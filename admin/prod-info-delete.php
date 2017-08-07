<?php
session_start();
if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

include 'dbconnect.php';

$updateSql = "UPDATE tblprod_info SET prodInfoStatus = 'Archived' WHERE prodInfoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: production-information.php?deactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>