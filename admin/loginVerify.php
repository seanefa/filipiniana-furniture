<?php
include "dbconnect.php";

$username = $_POST["username"];
$password = $_POST["password"];
$flag = 0;

$selectquery = "SELECT * from tbluser where userType = 'admin'";
$querystorage = mysqli_query($conn,$selectquery);

while($row = mysqli_fetch_assoc($querystorage))
{
	if($username == $row["userName"])
	{
		if($password == $row["userPassword"])
		{			
			$flag = 1;
			session_start();
			$_SESSION["userID"] = $row["userID"];
		}
	}
}


if($flag==1)
{
	/*echo "<script>
	window.location.href='dashboard.php';
	alert('Welcome!');
	</script>";*/
	header("Location: dashboard.php");
}
else{
	echo "<script>
	window.location.href='login.php';
	alert('Account not registered');
	</script>";
}
$conn->close();
?>