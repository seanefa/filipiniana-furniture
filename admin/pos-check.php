<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$matTypeName = "";

if(isset($_POST['username'])){
	$matTypeName = strip_tags($_POST['username']);
}

$matTypeName = mysqli_real_escape_string($conn,$matTypeName);


// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $matTypeName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($matTypeName) || substr($matTypeName, 0 , 1)==" " || substr($matTypeName, strlen($matTypeName)-1, strlen($matTypeName)) == " "){
	echo "White Space not allowed";
}
else if (substr($matTypeName, 0 , 1) != " " || substr($matTypeName, strlen($matTypeName)-1 ,strlen($matTypeName) ) != "" ){
			echo "good";
		}
	
}

?>