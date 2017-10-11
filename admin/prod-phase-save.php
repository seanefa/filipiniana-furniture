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
	// if(!isset($_POST['mattype'])){
	// 	$_SESSION['actionFailed'] = 'Failed';
	// 	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	// }
	// if(!isset($_POST['matvarid'])){
	// 	$_SESSION['actionFailed'] = 'Failed';
	// 	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	// }
	// if(!isset($_POST['matquan'])){
	// 	$_SESSION['actionFailed'] = 'Failed';
	// 	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	// }
	// else{
	$dateStart = date_create($_POST['dateStart']);
	$dateStart = date_format($dateStart,"Y-m-d");
	$estDate = date_create($_POST['estDate']);
	$estDate = date_format($estDate,"Y-m-d");
	$handler = $_POST['handler'];
	$remarks = $_POST['remarks'];
	$desc = $_POST['matvarid'];
	$quan = $_POST['matquan'];
	$first = $_POST['first'];

	$ctr = 0;
	$flag = 0;

	foreach($desc as $a){
		$ctr++;
	}

	for($x=0;$x<$ctr;$x++){
		$ctr = 0;
		$sql1 = "SELECT * FROM tblmat_inventory WHERE matVariantID ='" . $desc[$x] ."'";
		$res1 = mysqli_query($conn,$sql1);
		$ctr = mysqli_num_rows($res1);
		if($ctr==0){
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else{
			$row = mysqli_fetch_assoc($res1);

			$origCount = $row['matVarQuantity'];

			$newCount = $origCount - $quan[$x];

			if($newCount<0){
				$_SESSION['actionFailed'] = 'Failed';
				header( 'Location: ' . $_SERVER['HTTP_REFERER']);
			}
			else{
				$sql1 = "UPDATE tblmat_inventory SET matVarQuantity = '$newCount' WHERE matVariantID = '" . $desc[$x]."'";
				echo $sql1 . "<br>";
				if(mysqli_query($conn,$sql1)){
					$flag++;
				}
				else{
					$_SESSION['actionFailed'] = 'Failed';
					header( 'Location: ' . $_SERVER['HTTP_REFERER']);
				}

			}
		}
	}

	for($x=0;$x<$ctr;$x++){
		$sql1 = "INSERT INTO `tblprodphase_materials` (`pphID`, `pph_matDescID`, `pph_matQuan`, `pph_matStatus`) VALUES ('$phaseID','".$desc[$x]."','".$quan[$x]."','Active')";
		//echo $sql1 . "<br>";
		if(mysqli_query($conn,$sql1)){
			$flag++;
		}
		else{
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

	$productionID = getProductionID($phaseID);
	if($first=='yes'){
		$sql = "UPDATE tblproduction SET productionStatus ='Ongoing', prodStartDate = '$dateStart' WHERE productionID = $productionID";
		mysqli_query($conn,$sql);
	}

	$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks',prodStatus= 
	'Ongoing' , prodEstDate = '$estDate' WHERE prodHistID = '$phaseID'";

	if(mysqli_query($conn,$sql)){
		$_SESSION['updateSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else {
		$_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	}

	//}
}
else{
	if(isset($_POST['finPhase'])){//FINISH
		$dateFinish = date_create($_POST['dateFinish']);
		$dateFinish = date_format($dateFinish,"Y-m-d");
		$remarks = $_POST['remarks'];
		$pack = $_POST['pack'];

		$sql = "UPDATE tblproduction_phase SET prodDateEnd= '$dateFinish', prodRemarks='$remarks',prodStatus= 
		'Finished' WHERE prodHistID = '$phaseID'";

		if(mysqli_query($conn,$sql)){
			if($pack==0){
				finishProduction($phaseID,$dateFinish);
				finishOrderReq($phaseID);
				orderRequestCnt($phaseID);
			}
			else{
				p_finishProduction($phaseID,$dateFinish);
				p_finishOrderReq($phaseID);
				p_orderRequestCnt($phaseID);

			}
			// echo "<script>
			// window.location.href='production-tracking-details.php?id=".$orderID."';
			// alert('Production in this phase is finished');
			// </script>";
			//echo $sql . "<br>";

			$_SESSION['updateSuccess'] = 'Success';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else {
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	else{//UPDATE
		// if(!isset($_POST['mattype'])){
		// 	$_SESSION['actionFailed'] = 'Failed';
		// 	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		// }
		$dateStart = date_create($_POST['dateStart']);
		$dateStart = date_format($dateStart,"Y-m-d");
		$estDate = date_create($_POST['estDate']);
		$estDate = date_format($estDate,"Y-m-d");
		$handler = $_POST['handler'];
		$remarks = $_POST['remarks'];

		$sql = "UPDATE tblproduction_phase SET prodEmp = '$handler', prodDateStart = '$dateStart', prodRemarks='$remarks', prodStatus= 'Ongoing' , prodEstDate = '$estDate' WHERE prodHistID = '$phaseID'";

		if(mysqli_query($conn,$sql)){
			
			$_SESSION['updateSuccess'] = 'Success';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else {
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
}

// function kindOfOrder($id){
// 	include "dbconnect.php";
// 	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
// 	$res1 = mysqli_query($conn,$sql1);
// 	$row1 = mysqli_fetch_assoc($res1);
// 	$orderID = $row1['tblOrdersID'];
// 	$orKind = $row1['orderPackageID'];

// 	if($orKind==null){
// 		return "np";
// 	}
// 	else{
// 		return "p";
// 	}

// }


function getProductionID($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	return $productionID;
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

	$sql4 = "SELECT * FROM tblorder_requestcnt WHERE orreq_ID = '$prodID'";
	$res4 = mysqli_query($conn,$sql4);
	$row4 = mysqli_fetch_assoc($res4);
	$released = $row4['orreq_released'];

	$newProd = $finCtr - $released;

	$sql3 = "UPDATE tblorder_requestcnt SET orreq_prodFinish = '$newProd' WHERE orreq_ID = '$prodID'";
	mysqli_query($conn,$sql3);

	return 0;
}


function finishOrderReq($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$orderID = $row1['tblOrdersID'];
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


	$sql2 = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];


	if(($finCtr==$phaseCtr) and ($finCtr!=0) and ($phaseCtr!=0)){
		if($orType!='Management Order'){
			$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Ready for release' WHERE order_requestID = $prodID";
			mysqli_query($conn,$oSQL);
		}
		else{
			$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Finished' WHERE order_requestID = $prodID";
			mysqli_query($conn,$oSQL);
		}
	}
	finishOrder($prodID);
	return 0;
}

function finishProduction($id,$dateFinish){
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
		$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Ready for release' WHERE order_requestID = $prodID";
		mysqli_query($conn,$oSQL);
		addOnHand($id);
		finishOrder($id);
	}
	return 0;
}


function addOnHand($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblorder_request c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionOrderReq = c.order_requestID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$orderID = $row1['tblOrdersID'];
	$productID = $row1['orderProductID'];

	$sql2 = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];

	if($orType!='Management Order'){
		return 0;
	}
	else{
		$ctr = 0;
		$sql3 = "SELECT * FROM tblonhand WHERE ohProdID = '$productID'";
		$res3 = mysqli_query($conn,$sql3);
		$ctr = mysqli_num_rows($res3);
		if($ctr!=0){
			$row = mysqli_fetch_assoc($res3);
			$origCount = $row['ohQuantity'];
			$newCount = $origCount + 1;
			$sql5 = "UPDATE tblonhand SET ohQuantity = '$newCount' WHERE ohProdID = '$productID'";
			mysqli_query($conn,$sql5);
		}
		else{
			$sql4 = "INSERT INTO `tblonhand` (`ohProdID`, `ohQuantity`) VALUES ('$productID', 1)";
			mysqli_query($conn,$sql4);
		}
	}

}

function finishOrder($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and b.order_requestID = $id";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$orderID = $row1['orderID'];
	$ordReqCtr = 0;
	$finCtr = 0;
	$orType = "";
	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and a.orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$orType = $row2['orderType'];
		$ordReqCtr++;
		if($orType!="Management Order"){
			if($row2['orderRequestStatus']=='Ready for release'){
				$finCtr++;
			}
		}
		else{
			if($row2['orderRequestStatus']=='Finished'){
				$finCtr++;
			}

		}
	}

	$sql2 = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		if($orType!='Management Order'){
			$oSQL = "UPDATE tblorders SET orderStatus ='Ready for release' WHERE orderID = $orderID";
			mysqli_query($conn,$oSQL);
		}
		else{
			$oSQL = "UPDATE tblorders SET orderStatus ='Finished' WHERE orderID = $orderID";
			mysqli_query($conn,$oSQL);
		}
	}
	return 0;
}


function p_orderRequestCnt($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblpackage_orderreq c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionPackReq = c.por_ID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction b, tblorder_request c, tblphases d WHERE b.productionPackReq = c.por_ID and b.productionPackReq = '$prodID' GROUP BY productionID;";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		if($row2['productionStatus']=='Finished'){
			$finCtr++;
		}
	}

	$sql3 = "UPDATE tblorder_requestcnt SET orreq_prodFinish = '$finCtr' WHERE orreq_ID = '$prodID'";
	mysqli_query($conn,$sql3);

	return 0;
}


function p_finishOrderReq($id){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblpackage_orderreq c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionPackReq = c.por_ID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$orderID = $row1['tblOrdersID'];
	$phaseCtr = 0;
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction b, tblpackage_orderreq c, tblphases d WHERE b.productionPackReq = c.por_ID and b.productionPackReq = '$prodID' GROUP BY productionID;";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$phaseCtr++;
		if($row2['productionStatus']=='Finished'){
			$finCtr++;
		}
	}


	$sql2 = "SELECT * FROM tblorders WHERE orderID = '$orderID'";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];


	if(($finCtr==$phaseCtr) and ($finCtr!=0) and ($phaseCtr!=0)){
		if($orType!='Management Order'){
			$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Ready for release' WHERE order_requestID = $prodID";
			mysqli_query($conn,$oSQL);
			finishOrder($prodID);
		}
		else{
			$oSQL = "UPDATE tblorder_request SET orderRequestStatus ='Finished' WHERE order_requestID = $prodID";
			mysqli_query($conn,$oSQL);
			finishOrder($prodID);
		}
	}
	return 0;
}

function p_finishProduction($id,$dateFinish){
	include "dbconnect.php";
	$sql1 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblpackage_orderreq c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionPackReq = c.por_ID and a.prodHistID = '$id'";
	$res1 = mysqli_query($conn,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	$prodID = $row1['productionOrderReq'];
	$productionID = $row1['productionID'];
	$phaseCtr = 0;
	$finCtr = 0;
	$sql2 = "SELECT * FROM tblproduction_phase a, tblproduction b, tblpackage_orderreq c, tblphases d WHERE b.productionID = a.prodID and a.prodPhase = d.phaseID and b.productionPackReq = c.por_ID and b.productionID =  '$productionID'";
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
		addOnHand($id);
	}
	return 0;
}


?>