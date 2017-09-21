<?php
session_start();
if(!isset($_SESSION["userID"]))
{
  echo "<script>
      window.location.href='login.php';
      alert('You have no access here. You must logged in first.');
      </script>";
}
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
// include "userconnect.php";
// if(!isset($_SESSION)) 
//     { 
//         session_start(); 
//     }
// // Starting Session
// $user_check = $_SESSION['login_user'];
// // SQL Query To Fetch Complete Information Of User
// $ses_sql="SELECT userName from tbluser where userName='$user_check'";

// $result = mysqli_query($conn,$ses_sql);

// $row = mysqli_fetch_assoc($result);

// $login_session = $row['userName'];
?>