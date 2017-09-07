<?php
include "session-check.php"; 
include 'dbconnect.php';
session_start();

$id = $_POST['id'];
$material = $_POST['material'];
$remarks = $_POST['remarks'];
$status = "Listed";

$flag = 0;

$updateSql = "UPDATE tblmat_var SET materialID='$material', mat_varDescription='$remarks' WHERE mat_varID=$id;";
	$flag++;

//$updateSql = "UPDATE `tblvariant_desc` SET `variantDescription`='$desc', `variantSize`='$size', `variantUnit`='$unit' WHERE `variantID`='$id'";

if($ctr>0){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated material variant ".$material.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Variants', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-variants.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>