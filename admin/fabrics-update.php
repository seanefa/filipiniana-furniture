<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editfName = $_POST['name'];
$colorArray = $_POST['colors'];
$colors = implode(",",$colorArray); 
$editfPattern = $_POST['pattern'];
$editfType = $_POST['type'];
$editfRemarks = $_POST['Remarks'];
$pic = "image";

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/" . $_FILES["image"]["name"]);
 echo "SAVED" ;

 $pic = $_FILES["image"]["name"];

}



        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblfabrics SET fabricName='$editfName', fabricTypeID='$editfType', fabricPatternID='$editfPattern', fabricColor='$colors', fabricRemarks='$editfRemarks', fabricPic='$pic' WHERE fabricID= '$id'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabrics.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

