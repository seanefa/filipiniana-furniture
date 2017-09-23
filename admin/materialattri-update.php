<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];

$name = $_POST['name'];
$type = $_POST['type'];
$str = $_POST['attribs'];
//$exist = $_POST['exist'];
$status = "Listed";
$flag = 0;

$sql = "UPDATE `tblattributes` SET `attributeName`='$name' WHERE `attributeID`='$id';";
mysqli_query($conn,$sql);
echo $sql . "<br>";

/*
echo $exist . "<br>";

$attribs = explode(',',$exist);
$ctr = 0;
$new = explode(',',$str);


$existingAttribs = "SELECT * FROM tblmat_attribs WHERE matID = '$id'";
$existing = mysqli_query($conn,$existingAttribs);

while($row = mysqli_fetch_assoc($existing)){
	if($attribs[$ctr]!=$row['attribID']){
		echo "nadelete"  . $row['attribID']. "<br>";
		$ctr++;
	}
	else{
		echo "nadelete????<br>";
	}
}*/

$attribArr = "";
$attribs = "SELECT * from tblunitofmeasurement_category where uncategoryID NOT IN (SELECT uncategoryID from tblattributes a, tblattribute_measure b WHERE a.attributeID = b.attributeID AND a.attributeID = '$id');";
$attributes = mysqli_query($conn,$attribs);
while($row = mysqli_fetch_assoc($attributes)){
	$attribArr = $attribArr . $row["uncategoryID"] . ",";
	echo $attribArr . "<br>";
}
$flag++;
$temp = substr(trim($attribArr), 0, -1);
$att = explode(',',$temp);

foreach($att as $a){
		foreach($str as $r){
		if($a==$r){
			echo $a . "=" . $r . "<br>";
			$newSql = "INSERT INTO `tblattribute_measure` (`attributeID`, `uncategoryID`, `amStatus`) VALUES ('$id', '$r','Active')";
			mysqli_query($conn,$newSql);
			echo $newSql . "<br>";
			$flag++;
		}
		}
		}

if ($flag>0) {
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated material attribute ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Materials', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: material-attribute.php?updateSuccess" );
} else {
	header( "Location: material-attribute.php?actionFailed" );
  }
mysqli_close($conn);
?>