<?php
include 'dbconnect.php';

$name = $_POST['name'];
$remarks = $_POST['attribs'];
$status = "Listed";

$sql = "INSERT INTO `tblmaterials` (`materialName`, `materialVarAttribs`, `materialStatus`) VALUES ('$name', '$remarks','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {
   header( "Location: materials.php?newSuccess" );
 } 
 else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>