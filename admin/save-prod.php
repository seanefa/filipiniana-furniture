<?php
include "session-check.php";
include 'dbconnect.php';

$recID = $_POST['recID'];
$orID = $_POST['orID'];
$emp = $_POST['emp'];
$ph = $_POST['phase'];
$status = $_POST['stat'];
$dateToday = date('Y-m-d H:i:s');


$sql1 = "UPDATE tblproduction SET prodRecordStatus = 'Inactive' , prodDateEnd = '$dateToday' WHERE productionID = '$recID'";
if(mysqli_query($conn,$sql1)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	echo '</script>';
}
else {
	echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}


$sql = "INSERT INTO `tblproduction` (`productionOrderReq`, `productionEmp`, `prodDateStart`, `productionStatus`,`prodPhase`,`prodRecordStatus`) VALUES ('$orID', '$emp', '$dateToday', '$status', '$ph','Active')";

if(mysqli_query($conn,$sql)){
	echo $iPname;
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: production.php" );
	echo '</script>';
}
else {
	header( "Location: production.php?actionFailed" );
}
?>