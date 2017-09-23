<?php
include "session-check.php";
include 'dbconnect.php';

$sRate = $_POST['saleRate'];
$sRemarks = $_POST['saleRemarks'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$status = "exist";

                    //image uploading code
                    //$target = "images/".basename($_FILES["image"]["name"]);



                    //end of uploading code

$sql = "INSERT INTO tblsale_details(saleRate, saleRemarks, saleStartDate, saleEndDate, saleStatus) VALUES('$sRate','$sRemarks','$startDate','$endDate','$status')";
if($sql){
  if (mysqli_query($conn, $sql)) {
    header( "Location: saledetails.php?newSuccess" );
  } 
  else {
    header( "Location: saledetails.php?actionFailed" );
  }


  mysqli_close($conn);
}
?>