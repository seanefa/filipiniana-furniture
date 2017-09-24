<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editfName = $_POST['editfName'];
$editmName = $_POST['editmName'];
$editlName = $_POST['editlName'];
$edituName = $_POST['edituName'];
$editpassW = $_POST['editpassW'];

        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tbluser SET userFirstName='$editfName', userMiddleName='$editmName', userLastName='$editlName', userName='$edituName', userPassword='$editpassW' WHERE userID=$id";

if(mysqli_query($conn,$updateSql)){
   $_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

?>