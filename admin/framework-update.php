<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

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
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/frameworks/" . date("Y-m-d") . time() . ".png");
 echo "SAVED" ;
 $pic = date("Y-m-d") . time() . ".png";
}

if($pic=="")
{
	$pic = $exist_image;
}

$remarks = mysqli_real_escape_string($conn,$remarks);

$updateSql = "UPDATE tblframeworks SET frameworkName='$name', frameworkFurnType='$type', frameDesignID='$design', materialUsedID='$material', frameworkRemarks='$remarks', frameworkPic='$pic' WHERE frameworkID=$id";

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated framework ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frameworks', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: frameworks.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>