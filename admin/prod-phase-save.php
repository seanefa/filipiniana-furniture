<?php
include "session-check.php";
include 'dbconnect.php';

$orderID = $_POST['orderID'];
$phaseID = $_POST['phaseID'];
$type = $_POST['type'];
$dateFinish = "";
if(isset($_POST['dateFinish'])){
	$dateFinish = date_create($_POST['dateFinish']);
}

if($type==0){
	$dateStart = date_create($_POST['dateStart']);
	$dateStart = date_format($dateStart,"Y-m-d");
	$handler = $_POST['handler'];
	$remarks = $_POST['remarks'];
	$desc = $_POST['matvarid'];
	$quan = $_POST['matquan'];
	$first = $_POST['first'];

	$productionID = getProductionID($phaseID);
	if($first=='yes'){
		$sql = "UPDATE tblproduction SET productionStatus ='Ongoing', prodStartDate = '$dateStart' WHERE productionID = $productionID";
		mysqli_query($conn,$sql);
	}

	$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks',prodStatus= 
	'Ongoing' WHERE prodHistID = '$phaseID'";

	if(mysqli_query($conn,$sql)){
		for($x=0;$x<$ctr;$x++){
			$sql1 = "INSERT INTO `tblprodphase_materials` (`pphID`, `pph_matDescID`, `pph_matQuan`, `pph_matStatus`) VALUES ('$phaseID','".$desc[$x]."','".$quan[$x]."','Active')";
			echo $sql1 . "<br>";
			if(mysqli_query($conn,$sql1)){
				$flag++;
			}
			else{
				$_SESSION['actionFailed'] = 'Failed';
				header( 'l: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		echo $sql . "<br>";
		echo "<script>
		window.l.href='production-tracking-details.php?id=".$orderID."';
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
			finishProduction($phaseID);
			finishOrderReq($phaseID);
			orderRequestCnt($phaseID);
			echo "<script>
			window.l.href='production-tracking-details.php?id=".$orderID."';
			alert('Production in this phase is finished');
			</script>";
			//echo $sql . "<br>";
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
			echo $sql;
			echo "<script>
			window.l.href='production-tracking-details.php?id=".$orderID."';
			alert('Production updated');
			</script>";
		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

function orderRequestCnt($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction b, tblorder_request c, tblphases d WHERE b.productionOrderReq = c.order_requestID and b.productionOrderReq = '$prodID' GROUP BY productionID;";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		if($row2['productionStatus']=='Finished'){
			$finCtr++;
		}
	}

	//$sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_cntID`, `orreq_ID`, `orreq_quantity`, `orreq_prodFinish`, `orreq_returned`, `orreq_released`) VALUES ('1', 'y', 'y', 'y', 'y', 'y');";
	$sql3 = "UPDATE tblorder_requestcnt SET orreq_prodFinish = '$finCtr' WHERE orreq_ID = '$prodID'";
	mysqli_query($conn,$sql3);

	return 0;
}

function getProductionID($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	return $productionID;
}

function finishOrderReq($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$phaseCtr = 0;
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction b, tblorder_request c, tblphases d WHERE b.productionOrderReq = c.order_requestID and b.productionOrderReq = '$prodID' GROUP BY productionID;";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$phaseCtr++;
		if($row2['productionStatus']=='Finished'){
			$finCtr++;
		}
	}

	if(($finCtr==$phaseCtr) and ($finCtr!=0) and ($phaseCtr!=0)){
		$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Ready for release' WHERE order_requestID = $prodID";
		mysqli_query($conn,$oSQL);
	}
	finishOrder($prodID);
	return 0;
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
	$sql2 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and b.productionID =  '$productionID'";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$phaseCtr++;
		if($row2['prodStatus']=='Finished'){
			$finCtr++;
		}
	}

	if(($finCtr==$phaseCtr) and ($finCtr!=0) and ($phaseCtr!=0)){
		$pSQL = "UPDATE tblproduction SET productionStatus ='Finished', prodEndDate = '$dateFinish' WHERE productionID = $productionID";
		mysqli_query($conn,$pSQL);
	}
	return 0;
}


function finishOrder($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and b.order_requestID = $id";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$orderID = $row1['orderID'];
	$ordReqCtr = 0;
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and a.orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$ordReqCtr++;
		if($row2['orderRequestStatus']=='Ready for release'){
			$finCtr++;
		}
	}

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		$oSQL = "UPDATE tblorders SET orderStatus ='Ready for release' WHERE orderID = $orderID";
		mysqli_query($conn,$oSQL);
	}
	return 0;
}


?>