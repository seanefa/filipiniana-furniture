<?php
session_start();
include 'dbconnect.php';


$fabric=0;


if(isset($_POST['_fabric']))
{
	$fabric = $_POST['_fabric'];
}

$id = $_SESSION['varname'];
$category = $_POST["_category"];
$type = $_POST["_type"];
$framework = $_POST["_framework"];
$design = $_POST["_design"];
$name = $_POST["_name"];
$description = $_POST["_description"];
$price = $_POST["_price"];
$pic = "";
$dimension = $_POST["_dimensions"];
$exist_image = $_POST["exist_image"];

if($_FILES["image"]["error"] > 0)
{
	echo "Error: NO CHOSEN FILE<br>";
	echo "INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED";
 $pic = date("Y-m-d") . time() . ".png";
}

if($pic=="")
{
	$pic = $exist_image;
}
// Create connection
$updateSql = "UPDATE tblproduct SET prodCatID='$category', prodTypeID='$type', prodFrameworkID='$framework', prodDesign='$design',	prodFabricID='$fabric', productName='$name', productDescription='$description', productPrice='$price', prodMainPic='$pic', prodSizeSpecs='$dimension' WHERE productID=$id";

if(true)//mysqli_query($conn,$updateSql))
{/*
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: products.php?updateSuccess" );
	echo '</script>';*/
}
else
{
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>
