<?php
include "dbconnect.php";

$prod = $_POST['prod'];
$phase = $_POST['phase'];
$status = "Active";

$mats = $_POST['mate'];
$desc = $_POST['mat_var'];
$quan = $_POST['quan'];
$unit = $_POST['unit'];

$flag=0;


$sql = "INSERT INTO tblprod_info(prodInfoProduct,prodInfoPhase,prodInfoStatus) VALUES('$prod','$phase','$status')";
mysqli_query($conn,$sql);
echo $sql . "<br>";
$flag++;

$prodInfoID = mysqli_insert_id($conn);

$ctr = 0;

foreach($mats as $a){
	$ctr++;
}

for($x=0;$x<$ctr;$x++){
	$sql1 = "INSERT INTO tblprod_materials(p_prodInfoID, p_matMaterialID, p_matDescID,p_matQuantity,p_matUnit,p_matStatus) VALUES('$prodInfoID','".$mats[$x]."','".$desc[$x]."','".$quan[$x]."','".$unit[$x]."','Active')";
	echo $sql1 . "<br>";
	mysqli_query($conn,$sql1);
	$flag++;
}

if($flag>1){
header( "Location: production-information.php?newSuccess" );
	echo 'ksk';
}
mysqli_close($conn);
?>