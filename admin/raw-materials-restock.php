<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$sup = $_POST['supplier'];
$pcs = $_POST['pcs'];

$box = $_POST['box'];

if($box==0){
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
}

mysqli_close($conn);
}
?>