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
if(!isset($_POST['matvarid'])){
	echo "<script>
	window.location.href='production-information.php';
	alert('Invalid input.');
	</script>";
}
if(!isset($_POST['matquan'])){
	echo "<script>
	window.location.href='production-information.php';
	alert('Invalid input.');
	</script>";
}



$prod = $_POST['prod'];
$phase = $_POST['phase'];
$status = "Active";
$desc = $_POST['matvarid'];
$quan = $_POST['matquan'];

$flag=0;

$sql = "INSERT INTO tblprod_info (prodInfoProduct, prodInfoPhase, prodInfoStatus) VALUES('$prod','$phase','$status')";

if(mysqli_query($conn,$sql)){
	$prodInfoID = mysqli_insert_id($conn);

	$ctr = 0;

	foreach($desc as $a){
		$ctr++;
	}

	for($x=0;$x<$ctr;$x++){
		$sql1 = "INSERT INTO `tblprod_materials` (`p_prodInfoID`, `p_matDescID`, `p_matQuantity`, `p_matStatus`) VALUES ('$prodInfoID','".$desc[$x]."','".$quan[$x]."','Active')";
		echo $sql1 . "<br>";
		if(mysqli_query($conn,$sql1)){
			$flag++;
		}
		else{
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
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
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
	else {
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
else{
	$_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}

mysqli_close($conn);
?>