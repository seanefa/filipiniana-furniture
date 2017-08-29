<?php
include "dbconnect.php";

$ordReq = $_POST['check'];
$quan = $_POST['quan'];
$location = $_POST['location'];
$delRate = $_POST['delRate'];
$delAdd = $_POST['delAdd'];
$employee = $_POST['emp'];
$delDate = $_POST['delDate'];
$remarks = $_POST['remarks'];

$delSQL = "INSERT INTO `tbldelivery` (`deliveryEmpAssigned`, `deliveryDate`, `deliveryRate`, `deliveryAddress`, `deliveryRemarks`, `deliveryStatus`) VALUES ('$employee', '$delDate', '$delRate', '$delAdd', '$remarks', 'Pending')";

if(mysqli_query($conn,$delSQL)){
echo $delSQL . "<br>";
$delID = mysqli_insert_id($conn);
$x = 0;
foreach($ordReq as $order){
	$detailsSQL = "INSERT INTO `tbldelivery_details` (`del_deliveryID`, `del_orderReqID`, `del_quantity`, `del_status`) VALUES ('$delID', '$order','" . $quan[$x] . "','Pending')";
	mysqli_query($conn,$detailsSQL);
	echo $detailsSQL. "<br>";
	$x++;
}
}
else{
  echo "<script>
      window.location.href='point-of-sales.php';
      alert('Record not saved. There are some errors on the data');
      </script>";
}

mysqli_close($conn);
?>