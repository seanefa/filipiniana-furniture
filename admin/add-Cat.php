<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['ctgName'];
$remarks = $_POST['remarks'];
$status = "Listed";

$sql = "INSERT INTO `tblfurn_category` (`categoryName`, `categoryStatus`, `categoryRemarks`) VALUES ('$name', '$status','$remarks');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: category.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>