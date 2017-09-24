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
    $_SESSION['createSuccess'] = 'Success';
  header( 'Location: ' . $_SERVER['HTTP_REFERER']);
} 
 else {
    $_SESSION['actionFailed'] = 'Failed';
  header( 'Location: ' . $_SERVER['HTTP_REFERER']);
  }


  mysqli_close($conn);
}
?>