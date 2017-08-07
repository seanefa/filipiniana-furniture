<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editType = $_POST['type'];
$editName = $_POST['name'];
$editRemarks = $_POST['remarks'];

        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblfurn_category SET categoryName='$editName', categoryRemarks='$editRemarks' WHERE categoryID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: category.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>