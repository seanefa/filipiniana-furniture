<?php
include "dbconnect.php";

$recID = $_POST['recID'];
$orID = $_POST['orID'];
$emp = $_POST['emp'];
$rem = $_POST['rem'];
$status = $_POST['stat'];
$dateToday = date('Y-m-d H:i:s');


$sql1 = "UPDATE tbldelivery SET deliveryRecStatus = 'Inactive' , deliveryDate = '$dateToday' WHERE deliveryID = '$recID'";
if(mysqli_query($conn,$sql1)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	echo '</script>';
}
else {
	echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}


$sql = "INSERT INTO `tbldelivery` (`deliveryOrdReq`,`deliveryEmpAssigned`, `deliveryStatus`,`deliveryRecStatus`,`deliveryDate`,`deliveryRemarks`) VALUES ('$orID','$emp', '$status', 'Active','$dateToday','$rem')";

if(mysqli_query($conn,$sql)){
	echo $iPname;
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: delivery-track.php" );
	echo '</script>';
}
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>