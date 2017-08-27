<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$matTypeName = "";

if(isset($_POST['username'])){
	$matTypeName = strip_tags($_POST['username']);
}

$matTypeName = mysqli_real_escape_string($conn,$matTypeName);

$sql = "SELECT * FROM tblmat_type WHERE matTypeName = '$matTypeName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);


// Company Name
if(preg_match('/[\\/\'\\^£$%&*()}{@#~?><!>,|=_+¬-]/', $matTypeName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($matTypeName) || substr($matTypeName, 0 , 1)==" " || substr($matTypeName, strlen($matTypeName)-1, strlen($matTypeName)) == " "){
	echo "White Space not allowed";
}
else if (substr($matTypeName, 0 , 1) != " " || substr($matTypeName, strlen($matTypeName)-1 ,strlen($matTypeName) ) != "" ){
		if($matTypeName != ""){
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