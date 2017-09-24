<?php
include "session-check.php";
include 'dbconnect.php';

$type = $_POST['uType'];
$rate = $_POST['uUnit'];
$str = $_POST['attribs'];
$status = "Active";
$flag = 0;

$sql = "INSERT INTO `tblunitofmeasure` (`unType`, `unUnit`, `unStatus`) VALUES('$type','$rate','$status')";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);

foreach($str as $a){
	$sql = "INSERT INTO `tblunit_cat` (`unitID`, `uncategoryID`, `unitcatStatus`) VALUES ('$last_id', '$a','Active')";
	mysqli_query($conn,$sql);
	$flag++;
}

if ($flag>0) {
	// Logs start here
	$sID = $last_id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new unit of measurement ".$type.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Unit of Measurement', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>