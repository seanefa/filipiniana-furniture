<?php

$pRate = $_POST['rate'];
$pName = $_POST['name'];
$remarks = $_POST['remarks'];
$type = $_POST['type'];
$status = "Active";


include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$remarks = mysqli_real_escape_string($conn,$remarks);

$sql = "INSERT INTO `tblpenalty` (`penaltyRate`, `penaltyRemarks`, `penStatus`, `penaltyName`, `penaltyRateType`) VALUES ('$pRate', '$remarks','$status','$pName','$type')";
if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: penalties.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  mysqli_close($conn);
}
?>