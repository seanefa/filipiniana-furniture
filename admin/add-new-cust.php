<?php

include 'dbconnect.php';

$ln = $_POST['ln'];
$mn = $_POST['mn'];
$fn = $_POST['fn'];
$addrss = $_POST['addr'];
$cont = $_POST['cont'];
$emailadd = $_POST['email'];
$status = 'Active';





$sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`,`customerStatus`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd','$status')";


if (mysqli_query($conn, $sql)) {


            echo '<script type="text/javascript">';
            echo 'alert("Customer succesfully added");';
            echo '</script>';
    
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


  


mysqli_close($conn);

?>