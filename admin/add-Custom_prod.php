<?php
include 'dbconnect.php';
session_start();


$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$height = $_POST['cust_height'];
$width = $_POST['cust_width'];
$length = $_POST['cust_length'];
$fabric = $_POST['cust_fabric'];
$remarks = $_POST['cust_remarks'];

$customerID = $_SESSION['passId'];
$status = "Pending";

$custom_size = $height.','.$width.','.$length;

$pic = "";

if ($_FILES["cust_image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
	$tmp_name = $_FILES["cust_image"]["tmp_name"];
	$date = date("Y-m-d");
	$time = time();
 move_uploaded_file($tmp_name, "custom_pic/" . $date . $time . ".png");
 echo "SAVED" ;

 $pic = $date . $time . ".png";

}

$sql = "INSERT INTO `tblcustomize_request` (`customizedPic`,  `customSize`,`customizedDescription`, `customFabricID`, `customStatus`) VALUES ('$pic', '$custom_size','$remarks', '$fabric','$status')";
if($sql){
	if (mysqli_query($conn, $sql)) {
		header( "Location: custom.php" );
	} 
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>
