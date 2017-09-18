<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];
$empID = $_POST['employee'];
$editName = $_POST['username'];
$editPassword = $_POST['password'];

$editName = mysqli_real_escape_string($conn,$editName);

$updateSql = "UPDATE tbluser SET userName='$editName', userPassword='$editPassword', userEmpID='$empID' WHERE userID='$id';";

if(mysqli_query($conn,$updateSql)){
	header( "Location: users.php" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>