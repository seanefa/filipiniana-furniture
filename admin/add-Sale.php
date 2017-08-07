<?php

$sRate = $_POST['saleRate'];
$sRemarks = $_POST['saleRemarks'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$status = "exist";

                    //image uploading code
                    //$target = "images/".basename($_FILES["image"]["name"]);



                    //end of uploading code

include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO tblsale_details(saleRate, saleRemarks, saleStartDate, saleEndDate, saleStatus) VALUES('$sRate','$sRemarks','$startDate','$endDate','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {

    echo '<script type="text/javascript">';
    echo 'alert("RECORD SUCCESFULLY SAVED!")';
    header( "Location: saledetails.php" );
    echo '</script>';

  } 
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


  mysqli_close($conn);
}
?>