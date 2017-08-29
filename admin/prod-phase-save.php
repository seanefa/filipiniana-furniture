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
		echo $sql . "<br>";
		/*echo "<script>
		window.location.href='production-tracking-details.php?id=".$orderID."';
		alert('Production started');
		</script>";*/
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
			finishProduction($phaseID);
			writesmth();
			echo "<script>
			window.location.href='production-tracking-details.php?id=".$orderID."';
			alert('Production in this phase is finished');
			</script>";
			echo $sql . "<br>";
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

		$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks', prodStatus= 
		'Ongoing' WHERE prodHistID = '$phaseID'";

		if(mysqli_query($conn,$sql)){
			finishProduction($phaseID);
			writesmth();
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

function finishProduction($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];

	$phaseCtr = 0;
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and b.productionOrderReq =  '$prodID'";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$phaseCtr++;
		if($row2['prodStatus']=='Finished'){
			$finCtr++;
		}
	}

	if(($finCtr==$phaseCtr) and ($finCtr!=0) and ($phaseCtr!=0)){
		$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Ready for release' WHERE order_requestID = $prodID";
		mysqli_query($conn,$oSQL);
		$pSQL = "UPDATE tblproduction_phase SET productionStatus ='Finished' WHERE productionID = $productionID";
		mysqli_query($conn,$pSQL);
		/*echo "YAS!". "<br>";
		echo $phaseCtr . "<br>";
		echo $finCtr . "<br>";*/
	}
	return 0;
}
?>