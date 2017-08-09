<?php
include 'dbconnect.php';

$name = $_POST['name'];
$desc = $_POST['desc'];
$measures = "measuring is on materials.";
$status = "Listed";

$measures = substr(trim($measures), 0, -1);


$sql = "INSERT INTO `tblmat_type` (`matTypeName`, `matTypeRemarks`,`matTypeMeasure`, `matTypeStatus`) VALUES ('$name','$desc','$measures','$status');";
echo $sql . "<br>";


if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: material-type.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>