<?php 

include "dbconnect.php";

//$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$unitName = "";
$unitMeasure = "";

if(isset($_POST['unitName'])){
	$unitName = strip_tags($_POST['unitName']);
}
if(isset($_POST['unitMeasure'])){
	$unitMeasure = strip_tags($_POST['unitMeasure']);
}

$unitName = mysqli_real_escape_string($conn,$unitName);

$sql = "SELECT * FROM tblunitofmeasure WHERE unType = '$unitName'";

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
			echo "";
		}
	}
}

$unitMeasure = mysqli_real_escape_string($conn,$unitMeasure);

$sql2 = "SELECT * FROM tblunitofmeasure WHERE unUnit= '$unitMeasure'";

$result2 = mysqli_query($conn, $sql2);

$rowcount2 = mysqli_num_rows($result2);

// Company Address
if(preg_match('/[\'\/\\\^£$%&*}{@#~?><!>;:`"|=_¬]/', $unitMeasure)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($unitMeasure) || substr($unitMeasure, 0 , 1)==" " || substr($unitMeasure, strlen($unitMeasure)-1, strlen($unitMeasure)) == " "){
	echo "White Space not allowed";
}

else if (substr($unitMeasure, 0 , 1) != " " || substr($unitMeasure, strlen($unitMeasure)-1 ,strlen($unitMeasure) ) != "" ){
	if($unitMeasure != ""){
		if($rowcount2 !=0){
			echo "Data Already Exist!";
		}
			else if($rowcount2 == 0){

			}
		}
		else{
			echo "";
		}
	}
}

?>