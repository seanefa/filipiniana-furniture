<?php 

include "dbconnect.php";

//$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$texture = strip_tags($_POST['username']);

$sql = "SELECT penaltyName FROM tblpenalty where penaltyName = '$texture' ";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);
if($texture != ""){
if($rowcount !=0){
	echo "Already Exist!";
}
else if($rowcount == 0){
	echo "Good!";
}
}
else{
	echo "";
}

?>