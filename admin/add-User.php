<?php

$firstName = $_POST['fName'];
$middleName =$_POST['mName'];
$lastName = $_POST['lName'];
$userName = $_POST['uName'];
$passWord = $_POST['passW'];
$status = "active";

        // Create connection
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO tbluser (userName, userPassword, userFirstName, userMiddleName, userLastName,userStatus ) VALUES('$userName','$passWord','$firstName','$middleName','$lastName','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {


    echo '<script type="text/javascript">';
    echo 'alert("RECORD SUCCESFULLY SAVED!")';
    header( "Location: users.php" );
    echo '</script>';

  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>