<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];

$name = $_POST['name'];
$type = $_POST['type'];
$str = $_POST['attribs'];
//$exist = $_POST['exist'];
$status = "Listed";
$flag = 0;


$sql = "UPDATE `tblmaterials` SET `materialType`='$type', `materialName`='$name' WHERE `materialID`='$id';";
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
$attribs = "SELECT * from tblattributes where attributeID NOT IN (SELECT attribID from tblmat_attribs a, tblattributes b WHERE a.attribID = b.attributeID AND a.matID = '$id');";
$attributes = mysqli_query($conn,$attribs);
while($row = mysqli_fetch_assoc($attributes)){
	$attribArr = $attribArr . $row["attributeID"] . ",";
	echo $attribArr . "<br>";
}
$flag++;
$temp = substr(trim($attribArr), 0, -1);
$att = explode(',',$temp);

foreach($att as $a){
		foreach($str as $r){
		if($a==$r){
			echo $a . "=" . $r . "<br>";
			$newSql = "INSERT INTO `tblmat_attribs` (`matId`, `attribID`, `mat_attribStatus`) VALUES ('$id', '$r','Active')";
			mysqli_query($conn,$newSql);
			echo $newSql . "<br>";
			$flag++;
		}
		}
		}

if($flag>0){
	header( "Location: materials.php?updateSuccess" );
}
?>