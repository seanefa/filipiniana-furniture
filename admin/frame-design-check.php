<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$frameDesignName = "";

if(isset($_POST['frameDesignName'])){
	$frameDesignName = strip_tags($_POST['frameDesignName']);
}

$frameDesignName = mysqli_real_escape_string($conn,$frameDesignName);

$sql = "SELECT * FROM tblframe_design WHERE designName = '$frameDesignName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

// Company Name
if(preg_match('/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/', $frameDesignName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($frameDesignName) || substr($frameDesignName, 0 , 1)==" " || substr($frameDesignName, strlen($frameDesignName)-1, strlen($frameDesignName)) == " "){
	echo "White Space not allowed";
}
else if (substr($frameDesignName, 0 , 1) != " " || substr($frameDesignName, strlen($frameDesignName)-1 ,strlen($frameDesignName) ) != "" ){
		if($frameDesignName != ""){
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