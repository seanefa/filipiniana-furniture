<?php
include 'dbconnect.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


$iPname = $_POST['iProdName'];
$qty = $_POST['qty'];
$iDesc = $_POST['iDesc'];

$iDesc = mysqli_real_escape_string($conn,$iDesc);

$sql = "INSERT INTO tblprod_inclusions(prodIncQuantity, prodIncDesc, productIncID) VALUES('$qty','$iDesc','$iPname')";
if($sql){
	if (mysqli_query($conn, $sql)) {

		echo $iPname;
		echo '<script type="text/javascript">';
		echo 'alert("RECORD SUCCESFULLY SAVED!")';
		header( "Location: products.php" );
		echo '</script>';

	} 
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}
?>