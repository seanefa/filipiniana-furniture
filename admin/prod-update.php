<?php
include "session-check.php";
include 'dbconnect.php';
session_start();

$id = $_SESSION['varname'];

$fabric = 0;

//if(isset($_POST['_fabric']))
//{
//	$fabric = $_POST['_fabric'];
//}

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
$file= date("Y-m-d") . time() . ".png";
$tmp_name=$_FILES["image"]["tmp_name"];

$p = str_replace(',','',$price);
$price = $p;

if($_FILES["image"]["error"] > 0)
{
	echo "Error: NO CHOSEN FILE<br>";
	echo "INSERT TO DATABASE FAILED";
}
else
{
	move_uploaded_file($tmp_name, "plugins/products/" . date("Y-m-d") . time() . ".png");	 
	echo "SAVED";
	$pic = date("Y-m-d") . time() . ".png";
}

if($pic=="")
{
	$pic = $exist_image;
}

echo $pic;
// Create connection
$updateSql = "UPDATE tblproduct SET prodCatID='$category', prodTypeID='$type', prodFrameworkID='$framework', prodDesign='$design',	prodFabricID='$fabric', productName='$name', productDescription='$description', productPrice='$price', prodMainPic='$pic', prodSizeSpecs='$dimension' WHERE productID=$id";

echo $updateSql;

if(mysqli_query($conn,$updateSql)){
	// Logs start here
	$sID = $id; // ID of last input;
	$date = date("Y-m-d");
	$logDesc = "Updated product ".$name.", ID = " .$sID;
	$empID = $_SESSION['userID'];
	$logSQL = "INSERT INTO `tbllogs` (`category`, `action`, `date`, `description`, `userID`) VALUES ('Products', 'Update', '$date', '$logDesc', '$empID')";
	mysqli_query($conn,$logSQL);
	// Logs end here
	header( "Location: products.php?updateSuccess" );
} else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
  }
?>