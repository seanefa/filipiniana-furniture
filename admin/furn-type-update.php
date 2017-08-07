<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editCategory = $_POST['cat'];
$editName = $_POST['name'];
$editDescription = $_POST['desc'];

        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblfurn_type SET typeCategoryID='$editCategory', typeName='$editName', typeDescription='$editDescription' WHERE typeID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: furniture-type.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>