<?php
include "dbconnect.php";
$id = $_POST['id'];

$sql = "SELECT * FROM tblpromo_condition WHERE conPromoID = '$id'";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$category = $row['conCategory'];


?>