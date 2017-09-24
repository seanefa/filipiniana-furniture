<?php
include "session-check.php";
include 'dbconnect.php';

$name = $_POST['name'];
$remarks = $_POST['attribs'];
$status = "Listed";

$sql = "INSERT INTO `tblmaterials` (`materialName`, `materialVarAttribs`, `materialStatus`) VALUES ('$name', '$remarks','$status')";
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