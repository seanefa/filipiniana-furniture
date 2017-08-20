<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$name = $_POST['name'];
$str = $_POST['attribs'];
$status = "Active";
$flag = 0;

//$attribs = substr(trim($str), 0, -1);

//ATTRIBUTES SAVING
/*
$sql = "SELECT * FROM tblattributes;";
$res = mysqli_query($conn,$sql);
$cnt = 0;
$temp = "";

while($row = mysqli_fetch_assoc($res)){
	$temp = $temp . $row["attributeName"] . ",";
}

$cnt = 0;
$temp = substr(trim($str), 0, -1);
$temp1 = explode(",", $temps);

	foreach($str as $a){

		if($a!=$temp1[$ctr]){
			$cnt++;
			$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('','Active');";
			echo $sql1;
			$ctr++;
		}
	}*/

	/*if($cnt>0){
		$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('', 'Active');
"
	}*/

$sql = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('$name','$status')";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);
echo $sql . "<br>";

foreach($str as $a){
	$sql = "INSERT INTO `tblattribute_measure` (`attributeID`, `uncategoryID`, `amStatus`) VALUES ('$last_id', '$a','Active')";
	mysqli_query($conn,$sql);
	$flag++;
echo $sql . "<br>";
}

if ($flag>0) {
	// Logs start here
	$sID = $last_id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material attribute ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Attribute', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-attribute.php?newSuccess" );
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
mysqli_close($conn);
?>