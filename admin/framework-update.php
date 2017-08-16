<?php
session_start();
include 'dbconnect.php';

$id = $_SESSION['varname'];


$name = $_POST['name'];
$material = $_POST['material'];
$design = $_POST['design'];
$type = $_POST['type'];
$remarks = $_POST['remarks'];
$pic = "";
$exist_image = $_POST["exist_image"];

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
	$pic = $exist_image;
}
        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$updateSql = "UPDATE tblframeworks SET frameworkName='$name', frameworkFurnType='$type', frameDesignID='$design', materialUsedID='$material', frameworkRemarks='$remarks', frameworkPic='$pic' WHERE frameworkID=$id";

if(mysqli_query($conn,$updateSql))
{
	header( "Location: frameworks.php?updateSuccess" );
}
else 
{
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>