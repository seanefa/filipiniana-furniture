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

$sql = "UPDATE tblorders SET orderStatus = 'Ongoing' WHERE orderID = '$orderID'";
mysqli_query($conn,$sql);

echo '<script type="text/javascript">';
$loc = "Location: production-tracking-details.php?id=". $orderID;
header($loc); 
echo '</script>';



?>