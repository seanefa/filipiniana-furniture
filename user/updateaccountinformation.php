<?php
include "session.php";
include "userconnect.php";
$un = $_POST["uname"];
$op = $_POST["opass"];
$up = $_POST["upass"];
$cp = $_POST["cpass"];
$customerid = $_SESSION["userID"];
$date = date("Y-m-d");

$un = mysqli_real_escape_string($conn, $un);
$up = mysqli_real_escape_string($conn, $up);
$op = mysqli_real_escape_string($conn, $op);
$cp = mysqli_real_escape_string($conn, $cp);

$logSQL = "INSERT INTO tbllogs (`category`, `action`, `date`, `description`, `userID`) VALUES ('Customer', 'Update', '$date', 'Customer updated his or her info', '$customerid')";
$select=$conn->query("SELECT * from tbluser where userCustID = 1");
$row=$select->fetch_assoc();
$dbpass=$row["userPassword"];

if(!empty($un)&&empty($op)&&empty($up)&&empty($cp)){
	$usernamesql="UPDATE tbluser SET username='$un' where userID = " . $_SESSION["userID"] . "";
	if($conn->query($usernamesql)==true){
		$conn->query($logSQL);
		echo "<script type='text/javascript'>
		alert('Successfully Saved');
		</script>";
	}
}
else if(!empty($un)&&!empty($op)&&!empty($up)&&!empty($cp)){
	if($up==$dbpass){
		echo "<script type='text/javascript'>
		alert('That is already your password');
		</script>";
	}
	else if($op==$dbpass){
		if($up==$cp){
			$usersql="UPDATE tbluser SET username='$un', userPassword='$up'";
			if($conn->query($usersql)==true){
			$conn->query($logSQL);
			echo "<script type='text/javascript'>
			alert('Successfully Saved');
			</script>";
			}
		}
		else{
			echo "<script type='text/javascript'>
			alert('Passwords does not match');
			</script>";
		}
	}
}
else if(!empty($un)&&!empty($op)&&empty($up)&&empty($cp)){
	echo "<script type='text/javascript'>
	alert('That is a not your old password.');
	</script>";
}
$conn->close();
?>