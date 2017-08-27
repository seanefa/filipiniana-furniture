<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$materialName = "";

if(isset($_POST['materialName'])){
	$materialName = strip_tags($_POST['materialName']);
}

$materialName = mysqli_real_escape_string($conn,$materialName);

$sql = "SELECT * FROM tblmaterials WHERE materialName = '$materialName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\\/\'\\^£$%&*()}{@#~?><!>,|=_+¬-]/', $materialName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($materialName) || substr($materialName, 0 , 1)==" " || substr($materialName, strlen($materialName)-1, strlen($materialName)) == " "){
	echo "White Space not allowed";
}
else if (substr($materialName, 0 , 1) != " " || substr($materialName, strlen($materialName)-1 ,strlen($materialName) ) != "" ){
		if($materialName != ""){
			if($rowcount !=0){
				echo "Data Already Exist!";
			}
			else if($rowcount == 0){

			}
		}
		else{
			echo "";
		}
	}
}

?>