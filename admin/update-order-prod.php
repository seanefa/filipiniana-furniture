<?php
include "dbconnect.php";

$id = $_POST["id"];
$quan = $_POST["quan"];

$un = "SELECT * FROM tblproduct WHERE productID = '$id'";
$res = mysqli_query($conn,$un);
$row = mysqli_fetch_assoc($res);

//<input type='hidden' class='form-control' name='quan[]' value='". $quan ."'/>
echo '<tr>
      <td>'.$row['productName'].'</td>
      <td>'.$row['productDescription'].'</td>
      <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'</td>
      <td style="text-align:right;"><input type="number" size="1" style="text-align:right" value="'.$quan.'" /></td>';
      $tPrice = $quan * $row['productPrice'];
      $tPrice =  number_format($tPrice,2);
      echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td>';
      $tQuan = $tQuan + $row['orderQuantity'];
      echo '<td style="text-align:center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo">X</button></td>
      </tr>';

?>