<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['name'];
$material = $_POST['material'];
$design = $_POST['design'];
$remarks = $_POST['remarks'];
$type = $_POST['type'];
$status = "Listed";

$pic = "";

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
	$tmp_name = $_FILES["image"]["tmp_name"];
	$date = date("Y-m-d");
	$time = time();
 move_uploaded_file($tmp_name, "plugins/images/" . $date . $time . ".png");
 echo "SAVED" ;

 $pic = $date . $time . ".png";

}

$remarks = mysqli_real_escape_string($conn,$remarks);

$sql = "INSERT INTO `tblframeworks` (`frameworkName`,  `frameworkFurnType`,`frameworkPic`, `frameDesignID`, `materialUsedID`, `frameworkRemarks`, `frameworkStatus`) VALUES ('$name', '$type','$pic', '$design','$material', '$remarks', '$status')";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new framework ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Frameworks', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: frameworks.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>