<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$edit = $_POST[''];

$updateSql = "UPDATE tbl SET ='', ='$' WHERE ID=$id";

if(mysqli_query($conn,$updateSql)){
	header( "Location: production-phases.php?updateSuccess" );
}
else {
	header( "Location: production-phases.php?actionFailed" );
}
?>