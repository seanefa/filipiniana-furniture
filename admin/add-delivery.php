<?php
include "session-check.php";
include 'dbconnect.php';

$branch = $_POST['branch'];
$location = $_POST['location'];
$type = $_POST['type'];
$rate = $_POST['rate'];
$status = "Listed";

$sql = "INSERT INTO `tbldelivery_rates` (`delBranchID`, `delLocation`, `delRateType`, `delRate`, `delRateStatus`) VALUES('$branch','$location','$type','$rate','$status')";

if (mysqli_query($conn, $sql)) {
    // Logs start here
    $sID = mysqli_insert_id($conn); // ID of last input;
    $date = date("Y-m-d");
    $logDesc = "Added new delivery rate ".$rate.", ID = " .$sID;
    $empID = $_SESSION['userID'];
    $logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Delivery Rates', 'New', '$date', '$logDesc', '$empID')";
    mysqli_query($conn,$logSQL);
    // Logs end here
    header( "Location: delivery-rates.php?newSuccess" );
} else {
    header( "Location: delivery-rates.php?actionFailed" );
  }
mysqli_close($conn);
?>