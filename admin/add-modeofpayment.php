<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$desc = $_POST['desc'];
$status = "Active";

$sql = "INSERT INTO `tblmodeofpayment` (`modeofpaymentDesc`, `modeofpaymentStatus`) VALUES ('$desc', '$status');";

if($sql){
  if (mysqli_query($conn, $sql)) {

    
    echo '<script type="text/javascript">';
    echo 'alert("RECORD SUCCESFULLY SAVED!")';
    header( "Location: mode-of-payment.php" );
    echo '</script>';

  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
mysqli_close($conn);
?>