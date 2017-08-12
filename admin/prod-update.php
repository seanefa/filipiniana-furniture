<?php
session_start();
include 'dbconnect.php';


$id = $_SESSION['varname'];
$category=$_POST["_category"];
$type=$_POST["_type"];
$framework=$_POST["_framework"];
$design=$_POST["_design"];
$fabric=$_POST["_fabric"];
$name=$_POST["_name"];
$decription=$_POST["_description"];
$price=$_POST["_price"];
$pic="";
$dimension=$_POST["_dimensions"];

//$editName = $_POST['_name'];
//$editFrame = $_POST['_framework'];
//$editFabric = $_POST['_fabric'];
//
//$typeCat = $_POST['_category'];
//$editCategory = $_POST['_category'];
//$editCapacity = $_POST['capacity'];
//$editSize = $_POST['dimensions'];
//$editPrice = $_POST['_price'];
//$editDesc = $_POST['_prodDesc'];
//$editQuantity = $_POST['quan'];


$exist_image=$_POST["exist_image"];

if($_FILES["image"]["error"] > 0)
{
	echo "Error: NO CHOSEN FILE";
	echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"], "plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED";
 $pic = date("Y-m-d") . time() . ".png";
}

if($pic=="")
{
	$pic=$exist_image;
}

// Create connection
$updateSql = "UPDATE tblproduct SET productName='$editName', productDescription='$editDesc', productPrice='$editPrice', prodFrameworkID='$editFrame', prodFabricID='$editFabric', prodCatID='$typeCat',prodTypeID='$editCategory',prodSizeSpecs='$editSize',prodMainPic='$pic', prodCapacity='$editCapacity', prodQuantity='$editQuantity' WHERE productID=$id";

if(mysqli_query($conn,$updateSql))
{
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: products.php?updateSuccess" );
	echo '</script>';
}
else 
{
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}
?>