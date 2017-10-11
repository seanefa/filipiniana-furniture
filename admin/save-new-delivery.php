<?php
include "dbconnect.php";
$relType = $_POST['relType'];
$ordReq = $_POST['check'];
$quan = $_POST['quan'];
$delDate = $_POST['delDate'];
$remarks = $_POST['remarks'];

if($relType=="Pick-up"){
	$delSQL = "INSERT INTO `tblrelease` (`releaseDate`, `releaseType`, `releaseRemarks`, `releaseStatus`) VALUES ('$delDate', '$relType', '$remarks', 'Released')";
	if(mysqli_query($conn,$delSQL)){
		$delID = mysqli_insert_id($conn);
		$x = 0;
		foreach($ordReq as $order){
			$detailsSQL = "INSERT INTO `tblrelease_details` (`tblreleaseID`, `rel_orderReqID`, `rel_quantity`) VALUES ('$delID', '$order','" . $quan[$x] . "')";
			if(mysqli_query($conn,$detailsSQL)){
				$sql4 = "SELECT * FROM tblorder_requestcnt WHERE orreq_ID = '$order'";
				$res4 = mysqli_query($conn,$sql4);
				$row4 = mysqli_fetch_assoc($res4);
				$prod = $row4['orreq_prodFinish'];
				$rel = $row4['orreq_released'];
				$orig = $row4['orreq_quantity'];
				$newProd = $prod - $quan[$x];
				$newRelease = $rel + $quan[$x];

				$sql3 = "UPDATE tblorder_requestcnt SET orreq_prodFinish = '$newProd', orreq_released = '$newRelease' WHERE orreq_ID = '$order'";
				if(mysqli_query($conn,$sql3)){
					$sql1 = "";
					if($newRelease==$orig){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Released' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
					else if($newProd>0){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Ready for release' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
					else if($newProd==0){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Active' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
				}
			}
			$x++;
		}
		header( "Location: releasing.php?actionSuccess");
	}
	else{
		header( "Location: releasing.php?actionFailed" );
	}
}
else{	
	$location = $_POST['location'];
	$delAdd = $_POST['delAdd'];
	$employee = $_POST['emp'];
	$delRate = $_POST['delRate'];

	$delSQL = "INSERT INTO `tblrelease` (`releaseDate`, `releaseType`, `releaseRemarks`, `releaseStatus`) VALUES ('$delDate', '$relType', '$remarks', 'Released')";
	$delID = 0;
	if(mysqli_query($conn,$delSQL)){
		$delID = mysqli_insert_id($conn);
		$x = 0;
		foreach($ordReq as $order){
			$detailsSQL = "INSERT INTO `tblrelease_details` (`tblreleaseID`, `rel_orderReqID`, `rel_quantity`) VALUES ('$delID', '$order','" . $quan[$x] . "')";
			if(mysqli_query($conn,$detailsSQL)){
				$sql4 = "SELECT * FROM tblorder_requestcnt WHERE orreq_ID = '$order'";
				$res4 = mysqli_query($conn,$sql4);
				$row4 = mysqli_fetch_assoc($res4);
				$prod = $row4['orreq_prodFinish'];
				$rel = $row4['orreq_released'];
				$orig = $row4['orreq_quantity'];
				$newProd = $prod - $quan[$x];
				$newRelease = $rel + $quan[$x];

				$sql3 = "UPDATE tblorder_requestcnt SET orreq_prodFinish = '$newProd', orreq_released = '$newRelease' WHERE orreq_ID = '$order'";
				if(mysqli_query($conn,$sql3)){
					$sql1 = "";
					if($newRelease==$orig){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Released' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
					else if($newProd>0){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Ready for release' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
					else if($newProd==0){
						$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Active' WHERE order_requestID = '$order'";
						$res1 = mysqli_query($conn,$sql1);
						finishOrder($order);
					}
				}
			}
			$x++;
		}

		$delSQL = "INSERT INTO `tbldelivery` (`deliveryEmpAssigned`, `deliveryReleaseID`, `deliveryRate`, `deliveryAddress`, `deliveryRemarks`, `deliveryStatus`) VALUES ('$employee', '$delID', '$delRate', '$delAdd', '$remarks', 'Pending');";
		if(mysqli_query($conn,$delSQL)){
			
		$delID = mysqli_insert_id($conn); //id ng record;

		$delHistSQL = "INSERT INTO `tbldelivery_history` (`delHist_recID`, `delHistDate`, `delHistDeliveryMan`, `delHistRemarks`, `delHistStatus`) VALUES ('$delID', '$delDate', '$employee', '$remarks', 'Pending');";
		mysqli_query($conn,$delHistSQL);

		header( "Location: releasing.php?actionSuccess");
	}
	else{
		header( "Location: releasing.php?actionFailed" );
	}
}
else{
	header( "Location: releasing.php?actionFailed" );
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
	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and a.orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$ordReqCtr++;
		if($row2['orderRequestStatus']=='Released'){
			$finCtr++;
		}
	}

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		$oSQL = "UPDATE tblorders SET orderStatus ='Finished' WHERE orderID = $orderID";
		mysqli_query($conn,$oSQL);
		// echo "YAS!". "<br>";
		// echo $ordReqCtr . "<br>";
		// echo $finCtr . "<br>";
	}
	return 0;
}

mysqli_close($conn);
?>