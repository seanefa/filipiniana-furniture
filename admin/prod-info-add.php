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
if(!isset($_POST['mate'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}
if(!isset($_POST['mat_var'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}
if(!isset($_POST['quan'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}
if(!isset($_POST['unit'])){
	echo "<script>
      window.location.href='production-information.php';
      alert('Invalid input.');
      </script>";
}



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
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new production information ".$prod.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Production Information', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: production-information.php?newSuccess" );
} else {
	header( "Location: production-information.php?actionFailed" );
  }
mysqli_close($conn);
?>