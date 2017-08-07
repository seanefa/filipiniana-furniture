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
$measures = $_POST['intags'];

$measures = substr(trim($measures), 0, -1);

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblmat_type SET matTypeName='$editName', matTypeRemarks='$editDescription', matTypeMeasure='$measures' WHERE matTypeID=$id";

//echo $updateSql;

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-type.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>