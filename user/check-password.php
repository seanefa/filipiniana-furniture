<?php

$pass = $_POST['pass'];
$conf = 0;
if(isset($_POST['conf'])){
$conf = $_POST['conf'];
}


if($pass != $conf){
	echo 'Password does not match.';
}else{
	echo '';
}



?>