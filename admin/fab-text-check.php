<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$fabricTextureName = "";

if(isset($_POST['fabricTextureName'])){
	$fabricTextureName = strip_tags($_POST['fabricTextureName']);
}

$fabricTextureName = mysqli_real_escape_string($conn,$fabricTextureName);

$sql = "SELECT * FROM tblfabric_texture WHERE textureName = '$fabricTextureName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $fabricTextureName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($fabricTextureName) || substr($fabricTextureName, 0 , 1)==" " || substr($fabricTextureName, strlen($fabricTextureName)-1, strlen($fabricTextureName)) == " "){
	echo "White Space not allowed";
}
else if (substr($fabricTextureName, 0 , 1) != " " || substr($fabricTextureName, strlen($fabricTextureName)-1 ,strlen($fabricTextureName) ) != "" ){
		if($fabricTextureName != ""){
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