<?php 
session_start();
$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$texture = strip_tags($_POST['username']);

//check kung may symbol yung text


if( ctype_space($texture) || substr($texture, 0 , 1)==" " || substr($texture, strlen($texture)-1, strlen($texture)) == " "){
echo "No white Space";
}
else{
	
if(preg_match('/[\\/\'\\^£$%&*()}{@#~?><!>,|=_+¬-]/', $texture)){
	echo "Symbols not allowed";
	}
	else{
		
//checks kung yung $texture ay may whitespace sa 1st index and sa dulo. and kung empty white space yung input.

//

if(substr($texture, 0 , 1) != " " || substr($texture, strlen($texture)-1 ,strlen($texture) ) != "" ){ 
if($texture != ""){

	echo "Good!";

}
else{
	echo "";
}
}
}
}




?>