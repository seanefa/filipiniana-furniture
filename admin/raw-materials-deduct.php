<?php
include "session-check.php";
include 'dbconnect.php';

 
$varid = $_SESSION['varid'];
$quan = $_POST['quan1'];
$flag=0;

$sql2 = "SELECT * FROM tblmat_inventory WHERE matVariantID = '$varid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$added = $row2['matVarQuantity'] - $quan;
$sql4 = "UPDATE `tblmat_inventory` SET `matVarQuantity`='$added' WHERE `matVariantID`='$varid'";
mysqli_query($conn, $sql4);
$flag++;

if ($flag>0) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Restock', 'New', '$date', '$logDesc', '$empID')";
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