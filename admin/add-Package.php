<?php
include 'dbconnect.php';
//include 'packages-form.php';


$pName = $_POST['pName'];
$price = $_POST['pPrice'];
$status = "Listed";
$flag = 0;

$p = str_replace(',','',$price);
$pPrice = $p;

$sql = "SELECT * FROM tblpackages;";
$result = mysqli_query($conn, $sql);
$temp = 0;
while ($row = mysqli_fetch_assoc($result))
{
  $temp++;
}
$fID = $temp;

$sql = "INSERT INTO tblpackages(packageID, packageDescription, packagePrice,packageStatus) VALUES('$fID','$pName','$pPrice','$status')";

mysqli_query($conn, $sql); //package saved
$shit = $_POST['pr'];
//inclusions
foreach($shit as $str) {
$sql1 = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$str','$fID','$status')";
mysqli_query($conn,$sql1);
  $flag++;
}


if($flag>0){
      header( "Location: packages.php?newSuccess" );
}
else{
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>