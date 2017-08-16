<?php
include 'dbconnect.php';

$name = $_POST['name'];
$type = $_POST['type'];
$str = $_POST['attribs'];
$status = "Listed";
$flag = 0;
$unit = $_POST['unit'];



//$attribs = substr(trim($str), 0, -1);

//ATTRIBUTES SAVING
/*
$sql = "SELECT * FROM tblattributes;";
$res = mysqli_query($conn,$sql);
$cnt = 0;
$temp = "";

while($row = mysqli_fetch_assoc($res)){
	$temp = $temp . $row["attributeName"] . ",";
}

$cnt = 0;
$temp = substr(trim($str), 0, -1);
$temp1 = explode(",", $temps);

	foreach($str as $a){

		if($a!=$temp1[$ctr]){
			$cnt++;
			$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('','Active');";
			echo $sql1;
			$ctr++;
		}
	}*/

	/*if($cnt>0){
		$sql1 = "INSERT INTO `tblattributes` (`attributeName`, `attributeStatus`) VALUES ('', 'Active');
"
	}*/


$sql = "INSERT INTO `tblmaterials` (`materialType`, `materialName`, `materialStatus`) VALUES ('$type', '$name','$status')";
mysqli_query($conn,$sql);
$flag++;
$last_id = mysqli_insert_id($conn);
echo $sql . "<br>";

foreach($str as $a){
	$sql = "INSERT INTO `tblmat_attribs` (`matId`, `attribID`, `mat_attribStatus`) VALUES ('$last_id', '$a','Active')";
	mysqli_query($conn,$sql);
	$flag++;
echo $sql . "<br>";
}


 if ($flag>0) {
   header( "Location: materials.php?newSuccess" );
 	echo "lo";
 } 
 else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>