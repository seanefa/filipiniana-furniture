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

if($rName=="Supplier"){
$updateSql = "UPDATE tblsupplier SET supStatus = 'Listed' WHERE supplierID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: supplier.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Unit Of Measurement Category"){
$updateSql = "UPDATE tblunitofmeasurement_category SET uncategoryStatus = 'Active' WHERE uncategoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: unit-of-measurement-category.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Unit Of Measurement"){
$updateSql = "UPDATE tblunitofmeasure SET unStatus = 'Active' WHERE unID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: unit-of-measurement.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Material Attribute"){
$updateSql = "UPDATE tblattributes SET attributeStatus = 'Active' WHERE attributeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-attribute.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Material Type"){
$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Listed' WHERE matTypeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Materials"){
$updateSql = "UPDATE tblmaterials SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: materials.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Material Variants"){
$updateSql = "UPDATE tblmat_var SET variantStatus = 'Listed' WHERE variantID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: material-variants.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Category"){
$updateSql = "UPDATE tblfurn_category SET categoryStatus = 'Listed' WHERE categoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: category.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Type"){
$updateSql = "UPDATE tblfurn_type SET typeStatus = 'Listed' WHERE typeID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: furniture-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric Texture"){
$updateSql = "UPDATE tblfabric_texture SET textureStatus = 'Listed' WHERE textureID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-texture.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric Type"){
$updateSql = "UPDATE tblfabric_type SET f_typeStatus = 'Listed'  WHERE f_typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric Pattern"){
$updateSql = "UPDATE tblfabric_pattern SET f_patternStatus = 'Listed' WHERE f_patternID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: fabric-pattern.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabrics"){
$updateSql = "UPDATE tblfabrics SET fabricStatus = 'Listed' WHERE fabricID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: fabrics.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Frame Design"){
$updateSql = "UPDATE tblframe_design SET designStatus = 'Listed' WHERE designID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: frame-design.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Frame Material"){

$updateSql = "UPDATE tblframe_material SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: framework-material.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Frameworks"){

$updateSql = "UPDATE tblframeworks SET frameworkStatus = 'Listed' WHERE frameworkID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: frameworks.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Products"){
$updateSql = "UPDATE tblproduct SET prodStat = 'On-Hand' WHERE productID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: products.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Packages"){
$updateSql = "UPDATE tblpackages SET packageStatus = 'Listed' WHERE packageID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: packages.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Production Information"){
$updateSql = "UPDATE tblprod_info SET prodInfoStatus = 'Active' WHERE prodInfoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: production-information.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Jobs"){
$updateSql = "UPDATE tbljobs SET jobStatus = 'Listed' WHERE jobID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: jobs.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Employees"){
$updateSql = "UPDATE tblemployee SET empStatus = 'Active' WHERE empID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: employees.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Promos"){
$updateSql = "UPDATE tblpromos SET promoStatus = 'Active' WHERE promoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: promo.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Delivery Rates"){

$updateSql = "UPDATE tbldelivery_rates SET delRateStatus = 'Listed' WHERE delivery_rateID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: delivery-rates.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Penalty"){
$updateSql = "UPDATE tblpenalty SET penStatus = 'Active' WHERE penaltyID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: penalties.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}
?>