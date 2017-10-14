<?php
include "session-check.php";
include 'dbconnect.php';

$custid = "";

if(isset($_POST['customerIds'])){
	$custid = $_POST['customerIds'];
	echo "<br>customId " . $custid;
}


$orderid = $_POST['updateOrder'];

$selected = $_POST['cart'];
$selectedQuant = $_POST['quant'];
$selectedPrice = $_POST['prices'];
$totalPrice = $_POST['totalPrice'];
$employee = $_SESSION['userID'];

//PACKAGE VARIABLES
$P_selected = $_POST['P_cart'];
$P_selectedQuant = $_POST['P_quant'];
$P_selectedPrice = $_POST['P_prices'];


$_SESSION['P_cart'] = $P_selected;
$_SESSION['P_quant'] = $P_selectedQuant;
$_SESSION['P_price'] = $P_selectedPrice;
//


$_SESSION['cart'] = $selected;
$_SESSION['quant'] = $selectedQuant;
$_SESSION['price'] = $selectedPrice;
$_SESSION['totalPrice'] = $totalPrice;
$sample = 'Pending';

$ssql = "SELECT orderPrice from tblorders WHERE orderID = '$orderid'";
$res = mysqli_query($conn,$ssql);
$rrow = mysqli_fetch_assoc($res);
$newPrice = $totalPrice + $rrow['orderPrice'];

$pssql = "UPDATE `tblorders` SET `orderPrice` = '$newPrice' WHERE orderID = '$orderid'";
echo "update" . $pssql . "<br>";
mysqli_query($conn,$pssql);

$sql = "UPDATE tblinvoicedetails SET balance = '$newPrice' WHERE invorderID = $orderid";
echo "SQL: " . $sql . "<br>";
mysqli_query($conn,$sql);

$ctr = 0;
foreach($selected as $str) {
	$unitPrice = unitPrice($str);
	$sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$str','$unitPrice', '$orderid','$sample',".$selectedQuant[$ctr].",'Active')"; 
	mysqli_query($conn,$sql1);
	$orReqID = mysqli_insert_id($conn);
	$sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID',".$selectedQuant[$ctr].";";
		mysqli_query($conn,$sql3);
		$ctr++;
	}
	
	foreach($P_selected as $P_str) {
		$unitPrice = packPrice($P_str);

		$sql1 = "INSERT INTO `tblorder_request` (`orderPackageID`,`prodUnitPrice`,`tblOrdersID`,`orderRemarks`,`orderQuantity`,`orderRequestStatus`) VALUES ('$P_str','$unitPrice', '$orderid','$sample',".$P_selectedQuant[$P_ctr].",'Active')"; 
		if(mysqli_query($conn,$sql1)){

			$orReqID = mysqli_insert_id($conn);
			$sql3 = "INSERT INTO `tblorder_requestcnt` (`orreq_ID`, `orreq_quantity`) VALUES ('$orReqID',".$P_selectedQuant[$P_ctr].";";
				mysqli_query($conn,$sql3);
				$P_ctr++;
				
				$orderReqID = mysqli_insert_id($conn);
				$sql1 = "SELECT * FROM tblpackages a, tblpackage_inclusions b, tblproduct c WHERE c.productID = b.product_incID and b.package_incID = a.packageID and a.packageID = '$P_str'";
				$res1 = mysqli_query($conn,$sql1);
				while($row1 = mysqli_fetch_assoc($res1)){
					$str = $row1['productID'];
					$sql2 = "INSERT INTO `tblpackage_orderreq` (`por_orReqID`, `por_prID`) VALUES ('$orderReqID', '$str');";
					mysqli_query($conn,$sql2);
				}
			}
		}


		function unitPrice($id){
			include "dbconnect.php";
			$price = 0;
			$sql = "SELECT * from tblproduct WHERE productID = '$id'";
			$res = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($res)){
				$price = $row['productPrice'];
			}
			return $price;
		}

		function packPrice($id){
			include "dbconnect.php";
			$price = 0;
			$sql = "SELECT * from tblpackages WHERE packageID = '$id'";
			$res = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($res)){
				$price = $row['packagePrice'];
			}
			return $price;
		}


		if($ctr>0){
			$_SESSION['updateSuccess'] = 'Success';
			header( 'Location: orders.php');
		} 
		else {
			$_SESSION['actionFailed'] = 'Failed';
			header( 'Location: orders.php');
		}
		mysqli_close($conn);
		?>