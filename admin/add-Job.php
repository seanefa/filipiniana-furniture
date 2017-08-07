<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$desc = $_POST['desc'];
$status = "Listed";

$sql = "INSERT INTO `tbljobs` (`jobName`, `jobDescription`, `jobStatus`) VALUES ('$name','$desc', '$status');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: jobs.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>