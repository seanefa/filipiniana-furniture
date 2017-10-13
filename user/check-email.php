<?php
include "userconnect.php";
$val = $_POST['val'];

if(filter_var($val, FILTER_VALIDATE_EMAIL)){

		
	}else{
		echo 'Not a valid Email';
	}

$sql = "SELECT * FROM tblcustomer;";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){

	
	if($row['customerEmail'] != $val){
		echo '';
	}else{
		echo 'Email Already used!';
	}
	
	

}


?>