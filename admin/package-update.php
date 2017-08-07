<?php
include 'dbconnect.php';


$pName = $_POST['pName'];
$pPrice = $_POST['pPrice'];
$id = $_POST['id'];
$status = "Listed";
$flag = 0;

$sql = "SELECT * FROM tblpackages;";
$result = mysqli_query($conn, $sql);

$temp=0;
while ($row = mysqli_fetch_assoc($result))
{
	$temp++;
}
$fID = $temp;


$sql = "UPDATE tblpackages SET packageDescription='$pName', packagePrice='$pPrice' WHERE packageID = '$id'";
if($sql){
	if (mysqli_query($conn, $sql)) {
		$flag++;
	} 
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

/*
foreach($shit as $str) {
echo"<script>alert(". $str .")</script>";
$sql1 = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$str','$fID','$status')";
mysqli_query($conn,$sql1);
  $flag++;
}

*/

if(isset($_POST['pis'])){
	$shit = $_POST['pis'];

	foreach($shit as $str) {
		$sql1 = "UPDATE tblpackage_inclusions SET package_incStatus='Archived' WHERE package_inclusionID = $str";
		mysqli_query($conn,$sql1);
		$flag++;
	}
}
/*else{
	echo "not set";
}*/


$sql1 = "";

if(isset($_POST['addis'])){
	$addThis = $_POST['addis'];

	foreach($addThis as $add) {
		echo $add;
//$sql2 = "UPDATE tblpackage_inclusions SET package_incStatus='Listed' WHERE package_inclusionID = $add";
		$sql = "INSERT INTO `tblpackage_inclusions` (`product_incID`,`package_incID`,`package_incStatus`) VALUES ('$add','$id','Listed')";
		if(mysqli_query($conn,$sql)){
			$flag++;
		}
		else{

			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
/*else{
	echo "not set";
}

*/
if($flag>0){
	
  header( "Location: packages.php?updateSuccess" );
}
else{

  echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>