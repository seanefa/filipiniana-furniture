<?php
include "session-check.php";
include 'dbconnect.php';

$varid = $_SESSION['varid'];
$sup = $_POST['supplier'];
/*$pcs = $_POST['pcs'];

$box = $_POST['box'];*/
$quan = $_POST['quan'];
$status = "Listed";
$flag=0;


$sql = "INSERT INTO `tblmat_deliveries` (`supplierID`, `totalQuantity`, `mat_deliveryRemarks`, `mat_deliveryStatus`) VALUES ('$sup', '$quan','$status','$status')";
mysqli_query($conn, $sql);

$id = mysqli_insert_id($conn);

$sql1 = "INSERT INTO `tblmat_deliverydetails` (`del_matDelID`, `del_matVarID`, `del_quantity`, `del_remarks`) VALUES ('$id', '$varid','$quan','$status')";
mysqli_query($conn, $sql1);
$flag++;

$sql2 = "SELECT * FROM tblmat_inventory WHERE matVariantID = '$varid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$added = $row2['matVarQuantity'] + $quan;
$sql4 = "UPDATE `tblmat_inventory` SET `matVarQuantity`='$added' WHERE `matVariantID`='$varid'";
mysqli_query($conn, $sql4);
$flag++;


if ($flag>0) {
	// Logs start here
	$sID = mysqli_insert_id($conn); // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Added new material ".$name.", ID = " .$sID;
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

/*if($box==0){
	$box = 1;
}

$total = $pcs * $box;
$supname = "";

$sql = "SELECT * FROM tblsupplier WHERE supplierID ='$sup'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
	$supname = $row['supCompName'];
}


$matname = "";
$sql = "SELECT * FROM tblmat_var a, tblmaterials b WHERE a.mat_varID = b.materialID AND variantID ='$id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
	$matname = $row['variantDescription'] .' '. $row['materialName'];
	$quan = $row['variantQuantity'];

}


$gt = $total + $quan;
$desc = $supname . " supplied " . $total . " pcs of " . $matname;
$date = date("Y/m/d"); 

$sql1 = "INSERT INTO .`tblinventory_logs` (`inLogDescription`, `inLogDate`) VALUES ('$desc', '$date')";

mysqli_query($conn,$sql1);


$sql = "UPDATE tblmat_var SET variantQuantity = '$gt' WHERE variantID = '$id'"; 
if($sql){
  if (mysqli_query($conn, $sql)) {
   header( "Location: raw-materials-management.php?newSuccess" );
 } 
 else {
   header( "Location: raw-materials-management.php?actionFailed" );
}*/

mysqli_close($conn);

?>