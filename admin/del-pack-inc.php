<?php
session_start();

if(isset($_GET['id'])){
	$jsID = $_GET['id']; 
}

$jsID=$_GET['id'];

include 'dbconnect.php';
$updateSql = "UPDATE tblpackage_inclusions SET package_incStatus = 'Archived' WHERE package_inclusionID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: packages.php" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>