<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editName = $_POST['_prodName'];
$editFrame = $_POST['_framework'];
$editFabric = $_POST['_fabric'];
$typeCat = $_POST['cat'];
$editCategory = $_POST['_category'];
$editCapacity = $_POST['capacity'];
$editSize = $_POST['dimensions'];
$editPrice = $_POST['_price'];
$editDesc = $_POST['_prodDesc'];
$editQuantity = $_POST['quan'];
$editImage = $_POST['image'];

        // Create connection
$updateSql = "UPDATE tblproduct SET productName='$editName', productDescription='$editDesc', productPrice='$editPrice', prodFrameworkID='$editFrame', prodFabricID='$editFabric', prodCatID='$typeCat',prodTypeID='$editCategory',prodSizeSpecs='$editSize',prodMainPic='$editImage', prodCapacity='$editCapacity', prodQuantity='$editQuantity' WHERE productID=$id";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: products.php?updateSuccess" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>