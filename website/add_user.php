<?php
session_start();
$fn=$_POST['fname'];
$mn=$_POST['mname'];
$ln=$_POST['lname'];
$ar=$_POST['address'];
$cn=$_POST['number'];
$em=$_POST['email'];
$un=$_POST['uname'];
$pw=$_POST['upass'];
$cf=$_POST['cpass'];
$status="active";
$type="customer";
$datecreated=date("Y/m/d");
include 'websiteconnect.php';
if($cf==$pw)
{
	$sql2="INSERT into tblcustomer(customerFirstName, customerMiddleName, customerLastName, customerAddress, customerContactNum, customerEmail, customerStatus) values('$fn', '$mn', '$ln', '$ar', '$cn', '$em', '$status')";
	if($sql2)
	{
		if ($conn->query($sql2)==true)
		{
			$last_id=$conn->insert_id;
			$sql="INSERT INTO tbluser(userName, userPassword, userStatus, userType, userCustID, dateCreated) VALUES ('$un', '$pw', '$status', '$type', '$last_id', '$datecreated')";
			if($conn->query($sql)==true)
			{
				$_SESSION["userID"] = $row["userID"];
				header("Location: userhome.php");
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
}
else
{
		echo "Passwords does not match.";
}
?>