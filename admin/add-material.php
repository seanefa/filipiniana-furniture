<?php
include 'dbconnect.php';

$name = $_POST['name'];
$remarks = $_POST['remarks'];
$status = "Listed";

$sql = "INSERT INTO `tblframe_material` (`materialName`, `materialRemarks`, `materialStatus`) VALUES ('$name', '$remarks','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {
   header( "Location: framework-material.php?newSuccess" );
 } 
 else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>