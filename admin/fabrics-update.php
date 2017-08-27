<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];

$editfName = $_POST['name'];
$colors = $_POST['color'];
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

$editfRemarks = mysqli_real_escape_string($conn,$editfRemarks);

$updateSql = "UPDATE tblfabrics SET fabricName='$editfName', fabricTypeID='$editfType', fabricPatternID='$editfPattern', fabricColor='$colors', fabricRemarks='$editfRemarks', fabricPic='$pic' WHERE fabricID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated fabric ".$editfName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Fabrics Formed', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: fabrics.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>