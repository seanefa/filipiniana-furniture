<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editCategory = $_POST['cat'];
$editName = $_POST['name'];
$editDescription = $_POST['desc'];

$editDescription = mysqli_real_escape_string($conn,$editDescription);

$updateSql = "UPDATE tblfurn_type SET typeCategoryID='$editCategory', typeName='$editName', typeDescription='$editDescription' WHERE typeID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated furniture type ".$editName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Furniture Type', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>