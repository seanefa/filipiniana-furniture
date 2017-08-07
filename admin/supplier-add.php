<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['compname'];
$add = $_POST['compadd'];
$telnum = $_POST['telnum'];
$posi = $_POST['posi'];
$conper = $_POST['conper'];
$status = "Listed";

$sql = "INSERT INTO `filfurnituredb`.`tblsupplier` (`supCompName`, `supCompAdd`, `supCompNum`, `supContactPerson`, `supPosition`,`supStatus`) VALUES ('$name', '$add', '$telnum', '$conper', '$posi', '$status');";

if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: supplier.php?newSuccess" );
  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>