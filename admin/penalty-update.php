<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$editName = $_POST['name'];
$editType = $_POST['type'];
$editRate = $_POST['rate'];
$editRemarks = $_POST['remarks'];

$editRemarks = mysqli_real_escape_string($conn,$editRemarks);

$updateSql = "UPDATE tblpenalty SET penaltyName='$editName', penaltyRateType='$editType', penaltyRate='$editRate', penaltyRemarks='$editRemarks' WHERE penaltyID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: penalties.php?updateSuccess" );
}
else {
	header( "Location: penalties.php?actionFailed" );
}
?>