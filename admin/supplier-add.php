<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['compname'];
$add = $_POST['compadd'];
$telnum = $_POST['telnum'];
$posi = $_POST['posi'];
$conper = $_POST['conper'];
$status = "Listed";

$sql = "INSERT INTO `filfurnituredb`.`tblsupplier` (`supCompName`, `supCompAdd`, `supCompNum`, `supContactPerson`, `supPosition`,`supStatus`) VALUES ('$name', '$add', '$telnum', '$conper', '$posi', '$status');";


if($sql){
	if (mysqli_query($conn, $sql)) {
  	//log start here
	$sID = mysqli_insert_id($conn); //id ng last input;
	$date = date("Y-m-d");
	$logDesc = "Added new supplier ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Supplier', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	//end here
	//notes: yung category and action nababago ha! 
	//YUNG SESSION_START WAG KALIMUTAN!!!! CHECK SA DB KUNG PUMAPASOK NG MAAYOS HA! 
	//Bilisan ang gawa pero wag madaliin para lang may masabing may nagawa ha! At lalo wag madaliin para lang makapag-DOTA/NBA na ulet ha! HAHAHAHA Jusmiya 
	//And yes hard coded yang mga yan
header( "Location: supplier.php?newSuccess" );
} 
else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
mysqli_close($conn);
?>