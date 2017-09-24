<?php
include "session-check.php"; 
include 'dbconnect.php';

$id = $_POST['id'];
$material = $_POST['material'];
$remarks = $_POST['description'];
$status = "Listed";

$flag = 0;

$updateSql = "UPDATE tblmat_var SET materialID='$material', mat_varDescription='$remarks' WHERE mat_varID=$id;";
mysqli_query($conn,$updateSql);
	$flag++;

//$updateSql = "UPDATE `tblvariant_desc` SET `variantDescription`='$desc', `variantSize`='$size', `variantUnit`='$unit' WHERE `variantID`='$id'";

if($flag>0){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated material variant ".$material.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Variants', 'Update', '$date', '$logDesc', '$empID')";
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