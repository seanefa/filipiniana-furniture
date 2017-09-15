<?php
session_start();
$fn=$_POST['fname'];
$mn=$_POST['mname'];
$ln=$_POST['lname'];
$ar=$_POST['address'];
$cn=$_POST['number'];
$em=$_POST['email'];
$newstat=$_POST["newsletter"];
$un=$_POST['uname'];
$pw=$_POST['upass'];
$cf=$_POST['cpass'];
$status="active";
$type="customer";
$datecreated=date("Y/m/d");
include 'userconnect.php';
$last_id=$conn->insert_id;

$nl=(int)$newstat;

$un= mysqli_real_escape_string($conn, $un);
$pw= mysqli_real_escape_string($conn, $pw);
$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$ar= mysqli_real_escape_string($conn, $ar);
$cn= mysqli_real_escape_string($conn, $cn);
$em= mysqli_real_escape_string($conn, $em);

if($cf==$pw)
{
	$sql2="INSERT into tblcustomer(customerFirstName, customerMiddleName, customerLastName, customerAddress, customerContactNum, customerEmail, customerNewsletter, customerStatus) values('$fn', '$mn', '$ln', '$ar', '$cn', '$em', '$newstat', '$status')";
	
	if($sql2)
	{
		if ($conn->query($sql2)==true)
		{
			$last_id=$conn->insert_id;
			$sql="INSERT INTO tbluser(userName, userPassword, userStatus, userType, userCustID, dateCreated) VALUES ('$un', '$pw', '$status', '$type', '$last_id', '$datecreated')";
			if($conn->query($sql)==true)
			{
				header("Location: home.php");
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else
		{
			echo "Error: " . $sql2 . "<br>" . $conn->error;
		}
	}
}
else
{
	echo "Passwords does not match.";
}
?>
$conn-close();