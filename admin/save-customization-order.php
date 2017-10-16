<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['custReq'];
$prName = $_POST['_prodName'];
$prCtg = $_POST['_category'];
$type = $_POST['_type'];
$design = $_POST['design'];

$prFabric = 0;
if(isset($_POST['_fabric'])){
	$prFabric = $_POST['_fabric'];
}else{
	$prFabric = 0;
}

$prPrice = $_POST['_price'];
$prFramework = $_POST['_framework'];
$prDesc = $_POST['_prodDesc'];
$dimension = $_POST['dimensions'];
$prodStat = "Pre-Order";
$pic = "";

$p = str_replace(',','',$prPrice);
$prPrice = $p;
$prDesc = mysqli_real_escape_string($conn,$prDesc);

$sql = "UPDATE tblcustomize_request SET customStatus = 'Confirmed' WHERE customizedID = '$id'";
mysqli_query($conn,$sql);

$sql = "INSERT INTO `tblproduct` (`prodTypeID`,`prodCatID`,`prodFrameworkID`, `prodFabricID`, `productName`, `productDescription`, `productPrice`, `prodMainPic`, `prodSizeSpecs`,`prodStat`,`prodDesign`) VALUES ('$type','$prCtg', '$prFramework', '$prFabric', '$prName', '$prDesc', '$prPrice', '$pic', '$dimension', '$prodStat','$design')";

if (mysqli_query($conn, $sql)){
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new customized product ".$prName.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Products', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	//TO ORDER
	$date = new DateTime();
	$orderdaterec = $date->format('Y-m-d H:i:s');
	$orderdatepick = $_POST['pidate'];
	$orderstat = "WFP";
	$ordertype = "Customized Order";
	$employee = $_SESSION['userID'];
	$remarks = $_POST['orderremarks'];
	$ordershipadd = "";
	$custid = $_POST['custID'];
	$quan = $_POST['quan'];

	$pssql = "INSERT INTO `tblorders` (`receivedbyUserID`,`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`,`orderRemarks`) VALUES ('$employee','$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype','$remarks')";
	//echo "<br>orderr: " . $pssql;
	$ctr = 0;
	$P_ctr = 0;
	if (mysqli_query($conn, $pssql)) {
	$orderid = mysqli_insert_id($conn); //last id ng na-input na data
	$sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$sID','$unitPrice', '$orderid','$sample','$quan','Active')"; 
	mysqli_query($conn,$sql1);
	$orReqID = mysqli_insert_id($conn);
	$sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID','$quan';";
		mysqli_query($conn,$sql3);

		header("Location: send-accept-customization.php?custid= ".$custid."&price=".$prPrice."&orderID=".$orderid);
 //  	$_SESSION['createSuccess'] = 'Success';
	// header( 'Location: ' . $_SERVER['HTTP_REFERER']);
	} 
}
else {
 //    $_SESSION['actionFailed'] = 'Failed';
	// header( 'Location: ' . $_SERVER['HTTP_REFERER']);
}

mysqli_close($conn);
?>