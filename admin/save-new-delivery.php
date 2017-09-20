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
		//echo $delSQL . "<br>";
		$delID = mysqli_insert_id($conn);
		$x = 0;
		foreach($ordReq as $order){
			$detailsSQL = "INSERT INTO `tblrelease_details` (`tblreleaseID`, `rel_orderReqID`, `rel_quantity`, `rel_status`) VALUES ('$delID', '$order','" . $quan[$x] . "','Released')";
			mysqli_query($conn,$detailsSQL);
			$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Released' WHERE order_requestID = $order";
			$res1 = mysqli_query($conn,$sql1);
			finishOrder($order);
			//echo $detailsSQL. "<br>";
			$x++;
		}
		// echo "<script>
		// window.location.href='new-release.php';
		// alert('Successfully saved record.');
		// </script>";
		header( "Location: releasing.php?actionSuccess");
	}
	else{
		// echo "<script>
		// window.location.href='new-release.php';
		// alert('Record not saved. There are some errors on the data');
		// </script>";
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
		//echo $delSQL . "<br>";
		$delID = mysqli_insert_id($conn);
		$x = 0;
		foreach($ordReq as $order){
			$detailsSQL = "INSERT INTO `tblrelease_details` (`tblreleaseID`, `rel_orderReqID`, `rel_quantity`, `rel_status`) VALUES ('$delID', '$order','" . $quan[$x] . "','Pending')";
			mysqli_query($conn,$detailsSQL);
			$sql1 = "UPDATE tblorder_request SET orderRequestStatus = 'Released' WHERE order_requestID = $order";
			$res1 = mysqli_query($conn,$sql1);
			finishOrder($order);
			//echo $detailsSQL. "<br>";
			$x++;
		}
		$delSQL = "INSERT INTO `tbldelivery` (`deliveryEmpAssigned`, `deliveryReleaseID`, `deliveryDate`, `deliveryRate`, `deliveryAddress`, `deliveryRemarks`, `deliveryStatus`) VALUES ('$employee', '$delID', '$delDate', '$delRate', '$delAdd', '$remarks', 'Pending');";
		if(mysqli_query($conn,$delSQL)){
			// echo "<script>
			// window.location.href='new-release.php';
			// alert('Successfully saved!');
			// </script>";

		header( "Location: releasings.php?actionSuccess");
		}
		else{
			// echo "<script>
			// window.location.href='new-release.php';
			// alert('Record not saved. There are some errors on the data');
			// </script>";
		header( "Location: releasing.php?actionFailed" );
		}
	}
	else{
		// echo "<script>
		// window.location.href='new-release.php';
		// alert('Record not saved. There are some errors on the data');
		// </script>";
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