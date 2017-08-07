<?php

$username = $_POST['username'];
$pass =$_POST['pass'];
$status = "active";
$created = date('d.m.y h:i:s');

        // Create connection
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "INSERT INTO tblaccounts (accUsername, accPassword, dateCreated, accountStatus ) VALUES('$userName','$pass','$created','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {


    echo '<script type="text/javascript">';
    echo 'alert("RECORD SUCCESFULLY SAVED!")';
    header( "Location: accounts.php" );
    echo '</script>';

  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>