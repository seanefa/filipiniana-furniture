<?php
include "dbconnect.php";
$orderID = $_GET['id'];
$sql1 = "SELECT * from tblorder_request a, tblorders b, tblproduct c WHERE a.tblOrdersID = b.orderID and c.productID = a.orderProductID and b.orderID = '$orderID'";
$res = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_assoc($res)){
	$quan = $row1['orderQuantity'];
	while($quan!=0){
		echo $quan . "<br>";
		$orderReqID = $row1['order_requestID'];
		$d = $row1['prodDesign'];
		$prodSQL = "INSERT INTO tblproduction(productionOrderReq,productionStatus) VALUES ('$orderReqID','Ongoing')";
		echo "<br>" . $prodSQL;
		mysqli_query($conn,$prodSQL);
		$prID = mysqli_insert_id($conn);
		$sql2 = "SELECT * FROM tblphases a, tbldesign_phase c, tblfurn_design b WHERE a.phaseID = c.d_phase and c.p_design = b.designID and b.designID = '$d'";
		$res1 = mysqli_query($conn,$sql2);
		while($row2 = mysqli_fetch_assoc($res1)){
			$phaseID = $row2['phaseID'];
			$phSQL = "INSERT INTO tblproduction_phase(prodID,prodPhase,prodStatus) VALUES ('$prID','$phaseID','Pending')";
			mysqli_query($conn,$phSQL);
			echo "<br>" . $phSQL;
		}
		$quan--;
	}

}

//PACKAGES
$sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblpackages c WHERE c.packageID = a.orderPackageID and b.orderID = a.tblOrdersID and b.orderID = '$orderID'";
$res = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_assoc($res)){
	$orReqID = $row['order_requestID'];
	$sql3 = "SELECT * FROM tblpackage_orderreq a, tblproduct b WHERE a.por_prID = b.productID and a.por_orReqID = '$orReqID'";
	$res3 = mysqli_query($conn,$sql3);
	while($row3 = mysqli_fetch_assoc($res3)){
		$prReqID = $row3['por_ID'];
		$d = $row3['prodDesign'];
		$prodSQL = "INSERT INTO tblproduction(productionPackReq,productionStatus) VALUES ('$prReqID','Ongoing')";
		//echo "<br>" . $prodSQL;
		mysqli_query($conn,$prodSQL);
		$prID = mysqli_insert_id($conn);//productionID
		$sql2 = "SELECT * FROM tblphases a, tbldesign_phase c, tblfurn_design b WHERE a.phaseID = c.d_phase and c.p_design = b.designID and b.designID = '$d'";
		$res1 = mysqli_query($conn,$sql2);
		while($row2 = mysqli_fetch_assoc($res1)){
			$phaseID = $row2['phaseID'];
			$phSQL = "INSERT INTO tblproduction_phase(prodID,prodPhase,prodStatus) VALUES ('$prID','$phaseID','Pending')";
			mysqli_query($conn,$phSQL);
			//echo "<br>" . $phSQL;
		}

	}
}

$sql = "UPDATE tblorders SET orderStatus = 'Ongoing' WHERE orderID = '$orderID'";
mysqli_query($conn,$sql);

// echo '<script type="text/javascript">';
// $loc = "Location: production-tracking-details.php?id=". $orderID;
// header($loc); 
// echo '</script>';



?>