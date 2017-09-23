<?php
include "session-check.php";
include 'dbconnect.php';

$pName = $_POST['pName'];
$price = $_POST['pPrice'];
$id = $_POST['id'];
$status = "Listed";
$flag = 0;

$sql = "SELECT * FROM tblpackages;";
$result = mysqli_query($conn, $sql);

$p = str_replace(',','',$price);
$pPrice = $p;

$temp=0;
while ($row = mysqli_fetch_assoc($result))
{
	$temp++;
}
$fID = $temp;


$sql = "UPDATE tblpackages SET packageDescription='$pName', packagePrice='$pPrice' WHERE packageID = '$id'";
if($sql){
	if (mysqli_query($conn, $sql)) {
		$flag++;
	} 
	else {
		header( "Location: packages.php?actionFailed" );
	}
}

/*
foreach($shit as $str) {
echo"<script>alert(". $str .")</script>";
$sql1 = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$str','$fID','$status')";
mysqli_query($conn,$sql1);
  $flag++;
}

*/

if(isset($_POST['pis'])){
	$shit = $_POST['pis'];

	foreach($shit as $str) {
		$sql1 = "UPDATE tblpackage_inclusions SET package_incStatus='Archived' WHERE package_inclusionID = $str";
		mysqli_query($conn,$sql1);
		$flag++;
	}
}

/*else{
	echo "not set";
}*/

$sql1 = "";

if(isset($_POST['addis'])){
	$addThis = $_POST['addis'];

	foreach($addThis as $add) {
		echo $add;
		//$sql2 = "UPDATE tblpackage_inclusions SET package_incStatus='Listed' WHERE package_inclusionID = $add";
		$sql = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$add','$id','Listed')";
		if(mysqli_query($conn,$sql)){
			$flag++;
		}
		else{

			header( "Location: packages.php?actionFailed" );
		}
	}
}

/*else{
	echo "not set";
}*/

if($flag>0){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated packages ".$pName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Packages', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
  	header( "Location: packages.php?updateSuccess" );
} else {
  	header( "Location: packages.php?actionFailed" );
  }
mysqli_close($conn);
?>