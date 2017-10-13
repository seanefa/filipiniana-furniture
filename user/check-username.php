<?php
include "userconnect.php";
$val = $_POST['val'];

if(strlen($val) < 4){
	echo 'Username must be greater than 4 characters';
}else{
	echo '';
}


$sql = "SELECT * FROM tbluser;";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){

	if($row['userName'] != $val){
		echo '';
	}else{
		echo 'Username Already used!';
	}

}


?>