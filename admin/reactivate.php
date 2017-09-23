<?php
session_start();
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
	header( "Location: supplier.php?reactivateSuccess" );
}
else {
	header( "Location: supplier.php?actionFailed" );
}
}

if($rName=="Unit Of Measurement Category"){
$updateSql = "UPDATE tblunitofmeasurement_category SET uncategoryStatus = 'Active' WHERE uncategoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: unit-of-measurement-category.php?reactivateSuccess" );
}
else {
	header( "Location: unit-of-measurement-category.php?actionFailed" );
}
}

if($rName=="Unit Of Measurement"){
$updateSql = "UPDATE tblunitofmeasure SET unStatus = 'Active' WHERE unID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: unit-of-measurement.php?reactivateSuccess" );
}
else {
	header( "Location: unit-of-measurement.php?actionFailed" );
}
}

if($rName=="Material Attribute"){
$updateSql = "UPDATE tblattributes SET attributeStatus = 'Active' WHERE attributeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-attribute.php?reactivateSuccess" );
}
else {
	header( "Location: material-attribute.php?actionFailed" );
}
}

if($rName=="Material Type"){
$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Listed' WHERE matTypeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-type.php?reactivateSuccess" );
}
else {
	header( "Location: material-type.php?actionFailed" );
}
}

if($rName=="Materials"){
$updateSql = "UPDATE tblmaterials SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: materials.php?reactivateSuccess" );
}
else {
	header( "Location: materials.php?actionFailed" );
}
}

if($rName=="Material Variants"){
$updateSql = "UPDATE tblmat_var SET mat_varStatus ='Active' WHERE mat_varID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-variants.php?reactivateSuccess" );
}
else {
	header( "Location: material-variants.php?actionFailed" );
}
}

if($rName=="Category"){
$updateSql = "UPDATE tblfurn_category SET categoryStatus = 'Listed' WHERE categoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: category.php?reactivateSuccess" );
}
else {
	header( "Location: category.php?actionFailed" );
}
}

if($rName=="Type"){
$updateSql = "UPDATE tblfurn_type SET typeStatus = 'Listed' WHERE typeID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: furniture-type.php?reactivateSuccess" );
}
else {
	header( "Location: furniture-type.php?actionFailed" );
}
}

if($rName=="Fabric Texture"){
$updateSql = "UPDATE tblfabric_texture SET textureStatus = 'Listed' WHERE textureID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-texture.php?reactivateSuccess" );
}
else {
	header( "Location: fabric-texture.php?actionFailed" );
}
}

if($rName=="Fabric Type"){
$updateSql = "UPDATE tblfabric_type SET f_typeStatus = 'Listed'  WHERE f_typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-type.php?reactivateSuccess" );
}
else {
	header( "Location: fabric-type.php?actionFailed" );
}
}

if($rName=="Fabric Pattern"){
$updateSql = "UPDATE tblfabric_pattern SET f_patternStatus = 'Listed' WHERE f_patternID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-pattern.php?reactivateSuccess" );
}
else {
	header( "Location: fabric-pattern.php?actionFailed" );
}
}

if($rName=="Fabrics"){
$updateSql = "UPDATE tblfabrics SET fabricStatus = 'Listed' WHERE fabricID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabrics.php?reactivateSuccess" );
}
else {
	header( "Location: fabrics.php?actionFailed" );
}
}

if($rName=="Frame Design"){
$updateSql = "UPDATE tblframe_design SET designStatus = 'Listed' WHERE designID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: frame-design.php?reactivateSuccess" );
}
else {
	header( "Location: frame-design.php?actionFailed" );
}
}

if($rName=="Frame Material"){

$updateSql = "UPDATE tblframe_material SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: framework-material.php?reactivateSuccess" );
}
else {
	header( "Location: framework-material.php?actionFailed" );
}
}

if($rName=="Frameworks"){

$updateSql = "UPDATE tblframeworks SET frameworkStatus = 'Listed' WHERE frameworkID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: frameworks.php?reactivateSuccess" );
}
else {
	header( "Location: frameworks.php?actionFailed" );
}
}

if($rName=="Products"){
$updateSql = "UPDATE tblproduct SET prodStat = 'On-Hand' WHERE productID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: products.php?reactivateSuccess" );
}
else {
	header( "Location: products.php?actionFailed" );
}
}

if($rName=="Packages"){
$updateSql = "UPDATE tblpackages SET packageStatus = 'Listed' WHERE packageID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: packages.php?reactivateSuccess" );
}
else {
	header( "Location: packages.php?actionFailed" );
}
}

if($rName=="Production Information"){
$updateSql = "UPDATE tblprod_info SET prodInfoStatus = 'Active' WHERE prodInfoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: production-information.php?reactivateSuccess" );
}
else {
	header( "Location: production-information.php?actionFailed" );
}
}

if($rName=="Jobs"){
$updateSql = "UPDATE tbljobs SET jobStatus = 'Listed' WHERE jobID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: jobs.php?reactivateSuccess" );
}
else {
	header( "Location: jobs.php?actionFailed" );
}
}

if($rName=="Employees"){
$updateSql = "UPDATE tblemployee SET empStatus = 'Active' WHERE empID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: employees.php?reactivateSuccess" );
}
else {
	header( "Location: employees.php?actionFailed" );
}
}

if($rName=="Promos"){
$updateSql = "UPDATE tblpromos SET promoStatus = 'Active' WHERE promoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: promo.php?reactivateSuccess" );
}
else {
	header( "Location: promo.php?actionFailed" );
}
}

if($rName=="Delivery Rates"){

$updateSql = "UPDATE tbldelivery_rates SET delRateStatus = 'Listed' WHERE delivery_rateID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: delivery-rates.php?reactivateSuccess" );
}
else {
	header( "Location: delivery-rates.php?actionFailed" );
}
}

/* UTILITIES */
if($rName=="Branches"){
$updateSql = "UPDATE tblbranches SET branchStatus = 'Listed' WHERE branchID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: branches.php?reactivateSuccess" );
}
else {
	header( "Location: branches.php?actionFailed" );
}
}

if($rName=="Users"){
$updateSql = "UPDATE tbluser SET userStatus = 'Active' WHERE userID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: users.php?reactivateSuccess" );
}
else {
	header( "Location: users.php?actionFailed" );
}
}

if($rName=="Mode Of Payment"){
$updateSql = "UPDATE tblmodeofpayment SET modeofpaymentStatus = 'Active' WHERE modeofpaymentID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: mode-of-payment.php?reactivateSuccess" );
}
else {
	header( "Location: mode-of-payment.php?actionFailed" );
}
}

if($rName=="Penalties"){
$updateSql = "UPDATE tblpenalty SET penStatus = 'Active' WHERE penaltyID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: penalties.php?reactivateSuccess" );
}
else {
	header( "Location: penalties.php?actionFailed" );
}
}

if($rName=="Phases"){
$updateSql = "UPDATE tblphases SET phaseStatus = 'Active' WHERE phaseID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: phases.php?reactivateSuccess" );
}
else {
	header( "Location: phases.php?actionFailed" );
}
}

?>