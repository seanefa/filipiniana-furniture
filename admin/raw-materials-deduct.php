<?php
include "session-check.php";
include 'dbconnect.php';

$id = $_SESSION['varname'];
$q = $_POST['quantity'];
$rem = $_POST['remarks'];

$matname = "";
$sql = "SELECT * FROM tblmat_var a, tblmaterials b WHERE a.mat_varID = b.materialID AND variantID ='$id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
	$matname = $row['variantDescription'] .' '. $row['materialName'];
	$quan = $row['variantQuantity'];

}


$gt = $quan - $q;
$desc = "Deducted " . $q . " pcs of " . $matname .". ".$rem.".";
$date = date("Y/m/d"); 

$sql1 = "INSERT INTO .`tblinventory_logs` (`inLogDescription`, `inLogDate`) VALUES ('$desc', '$date')";

mysqli_query($conn,$sql1);

$sql = "UPDATE tblmat_var SET variantQuantity = '$gt' WHERE variantID = '$id'"; 
if($sql){
  if (mysqli_query($conn, $sql)) {
   $_SESSION['createSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
mysqli_close($conn);
?>