<?php

include 'dbconnect.php';
session_start();
$conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$customId = $_POST['customerIds'];
$isBool = $_POST['isBool'];
$ln = $_POST['lastn'];
$mn = $_POST['midn'];
$fn = $_POST['firstn'];
$addrss = $_POST['custoadd'];
$cont = $_POST['custocont'];
$emailadd = $_POST['custoemail'];
$ordershipadd = $_POST['deladd'];

$payment = $_POST['aTendered'];
$_SESSION['payment'] = $payment;

$date = new DateTime();
$orderdaterec = $date->format('Y-m-d H:i:s');;
$orderdatepick = $_POST['pidate'];
$orderstat = "paid";
$ordertype = "On-Hand";


                 
                  $selected = $_POST['Pcart'];
                  $selectedQuant = $_POST['Pquant'];
                  $selectedPrice = $_POST['Pprice'];
                  $totalPrice = $_POST['PtotalPrice'];
                  
                   $_SESSION['Pcart'] = $selected;
                   $_SESSION['Pquant'] = $selectedQuant;
                   $_SESSION['Pprice'] = $selectedPrice;
                   $_SESSION['PtotalPrice'] = $totalPrice;
                   $sample = 'paid';




if($isBool == "not change"){
$sql = "INSERT INTO `tblcustomer` (`customerLastName`, `customerFirstName`, `customerMiddleName`, `customerAddress`, `customerContactNum`, `customerEmail`) VALUES ('$ln', '$fn', '$mn', '$addrss', '$cont', '$emailadd')";


if (mysqli_query($conn, $sql)) {
    
    $ssql = "SELECT * FROM `tblcustomer` WHERE `customerLastName` = '$ln';";
    $result = mysqli_query($conn,$ssql);
    
    if($result){
        
        $row = mysqli_fetch_assoc($result);
        $custid = $row['customerID'];
        
        $pssql = "INSERT INTO `tblorders` (`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`) VALUES ('$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype')";
          


        if (mysqli_query($conn, $pssql)) {

          foreach($selected as $str) {
        foreach ($selectedQuant as $qnt) {
          # code...
 $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`) VALUES ('$str', '$custid','$sample','$qnt')"; 
 mysqli_query($conn,$sql1);
}

}


        echo '<script type="text/javascript">';
            header( "Location: posBill.php?id=".$customId."" );
            echo '</script>';
        }
        else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

else{
    $ssql = "SELECT * FROM `tblcustomer` WHERE `customerLastName` = '$ln';";
    $result = mysqli_query($conn,$ssql);
    
    if($result){

      



        $row = mysqli_fetch_assoc($result);
        $custid = $row['customerID'];
        $pssql = "INSERT INTO `tblorders` (`dateOfReceived`,`dateOfRelease`,`custOrderID`,`orderPrice`,`orderStatus`,`shippingAddress`,`orderType`) VALUES ('$orderdaterec', '$orderdatepick','$custid','$totalPrice','$orderstat','$ordershipadd','$ordertype')";

        
        if (mysqli_query($conn, $pssql)) {

          foreach($selected as $str) {
        foreach ($selectedQuant as $qnt) {
          # code...
 $sql1 = "INSERT INTO `tblorder_request` (`orderProductID`,`tblOrdersID`,`orderRemarks`,`orderQuantity`) VALUES ('$str', '$custid','$sample','$qnt')"; 
 mysqli_query($conn,$sql1);
}

}


            echo '<script type="text/javascript">';
            header( "Location: posBill.php?id=".$customId."" );
            echo '</script>';
        }
}

       
}

  


mysqli_close($conn);

?>