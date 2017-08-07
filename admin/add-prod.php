<?php

$prName = $_POST['_prodName'];
$prCtg = $_POST['_category'];
$type = $_POST['_type'];
$design = $_POST['design'];

$prFabric = "";
$prFabric = "N/A";
if(isset($_POST['_fabric'])){
	$prFabric = $_POST['_fabric'];
}

$prPrice = $_POST['_price'];
$prFramework = $_POST['_framework'];
$prDesc = $_POST['_prodDesc'];
$capacity = $_POST['capacity'];
$dimension = $_POST['dimensions'];
$prodStat = "Pre-Order";
$pic = "";

$p = str_replace(',','',$prPrice);
$prPrice = $p;

include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_FILES["image"]["error"] > 0)
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/" . $_FILES["image"]["name"]);
 echo "SAVED" ;

 $pic = $_FILES["image"]["name"];

}

$sql = "INSERT INTO `tblproduct` (`prodTypeID`,`prodCatID`,`prodFrameworkID`, `prodFabricID`, `productName`, `productDescription`, `productPrice`, `prodMainPic`, `prodSizeSpecs`, `prodCapacity`,`prodStat`,`prodDesign`) VALUES ('$type','$prCtg', '$prFramework', '$prFabric', '$prName', '$prDesc', '$prPrice', '$pic', '$dimension', '$capacity', '$prodStat','$design')";

if (mysqli_query($conn, $sql)) {
  header( "Location: products.php?newSuccess" );
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>