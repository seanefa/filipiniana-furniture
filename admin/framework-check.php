<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$frameName = "";
$unitMeasure = "";

if(isset($_POST['frameName'])){
	$frameName = strip_tags($_POST['frameName']);
}
if(isset($_POST['unitMeasure'])){
	$unitMeasure = strip_tags($_POST['unitMeasure']);
}

$frameName = mysqli_real_escape_string($conn,$frameName);

$sql = "SELECT * FROM tblframeworks WHERE frameworkName = '$frameName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $frameName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($frameName) || substr($frameName, 0 , 1)==" " || substr($frameName, strlen($frameName)-1, strlen($frameName)) == " "){
	echo "White Space not allowed";
}
else if (substr($frameName, 0 , 1) != " " || substr($frameName, strlen($frameName)-1 ,strlen($frameName) ) != "" ){
		if($frameName != ""){
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