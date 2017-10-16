<?php 

include "dbconnect.php";

//$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$attribb = "";

if(isset($_POST['attribb'])){
	$attribb = strip_tags($_POST['attribb']);
}

// Company Name
if(preg_match('/[\'\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $attribb)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($attribb) || substr($attribb, 0 , 1)==" " || substr($attribb, strlen($attribb)-1, strlen($attribb)) == " "){
	echo "White Space not allowed";
}else{
	echo "good";
}

}


?>