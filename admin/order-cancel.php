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

if($status=="Ongoing"){
	$pen = $_POST['penFee'];
	$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
	if(mysqli_query($conn,$updateSql)){
		$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Cancelled', '$reason');";
		if(mysqli_query($conn,$action)){
			$invSQL = "UPDATE tblinvoicedetails SET invPenID = '$pen', balance = '0', invDelrateID = '0', invoiceStatus = 'Paid' WHERE invorderID = $id";
			if(!mysqli_query($conn,$invSQL)){
				echo '<script type="text/javascript">';
				header( "Location: orders.php" );
				echo 'alert("Action Failed")';
				echo '</script>'; 
			}
		}
		else{
			echo "Error" . mysqli_error($conn);
		}
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
		echo '</script>';
	}
	else{
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("Action Failed")';
		echo '</script>';
	}
}
else{
	$updateSql = "UPDATE tblorders SET orderStatus = 'Cancelled', orderRemarks =  '$reason' WHERE orderID = $id";
	if(mysqli_query($conn,$updateSql)){
		$action = "INSERT INTO `tblorder_actions` (`orOrderID`, `orAction`, `orReason`) VALUES ($id, 'Cancelled', '$reason');";
		if(mysqli_query($conn,$action)){
			$invSQL = "UPDATE tblinvoicedetails SET invPenID = '0', balance = '0', invDelrateID = '0', invoiceStatus = 'Paid' WHERE invorderID = $id";
			if(!mysqli_query($conn,$invSQL)){
				echo '<script type="text/javascript">';
				header( "Location: orders.php" );
				echo 'alert("Action Failed")';
				echo '</script>'; 
			}
		}
		else{
			echo "Error" . mysqli_error($conn);
		}
	}
	else{
		echo '<script type="text/javascript">';
		header( "Location: orders.php" );
		echo 'alert("Action Failed")';
		echo '</script>';	
	}
}


// if($flag){
// 	echo '<script type="text/javascript">';
// 	header( "Location: orders.php" );
// 	echo 'alert("SUCCESSFULLY CANCELLED ORDER!")';
// 	echo '</script>';
// }
// else {
// 	header( "Location: orders.php?actionFailed" );
// }
?>