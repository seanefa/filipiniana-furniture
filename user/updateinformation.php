<?php
include "userconnect.php";
$fn = $_POST["fname"];
$mn = $_POST["mname"];
$ln = $_POST["lname"];
$email = $_POST["email"];
$adr = $_POST["address"];
$cn = $_POST["number"];
$un = $_POST["uname"];
$op = $_POST["opass"];
$up = $_POST["upass"];
$cp = $_POST["cpass"];

$fn= mysqli_real_escape_string($conn, $fn);
$mn= mysqli_real_escape_string($conn, $mn);
$ln= mysqli_real_escape_string($conn, $ln);
$adr= mysqli_real_escape_string($conn, $adr);
$cn= mysqli_real_escape_string($conn, $cn);
$email= mysqli_real_escape_string($conn, $email);
$un = mysqli_real_escape_string($conn, $un);
$up = mysqli_real_escape_string($conn, $up);
$op = mysqli_real_escape_string($conn, $op);
$cp = mysqli_real_escape_string($conn, $cp);

$select=$conn->query("SELECT * from tbluser where userCustID = 1");
$row=$select->fetch_assoc();

if($op==$row["userPassword"]){
	if($up==$cp){
		$customersql="UPDATE tblcustomer SET customerFirstName='$fn', customerMiddleName='$mn', customerLastName='$ln', customerAddress='$adr', customerContactNum='$cn', customerEmail='$email'";
		if($conn->query($customersql)==true){
			$usersql="UPDATE tbluser SET userName='$un', userPassword='$up'";
			if($conn->query($usersql)==true){
				header("Location: profile.php");
			}
		}
	}
	else{
		echo "<script type='text/javascript'>
		alert('Passwords does not match');
		</script>";
	}
}
else{
	echo "<script type='text/javascript'>
	alert('That is a not your old password.');
	</script>";
}
?>