<?php
include "session-check.php";
include 'dbconnect.php';

$pName = $_POST['pName'];
$price = $_POST['pPrice'];
$status = "Listed";
$flag = 0;

$p = str_replace(',','',$price);
$pPrice = $p;

$sql = "SELECT * FROM tblpackages;";
$result = mysqli_query($conn, $sql);
$temp = 0;
while ($row = mysqli_fetch_assoc($result))
{
  $temp++;
}
$fID = $temp;

$sql = "INSERT INTO tblpackages(packageID, packageDescription, packagePrice,packageStatus) VALUES('$fID','$pName','$pPrice','$status')";

mysqli_query($conn, $sql); //package saved
$flag++;
$last_id = mysqli_insert_id($conn);
$shit = $_POST['pr'];

//inclusions
foreach($shit as $str) {
$sql1 = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$str','$fID','$status')";
mysqli_query($conn,$sql1);
  $flag++;
}

if($flag>0){
	// Logs start here
	$sID = $last_id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new packages ".$pName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Packages', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
    $_SESSION['createSuccess'] = 'Success';
	header( 'Location: packages.php');
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: packages.php');
  }
mysqli_close($conn);
?>