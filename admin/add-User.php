<?php
include "session-check.php";
include 'dbconnect.php';

$username=$_POST["_username"];
$password=$_POST["_password"];
$confirm=$_POST["_confirm"];
$employee=$_POST["_employee"];

if($password==$confirm)
{
	$sql = "INSERT INTO tbluser (userName, userPassword, userStatus, userType, userEmpID, dateCreated) VALUES('$username', '$password', 'active', 'admin', '', '$_employee', " . date("Y-m-d") . ")";

	if($sql)
	{
		$_SESSION["userID"] = $row["userID"];
    	header( "Location: users.php?newSuccess" );
	}
	else
	{
		header( "Location: users.php?actionFailed" );
	}
}
else
{
	echo "Passwords does not match";
}
mysqli_close($conn);
?>