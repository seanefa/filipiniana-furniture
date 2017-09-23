<?php
include "session-check.php";
include 'dbconnect.php';

$username = $_POST['username'];
$pass =$_POST['pass'];
$status = "active";
$created = date('d.m.y h:i:s');

$sql = "INSERT INTO tblaccounts (accUsername, accPassword, dateCreated, accountStatus ) VALUES('$userName','$pass','$created','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: accounts.php?newSuccess" );
  } 
  else {
    header( "Location: accounts.php?actionFailed" );
  }

  mysqli_close($conn);
}
?>