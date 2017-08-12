<?php
session_start();
include 'dbconnect.php';

$id = $_SESSION['varname'];

$name = $_POST['name'];
$material = $_POST['material'];
$design = $_POST['design'];
<<<<<<< HEAD
=======
$type = $_POST['type'];

>>>>>>> c246cc9f7fd38221eb454966397fea7fce98f214
$remarks = $_POST['remarks'];
$pic = "";
$exist_image = $_POST["exist_image"];

if ($_FILES["image"]["error"])
{
 echo "Error: NO CHOSEN FILE";
 echo"INSERT TO DATABASE FAILED";
}
else
{
 move_uploaded_file($_FILES["image"]["tmp_name"],"plugins/images/" . date("Y-m-d") . time() . ".png");
 echo "SAVED" ;
 $pic = date("Y-m-d") . time() . ".png";
}

if($pic==""){
	$pic = $exist_image;
}
<<<<<<< HEAD
        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$updateSql = "UPDATE tblframeworks SET frameworkName='$name',frameDesignID='$design',materialUsedID='$material', frameworkRemarks='$remarks', frameworkPic='$pic' WHERE frameworkID=$id";
=======

$updateSql = "UPDATE tblframeworks SET frameworkName='$name', frameworkFurnType='$type',frameDesignID='$design',materialUsedID='$material', frameworkRemarks='$remarks', frameworkPic='$pic' WHERE frameworkID=$id";
>>>>>>> c246cc9f7fd38221eb454966397fea7fce98f214

if(mysqli_query($conn,$updateSql)){
	header( "Location: frameworks.php?updateSuccess" );
}
else {
	echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
}

?>