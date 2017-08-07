<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$texture = strip_tags($_POST['username']);

$sql = "SELECT designName FROM tblframe_design where designName = '$texture' ";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);
if($texture != ""){
if($rowcount !=0){
	echo "Already Exist!";
}
else if($rowcount == 0){
	echo "not empty";
}
}
else{
	echo "empty";
}

?>