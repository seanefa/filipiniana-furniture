<?php
include "session-check.php";
include 'dbconnect.php';

$updateSql = "UPDATE tbluser SET userStatus = null WHERE userID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: accounts.php?deactivateSuccess" );
}
else {
	header( "Location: accounts.php?actionFailed" );
}
?>