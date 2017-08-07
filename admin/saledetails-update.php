<?php
session_start();
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION['varname'];
$editsRate = $_POST['editsaleRate'];
$editsRemarks = $_POST['editsaleRemarks'];
$editstartDate = $_POST['editstartDate'];
$editendDate = $_POST['editendDate'];


        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblsale_details SET saleRate='$editsRate', saleRemarks='$editsRemarks', saleStartDate='$editstartDate', saleEndDate='$editendDate' WHERE saledetailID=$id";

if(mysqli_query($conn,$updateSql)){
	echo '<script type="text/javascript">';
	echo 'alert("RECORD SUCCESFULLY SAVED!")';
	header( "Location: saledetails.php" );
	echo '</script>';
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>