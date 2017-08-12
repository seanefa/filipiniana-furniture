<?php
session_start();
include 'dbconnect.php';

$id = $_SESSION['varname'];

$editfName = $_POST['name'];
$colorArray = $_POST['colors'];
$colors = implode(",", $colorArray); 
$editfPattern = $_POST['pattern'];
$editfType = $_POST['type'];
$editfRemarks = $_POST['Remarks'];
$pic = "";
$exist_image=$_POST["exist_image"];

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED" ;
 $pic = date("Y-m-d") . time() . ".png";
}

if($pic=="")
{
	$pic=$exist_image;
}
//create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$updateSql = "UPDATE tblfabrics SET fabricName='$editfName', fabricTypeID='$editfType', fabricPatternID='$editfPattern', fabricColor='$colors', fabricRemarks='$editfRemarks', fabricPic='$pic' WHERE fabricID=$id";

if(mysqli_query($conn,$updateSql))
{
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: fabrics.php?updateSuccess" );
	echo '</script>';
}
else 
{
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>