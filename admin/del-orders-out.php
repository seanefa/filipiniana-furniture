<?php
include "dbconnect.php";
$id = $_POST['id'];
echo '<thead>
  <th style="text-align:center">-</th>
  <th style="text-align:left">Furniture Name</th>
  <th style="text-align:left">Status</th>
  <th style="text-align:right;">Quantity</th>
</thead>
<tbody>';
  $tQuan = 0;
  $tPrice = 0;

  $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$id'";
  $res = mysqli_query($conn,$sql1);
  while($row = mysqli_fetch_assoc($res)){
    if($row['orderRequestStatus']!='Deleted'){
    echo '<tr>';
    if($row['orderRequestStatus']=="Ready for release"){
      echo '<td style="text-align:center"><input class="chBox" type="checkbox"  value='.$row['order_requestID'].' name="check[]" /></td>';
    }
    else{
      echo '<td style="text-align:center; color:red">Not yet ready.</td>';
    }
    echo '<td>'.$row['productName'].'</td>
    <td>'.$row['orderRequestStatus'].'</td>
    <td style="text-align:right;">
    <select class="form-control" name="quan[]" style="text-align:right">';
    $num = $row['orderQuantity'];
    for($x=1;$x<=$num;$x++){
      echo '<option value='.$x.'><h3 style="text-align:right" size:"1">'.$x.'</h3></option>';
    }
    echo '</select>
    </td>';
    $delAdd = $row['shippingAddress'];
    //echo '<input type="hidden" id="typeOfRel" name="typeOfRel" value="'.$delAdd.'">';
  }
  }
echo '</tbody>';
?>