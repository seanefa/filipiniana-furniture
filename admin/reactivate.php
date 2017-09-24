<?php
include "session-check.php";
include 'dbconnect.php';

if(isset($_GET['id'])){
	$jsID = $_GET['id'];  
}


$jsID = $_GET['id'];
$rName = $_GET['rName'];

echo $rName;
echo $jsID;

/* MAINTENANCE */
if($rName=="Supplier"){
$updateSql = "UPDATE tblsupplier SET supStatus = 'Listed' WHERE supplierID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Unit Of Measurement Category"){
$updateSql = "UPDATE tblunitofmeasurement_category SET uncategoryStatus = 'Active' WHERE uncategoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Unit Of Measurement"){
$updateSql = "UPDATE tblunitofmeasure SET unStatus = 'Active' WHERE unID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Material Attribute"){
$updateSql = "UPDATE tblattributes SET attributeStatus = 'Active' WHERE attributeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Material Type"){
$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Listed' WHERE matTypeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Materials"){
$updateSql = "UPDATE tblmaterials SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Material Variants"){
$updateSql = "UPDATE tblmat_var SET mat_varStatus ='Active' WHERE mat_varID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Category"){
$updateSql = "UPDATE tblfurn_category SET categoryStatus = 'Listed' WHERE categoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Type"){
$updateSql = "UPDATE tblfurn_type SET typeStatus = 'Listed' WHERE typeID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Fabric Texture"){
$updateSql = "UPDATE tblfabric_texture SET textureStatus = 'Listed' WHERE textureID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Fabric Type"){
$updateSql = "UPDATE tblfabric_type SET f_typeStatus = 'Listed'  WHERE f_typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Fabric Pattern"){
$updateSql = "UPDATE tblfabric_pattern SET f_patternStatus = 'Listed' WHERE f_patternID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Fabrics"){
$updateSql = "UPDATE tblfabrics SET fabricStatus = 'Listed' WHERE fabricID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Frame Design"){
$updateSql = "UPDATE tblframe_design SET designStatus = 'Listed' WHERE designID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Frame Material"){

$updateSql = "UPDATE tblframe_material SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Frameworks"){

$updateSql = "UPDATE tblframeworks SET frameworkStatus = 'Listed' WHERE frameworkID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Products"){
$updateSql = "UPDATE tblproduct SET prodStat = 'On-Hand' WHERE productID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Packages"){
$updateSql = "UPDATE tblpackages SET packageStatus = 'Listed' WHERE packageID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Production Information"){
$updateSql = "UPDATE tblprod_info SET prodInfoStatus = 'Active' WHERE prodInfoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Jobs"){
$updateSql = "UPDATE tbljobs SET jobStatus = 'Listed' WHERE jobID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Employees"){
$updateSql = "UPDATE tblemployee SET empStatus = 'Active' WHERE empID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Promos"){
$updateSql = "UPDATE tblpromos SET promoStatus = 'Active' WHERE promoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Delivery Rates"){

$updateSql = "UPDATE tbldelivery_rates SET delRateStatus = 'Listed' WHERE delivery_rateID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

/* UTILITIES */
if($rName=="Branches"){
$updateSql = "UPDATE tblbranches SET branchStatus = 'Listed' WHERE branchID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Users"){
$updateSql = "UPDATE tbluser SET userStatus = 'Active' WHERE userID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Mode Of Payment"){
$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentStatus = 'Active' WHERE modeofpaymentID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Penalties"){
$updateSql = "UPDATE tblpenalty SET penStatus = 'Active' WHERE penaltyID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if($rName=="Phases"){
$updateSql = "UPDATE tblphases SET phaseStatus = 'Active' WHERE phaseID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	$_SESSION['reactivateSuccess'] = 'Success';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
	header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

?>