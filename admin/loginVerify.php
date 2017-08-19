<?php
include "dbconnect.php";

$username = $_POST["username"];
$password = $_POST["password"];
$flag = 0;

$selectquery = "SELECT * from tbluser where userType = 'admin'";
$querystorage = $conn->query($selectquery);

if($querystorage->num_rows>0)
{
	while($row=$querystorage->fetch_assoc())
	{
		if($username == $row["userName"])
		{
			if($password == $row["userPassword"])
			{
				$flag = 1;
				$_SESSION["userID"] = $row["userID"];
			}
		}
	}
	if($flag = 1)
	{
		header("Location: dashboard.php");
	}
}
$conn->close();
?>