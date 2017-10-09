<?php
include "session-check.php";
include 'dbconnect.php';
  
     
$varid = $_SESSION['varid'];
$quan = $_POST['quan1'];
$remarks = $_POST['remarks'];
$flag=0;

$sql2 = "SELECT * FROM tblmat_inventory WHERE matVariantID = '$varid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$sID = mysqli_insert_id($conn);
$id = $row2['mat_inventoryID'];

$added = $row2['matVarQuantity'] - $quan;
$sql4 = "UPDATE `tblmat_inventory` SET `matVarQuantity`='$added' WHERE `matVariantID`='$varid'";
mysqli_query($conn, $sql4);
$flag++;

$sql5 = "INSERT INTO `tblmat_deductdetails` (`mat_inventoryID`, `mat_deductQuantity`, `mat_deductRemarks`) VALUES ('$id','$quan','$remarks')";
mysqli_query($conn, $sql5);

if ($flag>0) {
	// Logs start here
	$sql5 = "SELECT * FROM tblmat_var WHERE mat_varID = '$varid'";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
	 // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Deducted raw material, ".$row5['mat_varDescription'].", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Restock', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }

mysqli_close($conn);
?>