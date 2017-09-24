<?php
include "session-check.php";
include 'dbconnect.php';

$recID = $_POST['recID'];

if(isset($_POST['finPhase'])){
	$delDate = $_POST['dateFinish'];
	$rem = $_POST['rem'];
	$sql1 = "UPDATE `tbldelivery` SET `deliveryDate`='$delDate', `deliveryRemarks`='$rem', `deliveryStatus`='Delivered' WHERE `deliveryID`='$recID'";
	if(mysqli_query($conn,$sql1)){
		finishRelease($recID);
		header("Location: releasing.php?actionSuccess");
	}
	else{
		header("Location: releasing.php?actionFailed");
	}
}
else{
	$emp = $_POST['emp'];
	$rem = $_POST['rem'];
	$add = $_POST['delAdd'];
	$sql1 = "UPDATE `tbldelivery` SET `deliveryEmpAssigned`='$emp', `deliveryAddress`='$add', `deliveryRemarks`='$rem', `deliveryStatus`='Pending' WHERE `deliveryID`='$recID'";
	if(mysqli_query($conn,$sql1)){
		header("Location: releasing.php?actionSuccess");
	}
	else{
		header("Location: releasing.php?actionFailed");
	}
}

function finishRelease($id){
	include "dbconnect.php";
	$sql = "SELECT * FROM tbldelivery WHERE deliveryID = '$id'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$relID = $row['deliveryReleaseID'];
	$sql1 = "UPDATE `tblrelease` SET `releaseStatus`='Released' WHERE `releaseID`='$relID';";
	mysqli_query($conn,$sql1);
	return 0;
}

// $sql1 = "UPDATE tbldelivery SET deliveryRecStatus = 'Inactive' , deliveryDate = '$dateToday' WHERE deliveryID = '$recID'";
// if(mysqli_query($conn,$sql1)){
// 	echo '<script type="text/javascript">';
// 	echo 'alert("RECORD SUCCESFULLY SAVED!")';
// 	echo '</script>';
// }
// else {
// 	echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
// }


// $sql = "INSERT INTO `tbldelivery` (`deliveryOrdReq`,`deliveryEmpAssigned`, `deliveryStatus`,`deliveryRecStatus`,`deliveryDate`,`deliveryRemarks`) VALUES ('$orID','$emp', '$status', 'Active','$dateToday','$rem')";

// if(mysqli_query($conn,$sql)){
// 	echo $iPname;
// 	echo '<script type="text/javascript">';
// 	echo 'alert("RECORD SUCCESFULLY SAVED!")';
// 	header( "Location: delivery-track.php" );
// 	echo '</script>';
// }
// else {
// 	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

?>