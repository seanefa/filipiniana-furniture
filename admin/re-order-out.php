<?php
include "dbconnect.php";
$id = $_POST['id'];

$sql = "SELECT * FROM tblorder_request a, tblorders b,tblproduct c WHERE a.orderProductID = c.productID and a.orderRequestStatus = 'Released' and b.orderID = a.tblOrdersID and b.orderID = '$id' ORDER BY productName;";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result))
{
  echo('<option value='.$row['order_requestID'].'>'.$row['productName'].'</option>');

}
?>