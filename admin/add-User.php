<?php
include 'session-check.php';
include 'dbconnect.php';

$username=$_POST["_username"];
$password=$_POST["_password"];
$confirm=$_POST["_confirm"];
$employee=$_POST["_employee"];

$datapool="SELECT * from tbluser";
$result=$conn->query($datapool);
$row=$result->fetch_assoc();

if($password == $confirm) 
{
	$sql = "INSERT INTO tbluser(userName, userPassword, userStatus, userType, userEmpID, dateCreated) VALUES('$username', '$password', 'Active', 'Admin', '$employee', '" . date("Y-m-d") . "')";
	
	if($conn->query($sql) === true) 
	{
		$_SESSION["userID"] = $row["userID"];
		$_SESSION['createSuccess'] = 'Success';
		header('Location: ' . $_SERVER['HTTP_REFERER'] . '');
	}
	else 
	{
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER'] . '');
	}
}
else 
{
	echo "Passwords does not match";
}
mysqli_close($conn);
?>