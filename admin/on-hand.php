<?php
include "session-check.php";
include 'dbconnect.php';

$reason = $_POST['reason'];

if($reason==1){
	$prodID = $_POST['name'];
	$orderReq = $_POST['check'];
	$quan = $_POST['quan'];
	$remarks = $_POST['remarks'];

	$sql = "SELECT * FROM tblonhand WHERE ohProdID ='$prodID'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$eQuan = $row['ohQuantity'] - $quan;

	$updateSql = "UPDATE tblonhand SET ohQuantity='$eQuan' WHERE ohProdID='$prodID'";

	if(mysqli_query($conn,$updateSql)){
		$sql1 = "UPDATE `tblorder_request` SET `orderRequestStatus`='Ready for Release' WHERE `order_requestID`='$orderReq';";
		mysqli_query($conn,$sql1);
		finishOrder($orderReq);
		$_SESSION['createSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
	 else {
	    $_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	  }
}
else if($reason==2){
	$prodID = $_POST['name'];
	$quan = $_POST['quan'];
	$remarks = $_POST['remarks'];

	$sql = "SELECT * FROM tblonhand WHERE ohProdID ='$prodID'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$eQuan = $row['ohQuantity'] - $quan;

	$updateSql = "UPDATE tblonhand SET ohQuantity='$eQuan' WHERE ohProdID='$prodID'";

	if(mysqli_query($conn,$updateSql)){


		$_SESSION['createSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
	 else {
	    $_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	  }

}

else{
	$prodID = $_POST['name'];
	$quan = $_POST['quan'];
	$remarks = $_POST['remarks'];

	$sql = "SELECT * FROM tblonhand WHERE ohProdID ='$prodID'";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($res);
	$eQuan = $row['ohQuantity'] - $quan;

	$updateSql = "UPDATE tblonhand SET ohQuantity='$eQuan' WHERE ohProdID='$prodID'";

	if(mysqli_query($conn,$updateSql)){
		$_SESSION['createSuccess'] = 'Success';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
	 else {
	    $_SESSION['actionFailed'] = 'Failed';
		header( 'Location: ' . $_SERVER['HTTP_REFERER']);
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
		if($row2['orderRequestStatus']=='Ready for release'){
			$finCtr++;
		}
	}

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		$oSQL = "UPDATE tblorders SET orderStatus ='Ready for release' WHERE orderID = $orderID";
		mysqli_query($conn,$oSQL);
		// echo "YAS!". "<br>";
		// echo $ordReqCtr . "<br>";
		// echo $finCtr . "<br>";
	}
	return 0;
}
?>