<?php
include "session.php";
include "userconnect.php";

$description = $_POST["description"];
$blueprint = "";

$description = mysqli_real_escape_string($conn, $description);

$uID = $_SESSION["userID"];

$data = "SELECT * from tbluser a, tblcustomer b where a.userCustID = b.customerID AND a.userID = '$uID'";
$result = nysqli_query($conn,$data);
$row = mysqli_fetch_assoc($result);
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
	echo "<br><br> CustomerID value: ";
	echo $customerID;
}
$conn->close();
?>