<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_POST['id'];
$material = $_POST['material'];
$remarks = $_POST['remarks'];
$status = "Listed";

$var_desc = $_POST["desc"];
$var_label = $_POST["label"];

$desc = "";
$flag = 0;
$ctr = 0;

foreach($var_desc as $x){
	$attrib = $var_label[$ctr];
	$updateSql = "UPDATE `tblvariant_desc` SET `varVariantDesc`='$x' WHERE `varMatvarID` = '$id' AND `varAttribID` = '$attrib'";
	echo $updateSql . "<br>";
	$ctr++;
	mysqli_query($conn,$updateSql);
}

if(isset($remarks)){
	$sql = "UPDATE tblmat_var SET variantRemarks = '$remarks' WHERE variantID = '$id'";
	mysqli_query($conn,$sql);
}

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