<?php
include "dbconnect.php";
$orderID = $_POST['orderID'];
$phaseID = $_POST['phaseID'];
$type = $_POST['type'];

if($type==0){
	$dateStart = date_create($_POST['dateStart']);
	$dateStart = date_format($dateStart,"Y-m-d");
	$handler = $_POST['handler'];
	$remarks = $_POST['remarks'];

	$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks',prodStatus= 
	'Ongoing' WHERE prodHistID = '$phaseID'";

	if(mysqli_query($conn,$sql)){
		echo "<script>
		window.location.href='production-tracking-details.php?id=".$orderID."';
		alert('Production started');
		</script>";
	}
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

else{
	if(isset($_POST['finPhase'])){
		$dateFinish = date_create($_POST['dateFinish']);
		$dateFinish = date_format($dateFinish,"Y-m-d");
		$remarks = $_POST['remarks'];

		$sql = "UPDATE tblproduction_phase SET prodDateEnd= '$dateFinish', prodRemarks='$remarks',prodStatus= 
		'Finished' WHERE prodHistID = '$phaseID'";

		if(mysqli_query($conn,$sql)){
			echo "<script>
			window.location.href='production-tracking-details.php?id=".$orderID."';
			alert('Production finished');
			</script>";
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	else{
		$dateStart = date_create($_POST['dateStart']);
		$dateStart = date_format($dateStart,"Y-m-d");
		$handler = $_POST['handler'];
		$remarks = $_POST['remarks'];

		$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks',prodStatus= 
		'Ongoing' WHERE prodHistID = '$phaseID'";

		if(mysqli_query($conn,$sql)){
			echo $sql;
			echo "<script>
			window.location.href='production-tracking-details.php?id=".$orderID."';
			alert('Production updated');
			</script>";
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

	}
}
?>