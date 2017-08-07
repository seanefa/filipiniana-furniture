<?php
session_start();

include "userconnect.php";
$name=$_POST["username"];
$old=$_POST["oldpass"];
$new=$_POST["newpass"];
$con=$_POST["conpass"];
$status="active";
$type="customer";
$id=$_SESSION["userID"];

$sql2="SELECT * from tbluser where userID='" . $_SESSION['userID'] . "'";
$result2=$conn->query($sql2);

if($result2->num_rows>0)
{
	while($row=$result2->fetch_assoc())
	{
		if($old==$row["userPassword"])
		{
			if($new==$con)
			{
				$sql="UPDATE tbluser SET userName='$name', userPassword='$new', userStatus='$status', userType='$type' where userID='$id'";
				if($conn->query($sql))
				{
					header("Location: accessprofilesettings.php");
				}
			}
			else
			{
				echo "<script>alert('Passwords does not match.')</script>";
			}
		}
		else
		{
			echo "<script>alert('that was not your current password.')</script>";
		}
	}
}
$conn->close();