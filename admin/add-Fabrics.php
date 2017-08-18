<?php
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
 move_uploaded_file($tmp_name, "plugins/images/" . $date . $time . ".png");
 echo "SAVED" ;

 $pic = $date . $time . ".png";

}
$colors = $_POST['color']; 

$sql = "INSERT INTO `tblfabrics` (`fabricName`, `fabricTypeID`, `fabricPatternID`, `fabricColor`, `fabricRemarks`, `fabricPic`, `fabricStatus`) VALUES ('$name', '$type', '$pattern', '$colors', '$remarks', '$pic', '$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {
   header( "Location: fabrics.php?newSuccess" );
  	
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 } 
 else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>