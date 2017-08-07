<?php

include 'dbconnect.php';
session_start();
$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$ln = $_POST['newlastn'];
$mn = $_POST['newmidn'];
$fn = $_POST['newcustn'];
$addrss = $_POST['newcustoadd'];
$cont = $_POST['newcustocont'];
$emailadd = $_POST['newcustoemail'];






$sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd')";


if (mysqli_query($conn, $sql)) {


            echo '<script type="text/javascript">';
            header( "Location: point-of-sales.php" );
            echo '</script>';
    
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


  


mysqli_close($conn);

?>