<?php
include 'dbconnect.php';
$sql = "SELECT * FROM tblcustomer ORDER BY customerID DESC;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
  if($row['customerStatus'] != "Archived"){
    if($row['customerLastName'] != ""){
        echo('<option value='.$row['customerID'].'>'.$row['customerFirstName'].' '.$row['customerMiddleName'].' '.$row['customerLastName'].'</option>
            ');
    }
}
}
?>