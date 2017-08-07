<?php 
session_start();
$temp = $_SESSION['tempname'];
$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$texture = strip_tags($_POST['username']);

$sql = "SELECT materialName FROM tblframe_material where materialName = '$texture' ";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);
if($texture != ""){
if($texture != $temp){
if($rowcount !=0){
	echo "Already Exist!";
}
else if($rowcount == 0){
	echo "Good!";
}
}
else{
	echo "unchanged";
}
}else{
	echo "";
}




?>