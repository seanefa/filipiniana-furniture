<?php
include 'dbconnect.php';


$username=$_POST["_username"];
$password=$_POST["_password"];
$confirm=$_POST["_confirm"];
$employee=$_POST["_employee"];

$username =  mysqli_real_escape_string($conn,$username);
$password =  mysqli_real_escape_string($conn,$password);
$confirm =  mysqli_real_escape_string($conn,$confirm);
$employee =  mysqli_real_escape_string($conn,$employee);

if($password==$confirm)
{
	$sql = "INSERT INTO tbluser (userName, userPassword, userStatus, userType, userEmpID, dateCreated) VALUES('$username', '$password', 'Active', 'admin', '$employee', " . date("Y-m-d") . ")";
	$result = mysqli_query($conn, $sql);

	if($result)
	{

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
