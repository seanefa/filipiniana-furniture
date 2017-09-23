<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editBranch = $_POST['branch'];
$editLocation = $_POST['location'];
$editRateType = $_POST['type'];
$editRate = $_POST['rate'];

$updateSql = "UPDATE tbldelivery_rates SET delBranchID='$editBranch', delLocation='$editLocation', delRateType='$editRateType', delRate='$editRate' WHERE delivery_rateID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
    $sID = $id; // ID of last input;
    $date = date("Y-m-d");
    $logDesc = "Updated delivery rate ".$rate.", ID = " .$sID;
    $empID = $_SESSION['userID'];
    $logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Delivery Rates', 'Update', '$date', '$logDesc', '$empID')";
    mysqli_query($conn,$logSQL);
    // Logs end here
	header( "Location: delivery-rates.php?updateSuccess" );
} else {
    header( "Location: delivery-rates.php?actionFailed" );
  }
?>