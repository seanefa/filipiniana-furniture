<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editFN = $_POST['fn'];
$editMN = $_POST['mn'];
$editLN = $_POST['ln'];
$editJob = $_POST['job'];
$editRemarks = $_POST['remarks'];

  // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblemployee SET empFirstName='$editFN', empMidName='$editMN', empLastName='$editLN', empRemarks='$editRemarks' WHERE empID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: employees.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>