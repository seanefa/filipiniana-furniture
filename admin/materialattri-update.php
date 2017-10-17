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

$deleteSql = "DELETE FROM tblattribute_measure WHERE attributeID=$id;";
mysqli_query($conn,$deleteSql);

foreach($str as $a){
    $newSql = "INSERT INTO `tblattribute_measure` (`attributeID`, `uncategoryID`, `amStatus`) VALUES ('$id', '$a','Active')";
    mysqli_query($conn,$newSql);
    $flag++;
}
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


if ($flag>0) {
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated material attribute ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Materials', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['updateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>