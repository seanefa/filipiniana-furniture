<?php 
session_start();
$temp = $_SESSION['tempname'];
$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$texture = strip_tags($_POST['username']);

$texture = mysqli_real_escape_string($conn,$texture);

$sql = "SELECT textureName FROM tblfabric_texture where textureName = '$texture' ";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);
//check kung may symbol yung text
if($texture == $temp){

if( ctype_space($texture) || substr($texture, 0 , 1)==" " || substr($texture, strlen($texture)-1, strlen($texture)) == " "){
echo "No white Space";
}
else{
	echo 'unchanged';
	}
}

else{
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $texture)){
	echo "Symbols not allowed";
	}
	else{
		
//checks kung yung $texture ay may whitespace sa 1st index and sa dulo. and kung empty white space yung input.
if( ctype_space($texture) || substr($texture, 0 , 1)==" " || substr($texture, strlen($texture)-1, strlen($texture)) == " "){
echo "No white Space";
}
//

else if(substr($texture, 0 , 1) != " " || substr($texture, strlen($texture)-1 ,strlen($texture) ) != "" ){ 
if($texture != ""){

	echo "";

if($rowcount !=0){
	echo "Already Exist!";
}
else if($rowcount == 0){
	echo "Good!";
}


}
else{
	echo "not empty";
}
}
}
}
//




?>