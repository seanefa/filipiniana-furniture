<?php
include "session.php";
include "userconnect.php";

$description = $_POST["description"];
$blueprint = "";

$description = mysqli_real_escape_string($conn, $description);

$data = "SELECT * from tbluser a join tblcustomer b where a.userCustID = b.customerID AND a.userID = " . $_SESSION["userID"] . "";
$result = $conn->query($data);
$row = $result->num_rows;
$customerID = $row["customerID"];

if($_FILES["blueprint"]["error"]>0){
	echo "NO DATABASE SAVED";
}
else{
	move_uploaded_file($_FILES["blueprint"]["tmp_name"], date("Y-m-d") . time() . ".png");
	$blueprint = date("Y-m-d") . time() . ".png";
}

$sendnukes = "INSERT into tblcustomize_request(tblcustomerID, customizedPic, customizedDescription, customStatus) values('$customerID', '$blueprint', '$description', 'active')";

if($conn->query($sendnukes) === true){
	header("Location: customize.php");
}
else{
	echo "query:" . $sendnukes . "<br>error:" . $conn->error;
	echo "<br><br> SESSION value: ";
	echo $customerID;
}
$conn->close();
?>