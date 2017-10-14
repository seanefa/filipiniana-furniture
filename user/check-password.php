<?php

$pass = $_POST['pass'];
$conf = $_POST['conf'];

if($pass != $conf){
	echo 'Password does not match.';
}else{
	echo '';
}



?>