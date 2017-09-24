<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$type = $_POST['type'];
$pattern = $_POST['pattern'];
$remarks = $_POST['remarks'];
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
 move_uploaded_file($tmp_name, "plugins/fabrics/" . $date . $time . ".png");
 echo "SAVED" ;

 $pic = $date . $time . ".png";

}
$colors = $_POST['color'];
$remarks = mysqli_real_escape_string($conn,$remarks); 

$sql = "INSERT INTO `tblfabrics` (`fabricName`, `fabricTypeID`, `fabricPatternID`, `fabricColor`, `fabricRemarks`, `fabricPic`, `fabricStatus`) VALUES ('$name', '$type', '$pattern', '$colors', '$remarks', '$pic', '$status')";

if (mysqli_query($conn, $sql)) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new fabric ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Fabrics Formed', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>