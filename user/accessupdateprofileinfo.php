<?php
session_start();

include "userconnect.php";
$fname=$_POST["fname"];
$mname=$_POST["mname"];
$lname=$_POST["lname"];
$add=$_POST["address"];
$contact=$_POST["contact"];
$email=$_POST["email"];
$stat="Active";
$id = $_SESSION["userID"];

$fname= mysqli_real_escape_string($conn, $fname);
$mname= mysqli_real_escape_string($conn, $mname);
$lname= mysqli_real_escape_string($conn, $lname);
$add= mysqli_real_escape_string($conn, $add);
$contact= mysqli_real_escape_string($conn, $contact);
$email= mysqli_real_escape_string($conn, $email);

$sql="UPDATE tblcustomer SET customerFirstName='$fname', customerMiddleName='$mname', customerLastName='$lname', customerAddress='$add', customerContactNum='$contact', customerEmail='$email' where customerID = '$id'";

if($conn->query($sql))
{
	header ("Location: accessprofilesettings.php");
}
else
{
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>