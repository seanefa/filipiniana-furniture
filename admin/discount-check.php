<?php 
include "dbconnect.php";
$id = $_POST['id'];
$name = strip_tags($_POST['id']);
$name = mysqli_real_escape_string($conn,$name);
$sql = "SELECT * FROM tbldiscounts WHERE discountName = '$name'";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result); 
if($rowcount == 0){
	echo '0';
}
else{
	echo '1';
}
?>