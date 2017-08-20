<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$material = $_POST['material'];
//$remarks = $_POST['remarks'];
$status = "Listed";
$var_desc = $_POST["desc"];
$var_label = $_POST["label"];

$desc = "";
$flag = 0;

$sql = "INSERT INTO `tblmat_var` (`mat_varID`, `variantQuantity`, `variantStatus`) VALUES ('$material', '0', 'Listed');";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);
$ctr = 0;

echo $sql . "<br>";

foreach($var_desc as $x){
	$attrib = $var_label[$ctr];
	$sql = "INSERT INTO `tblvariant_desc` (`varAttribID`, `varMatvarID`, `varVariantDesc`, `varStatus`) VALUES ('$attrib', '$last_id', '$x', 'Listed');";
	$ctr++;
	mysqli_query($conn,$sql);
	echo $sql . "<br>";
	$flag++;
}

if ($flag>0) {
	// Logs start here
	$sID = $last_id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material variant ".$material.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Variants', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-variants.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>