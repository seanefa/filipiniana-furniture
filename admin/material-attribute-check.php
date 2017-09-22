<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$unitName = strip_tags($_POST['username']);


$unitName = mysqli_real_escape_string($conn,$unitName);

$sql = "SELECT * FROM tblattributes WHERE attributeName = '$unitName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $unitName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($unitName) || substr($unitName, 0 , 1)==" " || substr($unitName, strlen($unitName)-1, strlen($unitName)) == " "){
	echo "White Space not allowed";
}
else if (substr($unitName, 0 , 1) != " " || substr($unitName, strlen($unitName)-1 ,strlen($unitName) ) != "" ){
		if($unitName != ""){
			if($rowcount !=0){
				echo "Data Already Exist!";
			}
			else if($rowcount == 0){

			}
		}
		else{
			echo '';
		}
	}
}

?>