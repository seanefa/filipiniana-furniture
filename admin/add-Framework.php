<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$name = $_POST['name'];
$material = $_POST['material'];
$design = $_POST['design'];
$remarks = $_POST['remarks'];
$type = $_POST['type'];
$status = "Listed";

$pic = "";

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/" . $_FILES["image"]["name"]);
 echo "SAVED" ;

 $pic = $_FILES["image"]["name"];

}

$sql = "INSERT INTO `tblframeworks` (`frameworkName`,  `frameworkFurnType`,`frameworkPic`, `frameDesignID`, `materialUsedID`, `frameworkRemarks`, `frameworkStatus`) VALUES ('$name', '$type','$pic', '$design','$material', '$remarks', '$status')";
if($sql){
	if (mysqli_query($conn, $sql)) {
		header( "Location: frameworks.php?newSuccess" );
	} 
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>