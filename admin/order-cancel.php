<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_POST['id'];
$status = $_POST['status'];
$flag = 0;
$reason = "No reason.";
if($_POST['reason']!=""){
	$reason = $_POST['reason'];
}

////echo $status;

if($status=="Ongoing"){
	$pen = $_POST['penFee'];
	$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
	if(mysqli_query($conn,$updateSql)){
		$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Cancelled', '$reason');";
		if(mysqli_query($conn,$action)){
			$overDue = isOverDue($id);
			if(!$overDue){
				$invSQL = "UPDATE tblinvoicedetails SET invPenID = '$pen', balance = '0', invDelrateID = '0', invoiceStatus = 'Paid' WHERE invorderID = $id";
				if(!mysqli_query($conn,$invSQL)){
					echo '<script type="text/javascript">';
					header( "Location: orders.php" );
					echo 'alert("Action Failed")';
					echo '</script>';
				}
			}
			else{
				$uOrSQL = "UPDATE tblorders SET orderStatus = 'Pending', orderType = 'Management Order' WHERE orderID = $id";
				mysqli_query($conn,$uOrSQL);
				finishOrder($id);
				addOnHand($id);
				echo '<script type="text/javascript">';
				header( "Location: orders.php" );
				echo 'alert("Success!")';
				echo '</script>'; 
			}
		}
		else{
			echo '<script type="text/javascript">';
			header( "Location: orders.php" );
			echo 'alert("Oops, something went wrong!")';
			echo '</script>'; 
			// echo mysqli_error($conn) . "<br>";
		}
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
		echo '</script>';
	}
	else{
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("Oops, something went wrong!")';
		echo '</script>';
		// echo mysqli_error($conn) . "<br>";
	}
}
else{
	//echo 'else';
	$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
	if(mysqli_query($conn,$updateSql)){
		//echo '1';
		$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Cancelled', '$reason');";
		if(mysqli_query($conn,$action)){
			//echo '2';
			$overDue = isOverDue($id);
			if(!$overDue){
				//echo '3';
				$invSQL = "UPDATE tblinvoicedetails SET invPenID = '0', balance = '0', invDelrateID = '0', invoiceStatus = 'Paid' WHERE invorderID = $id";
				if(!mysqli_query($conn,$invSQL)){
					echo '<script type="text/javascript">';
					echo 'alert("Oops, something went wrong!")';
					echo '</script>'; 
				}
			}
			else{
				$uOrSQL = "UPDATE tblorders SET orderStatus = 'Pending', orderType = 'Management Order' WHERE orderID = $id";
				mysqli_query($conn,$uOrSQL);
				finishOrder($id);
				addOnHand($id);
				//echo '4';
				echo '<script type="text/javascript">';
				header( "Location: orders.php" );
				echo 'alert("Success!")';
				echo '</script>'; 
			}
		}
		else{
			echo mysqli_error($conn) . "<br>";
			echo '<script type="text/javascript">';
			header( "Location: orders.php" );
			echo 'alert("Action Failed")';
			echo '</script>'; 
		}
	}
	else{
		echo mysqli_error($conn) . "<br>";
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("Action Failed")';
		echo '</script>';	
	}
}


function isOverDue($id){
	include "dbconnect.php";
	$sql = "SELECT * FROM tblorders WHERE orderID = $id";
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)){
		$dateRel = $row['dateOfRelease'];
		$over = date('Y-m-d',strtotime($dateRel."+ 40 days"));
		$date = new DateTime();
		$dateToday = date_format($date, "Y-m-d");
		$bal = getBal($row['orderID']);
		if($dateToday > $over){
			$date = date_create($row['dateOfRelease']);
			$dates = date_format($date,"F d, Y");
			$endTimeStamp = strtotime($dateToday);
			$startTimeStamp = strtotime($dateRel);
			$timeDiff = abs($endTimeStamp - $startTimeStamp);
			$numberDays = $timeDiff/86400; 
			$numberDays = intval($numberDays);
				//echo '5';
			return true;
		}
		else{
				//echo '6';
			return false;
		}
	}
}


function getBal($id){
	include "dbconnect.php";
	$down = 0;
	$bal = 0;
	$delFee = 0;
	$status = 0;
	$penFee = 0;
	$sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
	$res = mysqli_query($conn,$sql);
	$tpay = 0;
	while($trow = mysqli_fetch_assoc($res)){
		$tpay = $tpay + $trow['amountPaid'];
		$price = $trow['balance'];
		$delFee = $trow['invDelrateID'];
		$penFee = $trow['invPenID'];
		$status = $trow['orderStatus'];
	}
	if($status=="Cancelled"){
		$bal = 0;
	}
	else{
		$p = $price + $delFee + $penFee;
		$down = $tpay;
		$bal = $p - $down;
	}
	////echo $bal . "BAL <br>";
	return $bal;
}  



function finishOrder($id){
	include "dbconnect.php";
	$orderID = $id;
	$ordReqCtr = 0;
	$finCtr = 0;
	$orType = "";
	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and a.orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		$ordReqCtr++;
		if($row2['orderRequestStatus']=='Finished') {
			$finCtr++;
			changeStat($row2['order_requestID']);
		}
	}

	$sql2 = "SELECT * FROM tblorders WHERE orderID = $orderID";
	$res2 = mysqli_query($conn,$sql2);
	$row2 = mysqli_fetch_assoc($res2);
	$orType = $row2['orderType'];
		
		//echo 'din' . $finCtr;
		//echo 'or' . $ordReqCtr;

	if(($finCtr==$ordReqCtr) and ($finCtr!=0) and ($ordReqCtr!=0)){
		//echo 'equal';
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

function addOnHand($id){
	include "dbconnect.php";

	$sql2 = "SELECT * FROM tblorders a, tblorder_request b WHERE a.orderID = b.tblOrdersID and  a.orderID = $id";
	$res2 = mysqli_query($conn,$sql2);
	while($row2 = mysqli_fetch_assoc($res2)){
		if($row2['orderRequestStatus']=='Finished'){
			$orType = $row2['orderType'];
			$productID = $row2['orderProductID'];
			$quan = $row2['orderQuantity'];
			if($orType!='Management Order'){
				//echo 'not';
				return 0;
			}
			else{
				//echo '<br>' . $quan;
				$ctr = 0;
				$sql3 = "SELECT * FROM tblonhand WHERE ohProdID = '$productID'";
				$res3 = mysqli_query($conn,$sql3);
				$ctr = mysqli_num_rows($res3);
				if($ctr!=0){
					$row = mysqli_fetch_assoc($res3);
					$origCount = $row['ohQuantity'];
					$newCount = $origCount + $quan;
					$sql5 = "UPDATE tblonhand SET ohQuantity = '$newCount' WHERE ohProdID = '$productID'";
					mysqli_query($conn,$sql5);
				}
				else{
					$sql4 = "INSERT INTO `tblonhand` (`ohProdID`, `ohQuantity`) VALUES ('$productID', 1)";
					mysqli_query($conn,$sql4);
				}
			}
		}
	}
	return 0;
}

function changeStat($id){
	include "dbconnect.php";
	$uSQL = "UPDATE tblorder_request SET orderRequestStatus = 'Finished' WHERE tblOrdersID = $id";
	mysqli_query($conn,$uSQL);
	return 0;
} 


// if($flag){
// 	////echo '<script type="text/javascript">';
// 	header( "Location: orders.php" );
// 	////echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
// 	////echo '</script>';
// }
// else {
// 	header( "Location: orders.php?actionFailed" );
// }
?>