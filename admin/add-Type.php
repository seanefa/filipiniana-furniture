<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['ctgName'];
$cat = $_POST['cat'];
$desc = $_POST['desc'];
$status = "Listed";

$sql = "INSERT INTO `tblfurn_type` (`typeName`, `typeDescription`, `typeStatus`, `typeCategoryID`) VALUES ('$name', '$desc','$status' , '$cat');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: furniture-type.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>