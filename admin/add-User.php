<?php
session_start();

// Create connection
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

		echo '<script type="text/javascript">';
		echo 'alert("RECORD SUCCESFULLY SAVED!")';
		header( "Location: users.php" );
		echo '</script>';
	}
	else
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
else
{
	echo "Passwords does not match";
}
mysqli_close($conn);
?>
