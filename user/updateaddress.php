<?php
include "session.php";
include "userconnect.php";
$ar = $_POST["address"];
$a1 = '';
$a2 = '';
$a3 = '';
$a4 = '';
$a5 = '';
$a6 = '';
if(isset($_POST['street'])){
$a1 = $_POST['street'];
}
if(isset($_POST['route'])){
$a2 = $_POST['route'];
}
if(isset($_POST['localcity'])){
$a3 = $_POST['localcity'];
}
if(isset($_POST['state'])){
$a4 = $_POST['state'];
}
if(isset($_POST['zipcode'])){
$a5 = $_POST['zipcode'];
}
if(isset($_POST['-country'])){
$a6 = $_POST['-country'];
}
$a1= mysqli_real_escape_string($conn, $a1);
$a2= mysqli_real_escape_string($conn, $a2);
$a3= mysqli_real_escape_string($conn, $a3);
$a4= mysqli_real_escape_string($conn, $a4);
$a5= mysqli_real_escape_string($conn, $a5);
$a6= mysqli_real_escape_string($conn, $a6);
$ar= $a1.','.$a2.','.$a3.','.$a4.','.$a5.','.$a6.'';
$ar= mysqli_real_escape_string($conn, $ar);

$customersql="UPDATE tblcustomer a join tbluser b SET a.customerAddress='$ar' where b.userCustID = a.customerID AND b.userID = " . $_SESSION["userID"] . "";

if($conn->query($customersql)==true)
{
	header("Location: account.php");
}
$conn->close();
?>