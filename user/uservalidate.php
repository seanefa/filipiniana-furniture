<?php
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
		$query = "SELECT * FROM tbluser WHERE userName='$username' AND userPassword = '$password' AND userStatus='active' AND userType != 'admin'";
		$result= mysqli_query($conn,$query);
		// Mysql_num_row is counting table row
		$count=mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		// If result matched $username and $password, table row must be 1 row
		if($count==1){
			if($row['confirmedUser'] == 1){
					session_start();
		    		$_SESSION['logged'] = true;
					$_SESSION['userName'] = $row["userName"];
					$_SESSION["userID"] = $row["userID"];// Initializing Session
					$_SESSION["custID"] = $row['userCustID'];
					$_SESSION["userType"] = 'customer';
					// $cookieID = $row["userID"];
					// setcookie($cookieID, time() + (86400 * 30), "/"); // 86400 = 1 day
					// echo $row['userID'];
					// echo $username;
					header("location: home.php"); // Redirecting To Other Page
					}else{
						header("location: account-confirm.php");
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