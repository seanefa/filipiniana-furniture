<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];

$prod = $_POST['product'];
$desc = $_POST['desc'];
$pic = "";
$start = $_POST['start'];
$end = $_POST['end'];
$status = "Active";

$desc = mysqli_real_escape_string($conn,$desc);

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
	move_uploaded_file($tmp_name, "plugins/promos/" . $date . $time . ".png");
	echo "SAVED" ;

	$pic = $date . $time . ".png";
}

$sql = "INSERT INTO `tblpromos` (`promoName`,`tblproductID`, `promoDescription`, `promoStartDate`, `promoImage`, `promoEnd`, `promoStatus`) VALUES('$name','$prod','$desc','$start','$pic','$end','$status')";

if(mysqli_query($conn,$sql)){

$sID = mysqli_insert_id($conn); // ID of last input;
$date = date("Y-m-d");
$logDesc = "Added new promo ".$name.", ID = " .$sID;
$empID = $_SESSION['userID'];
$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Promos', 'New', '$date', '$logDesc', '$empID')";
mysqli_query($conn,$logSQL);

$_SESSION['createSuccess'] = 'Success';
header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}
else{

	$_SESSION['actionFailed'] = 'Failed';
header( 'Location: ' . $_SERVER['HTTP_REFERER']);

}

mysqli_close($conn);
?>