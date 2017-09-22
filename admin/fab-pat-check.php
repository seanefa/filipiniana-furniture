<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$fabricPatternName = "";

if(isset($_POST['fabricPatternName'])){
	$fabricPatternName = strip_tags($_POST['fabricPatternName']);
}

$fabricPatternName = mysqli_real_escape_string($conn,$fabricPatternName);

$sql = "SELECT * FROM tblfabric_pattern WHERE f_patternName = '$fabricPatternName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $fabricPatternName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($fabricPatternName) || substr($fabricPatternName, 0 , 1)==" " || substr($fabricPatternName, strlen($fabricPatternName)-1, strlen($fabricPatternName)) == " "){
	echo "White Space not allowed";
}
else if (substr($fabricPatternName, 0 , 1) != " " || substr($fabricPatternName, strlen($fabricPatternName)-1 ,strlen($fabricPatternName) ) != "" ){
		if($fabricPatternName != ""){
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