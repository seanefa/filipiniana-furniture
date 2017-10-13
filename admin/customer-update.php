<?php
include "dbconnect.php";

$id = $_POST["customer_id"];
$firstname = $_POST["customer_fname"];
$middlename = $_POST["customer_mname"];
$lastname = $_POST["customer_lname"];
$address = $_POST["customer_address"];
$contactnum = $_POST["customer_contactnum"];
$email = $_POST["customer_email"];

$update = "UPDATE tblcustomer set customerFirstName='$firstname', customerMiddleName='$middlename', customerLastName='$lastname', customerAddress='$address', customerContactNum='$contactnum', customerEmail='$email' where customerID='$id'";

if($conn->query($update) === true)
{
  header("Location: dashboard.php");
}
else
{
  echo "May error ka tanga:" . $update . "<br><br> eto oh:" . $conn->error;
}
$conn->close();
?>
