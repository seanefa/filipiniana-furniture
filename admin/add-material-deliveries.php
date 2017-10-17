<?php
include "session-check.php";
include 'dbconnect.php';
 
$sup = $_POST['supplier'];
$quantity = $_POST['matquan'];
$varnt = $_POST['matvar'];
$varid = $_POST['matvarid'];
$desc = $_POST['matdesc'];
$status = "Listed";
$flag=0;
$total = 0;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');

foreach($quantity as $a){
    $total = $total + $a;
}

$sql = "INSERT INTO `tblmat_deliveries` (`supplierID`, `totalQuantity`, `dateSupplied`, `mat_deliveryRemarks`, `mat_deliveryStatus`) VALUES ('$sup', '$total','$orderdaterec','$status','$status')";
mysqli_query($conn, $sql);

$id = mysqli_insert_id($conn);
$varlen = count($varnt);

for($i = 0; $i < $varlen; $i++) {
    $sql1 = "INSERT INTO `tblmat_deliverydetails` (`del_matDelID`, `del_matVarID`, `del_quantity`, `del_remarks`) VALUES ('$id', '$varid[$i]','$quantity[$i]','$status')";
    mysqli_query($conn, $sql1);
	$sID = mysqli_insert_id($conn);
    $flag++;
}

for($i = 0; $i < $varlen; $i++) {
    
    $sql2 = "SELECT * FROM tblmat_inventory WHERE matVariantID = '$varid[$i]'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if($row2 == false){
        $sql3 = "INSERT INTO `tblmat_inventory` (`matVariantID`, `matVarQuantity`) VALUES ('$varid[$i]','$quantity[$i]')";
        mysqli_query($conn, $sql3);
        $flag++;
    }
    else{
        $added = $row2['matVarQuantity'] + $quantity[$i];
        $sql4 = "UPDATE `tblmat_inventory` SET `matVarQuantity`='$added' WHERE `matVariantID`='$varid[$i]'";
        mysqli_query($conn, $sql4);
        $flag++;
    }
    
}

$sql5 = "SELECT * FROM tblsupplier WHERE supplierID = '$sup'";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);

if ($flag>0) {
	// Logs start here
	// ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new deliveries from supplier ".$row5['supCompName'].", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Material Deliveries', 'New', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	$_SESSION['createSuccess'] = 'Success';
	header( 'Location: raw-materials-monitoring.php');
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
mysqli_close($conn);
?>