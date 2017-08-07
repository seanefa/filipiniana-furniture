<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['ctgName'];
$remarks = $_POST['remarks'];
$status = "Active";

$sql = "INSERT INTO `tblunitofmeasurement_category` (`uncategoryName`, `uncategoryStatus`, `uncategoryDescription`) VALUES ('$name', '$status','$remarks');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: unitofmeasurementcategory.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>