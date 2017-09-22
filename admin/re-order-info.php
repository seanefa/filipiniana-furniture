<?php
include "dbconnect.php";
$id = $_POST['id'];
echo '<div class="panel-body">
                          <div class="row">
                            <h3>Customer Information</h3>
                            <div class="row">';
                              $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              echo '<div class="row">
                                <div class="col-md-12" style="text-align:left;">
                                  <h5>
                                    <table class="table">
                                      <tr>
                                        <td><b>Name</b></td>
                                        <td>'.$row['customerFirstName'].' '.$row['customerMiddleName'].'  '.$row['customerLastName'].'</td>
                                      </tr>
                                      <tr>
                                        <td><b>Address</b></td>
                                        <td>'.$row['customerAddress'].'</td>
                                      </tr>
                                      <tr>
                                        <td><b>Contact Number</b></td>
                                        <td>' .$row['customerContactNum'].'</td>
                                      </tr>
                                      <tr>
                                        <td><b>Email Address</b></td>
                                        <td>'.$row['customerEmail'].'</td>
                                      </tr>
                                    </table>
                                  </h5>
                                </div>
                              </div>
                            </div>
                            <br>
                          </div>
                        </div>';
echo '<div class="panel-body">
                          <div class="row">
                            <h3>Order Information</h3>
                            <div class="row">';
echo '<table class="table product-overview">
<thead>
  <th style="text-align:left">Furniture Name</th>
  <th style="text-align:left">Status</th>
  <th style="text-align:right">Date Released</th>
  <th style="text-align:right;">Released Quantity</th>
</thead>
<tbody>';
  $tQuan = 0;
  $tPrice = 0;
  $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c, tblrelease_details d, tblrelease e WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$id' and a.order_requestID = d.rel_orderReqID and d.tblreleaseID = e.releaseID";
  $res = mysqli_query($conn,$sql1);
  while($row = mysqli_fetch_assoc($res)){
    $date = new DateTime($row['releaseDate']);
    $date = date_format($date, "F d, Y");
    echo '<tr>';
    echo '<td>'.$row['productName'].'</td>
    <td>'.$row['orderRequestStatus'].'</td>
    <td style="text-align:right;">'.$date.'</td>
    <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
  }
echo '</tbody>
      </table>
      </div>
      </div>
      </div>
      ';

?>