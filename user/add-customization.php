<?php
include "session-check.php";
include 'dbconnect.php';

$height = $_POST['cust_height'];
$width = $_POST['cust_width'];
$length = $_POST['cust_length'];
$fabric = $_POST['cust_fabric'];
$remarks = $_POST['cust_remarks'];

$customerID = $_SESSION['passId'];
$status = "Pending";
$date = date("Y-m-d");
	$time = time();

$custom_size = $height.','.$width.','.$length;

$pic = "";
$img = $_POST['cust_img_data'];
$img = str_replace('data:image/png;base64,','',$img);
$img = str_replace(' ', '+',$img);
$fileData = base64_decode($img);

$fileName = 'custom_pic/photo'.$date.'-'.$time.'.png';
$fileAdmin = 'admin/plugins/images/photo'.$date.'-'.$time.'.png';
$pic = $fileName;
file_put_contents($fileName, $fileData);
file_put_contents($fileAdmin, $fileData);
//$tmp_name = $_FILES[$fileData]["tmp_name"];
//move_uploaded_file($tmp_name, "custom_pic/".$fileName);

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
