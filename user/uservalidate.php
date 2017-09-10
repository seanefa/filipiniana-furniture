<?php

session_start();
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Please fill up both username & password";
	} 
	else{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		include "userconnect.php";
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($conn,$username);
		$password = mysqli_real_escape_string($conn,$password);

		// SQL query to fetch information of registerd users and finds user match.
		$query = "SELECT * FROM tbluser WHERE userName='$username' AND userPassword = '$password' AND userStatus='active'";
		$result=mysqli_query($conn,$query);

		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);
		// If result matched $username and $password, table row must be 1 row
		if($count==1){
		    $row = mysqli_fetch_assoc($count);
		    if(mysqli_query($conn,$query)){
		    		$_SESSION['logged']=true;
					$_SESSION['login_user']=$username; // Initializing Session
					header("location: home.php"); // Redirecting To Other Page
				} else {
					$error = "Username or Password is invalid";
				}
		}
		else{
		    $error = "Username or Password is invalid";
		    return false;
		}
			mysqli_close($conn); // Closing Connection
	}
}
?>