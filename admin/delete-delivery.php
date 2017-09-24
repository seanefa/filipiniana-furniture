<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($GET['id'])){
	$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$temp = "";
$temp2 = 9;

$updateSql = "UPDATE tbldelivery_rates SET delRateStatus = 'Archived' WHERE delivery_rateID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
    $sID = $jsID; // ID of last input;
    $date = date("Y-m-d");
    $logDesc = "Deactivated delivery rate ".$rate.", ID = " .$sID;
    $empID = $_SESSION['userID'];
    $logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Delivery Rates', 'Deactivate', '$date', '$logDesc', '$empID')";
    mysqli_query($conn,$logSQL);
    // Logs end here
	$_SESSION['deactivateSuccess'] = 'Success';
    header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
    header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>