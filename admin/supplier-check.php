<?php 

$conn = new MySQLI('localhost', 'root', '', 'filfurnituredb');

$companyName = "";
$companyAddress = "";
$telNumber = "";
$contactPerson = "";
$position = "";

if(isset($_POST['companyName'])){
	$companyName = strip_tags($_POST['companyName']);
}
if(isset($_POST['companyAddress'])){
	$companyAddress = strip_tags($_POST['companyAddress']);
}
if(isset($_POST['telNumber'])){
	$telNumber = strip_tags($_POST['telNumber']);
}
if(isset($_POST['contactPerson'])){
	$contactPerson = strip_tags($_POST['contactPerson']);
}
if(isset($_POST['position'])){
	$position = strip_tags($_POST['position']);
}

$companyName = mysqli_real_escape_string($conn,$companyName);

$sql = "SELECT * FROM tblsupplier WHERE supCompName = '$companyName'";

$result = mysqli_query($conn, $sql);

$rowcount = mysqli_num_rows($result);

$regex = '/[\'\/\\\^£$%&*}()\\[\\]{@#~?><!>;:`\'\"|=_¬]/';

// Company Name
if(preg_match($regex, $companyName)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($companyName) || substr($companyName, 0 , 1)==" " || substr($companyName, strlen($companyName)-1, strlen($companyName)) == " "){
	echo "White Space not allowed";
}
else if (substr($companyName, 0 , 1) != " " || substr($companyName, strlen($companyName)-1 ,strlen($companyName) ) != "" ){
		if($companyName != ""){
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


$companyAddress = mysqli_real_escape_string($conn,$companyAddress);

$sql2 = "SELECT * FROM tblsupplier WHERE supCompAdd= '$companyAddress'";

$result2 = mysqli_query($conn, $sql2);

$rowcount2 = mysqli_num_rows($result2);

// Company Address
if(preg_match($regex, $companyAddress)){
	echo "Symbols not allowed";
}
else{
		
if( ctype_space($companyAddress) || substr($companyAddress, 0 , 1)==" " || substr($companyAddress, strlen($companyAddress)-1, strlen($companyAddress)) == " "){
	echo "White Space not allowed";
}

else if (substr($companyAddress, 0 , 1) != " " || substr($companyAddress, strlen($companyAddress)-1 ,strlen($companyAddress) ) != "" ){
	if($companyAddress != ""){
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

$sql3 = "SELECT * FROM tblsupplier WHERE supCompNum= '$telNumber'";

$result3 = mysqli_query($conn, $sql3);

$rowcount3 = mysqli_num_rows($result3);

// Telephone Number
if (substr($telNumber, 0 , 1) != " " || substr($telNumber, strlen($telNumber)-1 ,strlen($telNumber) ) != "" ){
	if($telNumber != ""){
		if($rowcount3 !=0){
			echo "Data Already Exist!";
		}
			else if($rowcount3 == 0){

			}
		}
		else{
			echo "";
		}
	}

$sql4 = "SELECT * FROM tblsupplier WHERE supContactPerson = '$contactPerson'";

$result4 = mysqli_query($conn, $sql4);

$rowcount4 = mysqli_num_rows($result4);

// Contact Person
if(preg_match($regex, $contactPerson)){
	echo "Symbols not allowed";
	}
else{
		
if( ctype_space($contactPerson) || substr($contactPerson, 0 , 1)==" " || substr($contactPerson, strlen($contactPerson)-1, strlen($contactPerson)) == " "){
echo "White Space not allowed";
}

else if (substr($contactPerson, 0 , 1) != " " || substr($contactPerson, strlen($contactPerson)-1 ,strlen($contactPerson) ) != "" ){
	if($contactPerson != ""){
		if($rowcount4 !=0){
			echo "Data Already Exist!";
		}
			else if($rowcount4 == 0){

			}
		}
		else{
			echo "";
		}
	}
}

$sql5 = "SELECT * FROM tblsupplier WHERE supPosition = '$position'";

$result5 = mysqli_query($conn, $sql5);

$rowcount5 = mysqli_num_rows($result5);

// Position
if(preg_match($regex, $position)){
	echo "Symbols not allowed";
	}
else{

	if( ctype_space($position) || substr($position, 0 , 1)==" " || substr($position, strlen($position)-1, strlen($position)) == " "){
	echo "White Space not allowed";
	}
}

?>