<?php
include "session-check.php";
include 'dbconnect.php';

if(!isset($_POST['prod'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}
if(!isset($_POST['phase'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}

$id = $_POST['recID'];
$prod = $_POST['prod'];
$phase = $_POST['phase'];
$status = "Active";

$desc = $_POST['mat_var'];
$quan = $_POST['quan'];

$mats = array();
$exist = array();
$deleted = array();

if(isset($_POST['mate'])){
	$mats = $_POST['mates'];
}
if(isset($_POST['existRec'])){
	$exist = $_POST['existRec'];
}
if(isset($_POST['deleted'])){
	$deleted = $_POST['deleted'];
}

$sql = "UPDATE tblprod_info SET prodInfoProduct='$prod', prodInfoPhase='$phase' WHERE prodInfoID = '$id'";
mysqli_query($conn,$sql);
echo $sql . "<br>";

$prodInfoID = mysqli_insert_id($conn);

$x = 0;
foreach($mats as $a){
	$sql1 = "INSERT INTO tblprod_materials(p_prodInfoID, p_matMaterialID, p_matDescID,p_matQuantity) VALUES('$prodInfoID','$a','".$desc[$x]."','".$quan[$x]."')";
	echo $sql1 . ", x = ".$x. "<br>";
	mysqli_query($conn,$sql1);
	$x++;
}

$x = 0;
foreach($deleted as $a){
	$dsql = "UPDATE tblprod_materials SET p_matStatus= 'Archived' WHERE p_matID = '$a'";
	echo $dsql .", x = ".$x.  '   DELETED <br>';
	mysqli_query($conn,$dsql);
	$x++;
}

$x = 0;
foreach($exist as $a){
	$esql = "UPDATE tblprod_materials SET p_matQuantity= ".$quan[$x]." WHERE p_matID = '$a'";
	echo $esql .", x = ".$x.  '   exisit <br>';
	mysqli_query($conn,$esql);
	$x++;
}

/*
for($x=0;$x<$ctr;$x++){
	/*if($exist[$x]){
		$usql = "UPDATE tblprod_materials SET p_matQuantity= ".$quan[$x]." WHERE p_matID = " . $exist[$x];
		echo $usql .", x = ".$x.  '   exisit <br>';
	}
	else if($deleted[$x]){
		$usql = "UPDATE tblprod_materials SET p_matQuantity= ".$quan[$x]." WHERE p_matID = " . $exist[$x];
		echo $usql .", x = ".$x.  '   DELETED <br>';
	}
	else{
	$sql1 = "INSERT INTO tblprod_materials(p_prodInfoID, p_matMaterialID, p_matDescID,p_matQuantity) VALUES('$prodInfoID','".$mats[$x]."','".$desc[$x]."','".$quan[$x]."')";
	echo $sql1 . ", x = ".$x. "<br>";
	}


	//mysqli_query($conn,$sql1);
}*/

if($x>1){
 header( "Location: production-information.php?updateSuccess" );
}
mysqli_close($conn);
?>