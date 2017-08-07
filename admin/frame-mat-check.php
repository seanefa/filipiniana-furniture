<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$frameMaterialName = "";

if(isset($_POST['frameMaterialName'])){
	$frameMaterialName = strip_tags($_POST['frameMaterialName']);
}

$sql = "SELECT * FROM tblframe_material WHERE materialName = '$frameMaterialName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\\/\'\\^£$%&*()}{@#~?><!>,|=_+¬-]/', $frameMaterialName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($frameMaterialName) || substr($frameMaterialName, 0 , 1)==" " || substr($frameMaterialName, strlen($frameMaterialName)-1, strlen($frameMaterialName)) == " "){
	echo "White Space not allowed";
}
else if (substr($frameMaterialName, 0 , 1) != " " || substr($frameMaterialName, strlen($frameMaterialName)-1 ,strlen($frameMaterialName) ) != "" ){
		if($frameMaterialName != ""){
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