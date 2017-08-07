<?php

$type = $_POST['uType'];
$rate = $_POST['uUnit'];
$str = $_POST['attribs'];
$status = "Active";
$flag = 0;

include 'dbconnect.php';

$sql = "INSERT INTO `tblunitofmeasure` (`unType`, `unUnit`, `unStatus`) VALUES('$type','$rate','$status')";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);

foreach($str as $a){
	$sql = "INSERT INTO `tblunit_cat` (`unitID`, `uncategoryID`, `unitcatStatus`) VALUES ('$last_id', '$a','Active')";
	mysqli_query($conn,$sql);
	$flag++;
}


 if ($flag>0) {
   header( "Location: unit-of-measurement.php?newSuccess" );
 } 
 else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>