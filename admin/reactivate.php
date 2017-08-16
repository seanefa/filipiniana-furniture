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

if($rName=="Unit of Measure"){
$updateSql = "UPDATE tblunitofmeasure SET unStatus = 'Listed' WHERE unID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-unit-of-measurement.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Category"){
$updateSql = "UPDATE tblfurn_category SET categoryStatus = 'Listed' WHERE categoryID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-categories.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}


if($rName=="Fabric Texture"){
$updateSql = "UPDATE tblfabric_texture SET textureStatus = 'Listed' WHERE textureID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-fabric-texture.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}


if($rName=="Delivery Rate"){

$updateSql = "UPDATE tbldelivery_rates SET delRateStatus = 'Listed' WHERE delivery_rateID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-delivery-rates.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric Pattern"){
$updateSql = "UPDATE tblfabric_pattern SET f_patternStatus = 'Listed' WHERE f_patternID = '$jsID'";
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-fabric-pattern.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric Type"){
$updateSql = "UPDATE tblfabric_type SET f_typeStatus = 'Listed'  WHERE f_typeID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-fabric-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Fabric"){
$updateSql = "UPDATE tblfabrics SET fabricStatus = 'Listed' WHERE fabricID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-fabrics.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Frame Design"){
$updateSql = "UPDATE tblframe_design SET designStatus = 'Listed' WHERE designID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-framework-design.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
}

if($rName=="Frame Material"){

$updateSql = "UPDATE tblframe_material SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-framework-material.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Framework"){


$updateSql = "UPDATE tblframeworks SET frameworkStatus = 'Listed' WHERE frameworkID = '$jsID'";

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-frameworks.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Type"){
$updateSql = "UPDATE tblfurn_type SET typeStatus = 'Listed' WHERE typeID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-furniture-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Job"){
$updateSql = "UPDATE tbljobs SET jobStatus = 'Listed' WHERE jobID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-jobs.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Packages"){
$updateSql = "UPDATE tblpackages SET packageStatus = 'Listed' WHERE packageID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-packages.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Penalty"){
$updateSql = "UPDATE tblpenalty SET penStatus = 'Active' WHERE penaltyID = '$jsID'";
        // Check connection
if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-penalties.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Product"){
$updateSql = "UPDATE tblproduct SET prodStat = 'On-Hand' WHERE productID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-products.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}

if($rName=="Promo"){
$updateSql = "UPDATE tblpromos SET promoStatus = 'Active' WHERE promoID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-promos.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
if($rName=="Employee"){
$updateSql = "UPDATE tblemployee SET empStatus = 'Active' WHERE empID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-employees.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
if($rName=="Material Attribute"){
$updateSql = "UPDATE tblattributes SET attributeStatus = 'Active' WHERE attributeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-material-attribute.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
if($rName=="Material Type"){
$updateSql = "UPDATE tblmat_type SET matTypeStatus = 'Listed' WHERE matTypeID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-material-type.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
if($rName=="Material"){
$updateSql = "UPDATE tblmaterials SET materialStatus = 'Listed' WHERE materialID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-material.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
if($rName=="Material Variants"){
$updateSql = "UPDATE tblmat_var SET variantStatus = 'Listed' WHERE variantID = '$jsID'";
        // Check connection

if(mysqli_query($conn,$updateSql)){
	header( "Location: archived-material-variants.php?reactivateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

}
?>