<?php
include "dbconnect.php";
$id = $_POST['id'];

if($id==1){
  $date = $_POST['d'];
  $date = date_create($date);
  $date = date_format($date,"Y-m-d");
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;
  $sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and c.dateOfReceived = '$date' GROUP BY b.orderProductID order by quan DESC;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table queriesDataTable display nowrap' id='reportsTable'>
    <thead>
  <tr>
  <th>Product ID</th>
  <th>Product Name</th>
  <th>Product Description</th>
  <th style='text-align:right'>Product Price</th>
  <th style='text-align:right'>Quantity Ordered</th>
  <th style='text-align:right'>Total</th>
  </tr>
  </thead>
  <tbody>";
  while ($row = mysqli_fetch_assoc($result)){
    $prodID = str_pad($row['productID'], 6, '0', STR_PAD_LEFT);
    $total = $row['quan'] * $row['productPrice'];
    $tQuan += $row['quan'];
    $tPrice += $total;
    echo ('<tr><td>'.$prodID.'</td>
      <td>'.$row['productName'].'</td>
      <td>'.$row['productDescription'].'</td>
      <td style="text-align:right">&#8369;'.number_format($row['productPrice'],2).'</td>
      <td style="text-align:right">'.$row['quan'].' pcs</td>
      <td style="text-align:right">&#8369;'.number_format($total,2).'</td>
      </tr>'); 
  $ctr++;
  }
  if($ctr==0){
    echo "<td colspan='6' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
  </tbody>
  <tfoot style="text-align:right;">
  <td></td>
  <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
  <td id="totalQ" style="text-align:right;">'. $tQuan.' pcs</td>
  <td id="totalPrice" style="text-align:right;">'. "&#8369; ". number_format($tPrice,2).'</td>
  </tfoot>
  </table>
  </div>';
  }

}
else if($id==2){
echo '<div class="col-md-3">
<select id="month" style="height:40px;" class="form-control" data-placeholder="Choose Category" tabindex="1" name="month"> <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                      </select>
                      </div>
                      <div class="col-md-1">
                      <input type="text" name="year" class="form-control" placeholder="Year" required>
                      </div>';

  $month = $_POST['m'];
  $date = $_POST['d'];
  $date = date_create($date);
  $date = date_format($date,"Y-m-d");
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;
  $sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and c.dateOfReceived = '$date' GROUP BY b.orderProductID order by quan DESC;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table queriesDataTable display nowrap' id='reportsTable'>
    <thead>
  <tr>
  <th>Product ID</th>
  <th>Product Name</th>
  <th>Product Description</th>
  <th style='text-align:right'>Product Price</th>
  <th style='text-align:right'>Quantity Ordered</th>
  <th style='text-align:right'>Total</th>
  </tr>
  </thead>
  <tbody>";
  while ($row = mysqli_fetch_assoc($result)){
    $prodID = str_pad($row['productID'], 6, '0', STR_PAD_LEFT);
    $total = $row['quan'] * $row['productPrice'];
    $tQuan += $row['quan'];
    $tPrice += $total;
    echo ('<tr><td>'.$prodID.'</td>
      <td>'.$row['productName'].'</td>
      <td>'.$row['productDescription'].'</td>
      <td style="text-align:right">&#8369;'.number_format($row['productPrice'],2).'</td>
      <td style="text-align:right">'.$row['quan'].' pcs</td>
      <td style="text-align:right">&#8369;'.number_format($total,2).'</td>
      </tr>'); 
  $ctr++;
  }
  if($ctr==0){
    echo "<td colspan='6' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
  </tbody>
  <tfoot style="text-align:right;">
  <td></td>
  <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
  <td id="totalQ" style="text-align:right;">'. $tQuan.' pcs</td>
  <td id="totalPrice" style="text-align:right;">'. "&#8369; ". number_format($tPrice,2).'</td>
  </tfoot>
  </table>
  </div>';
  }



                  }
else if($id==3){
	echo '<div class="col-md-1">
          <input type="text" name="year" class="form-control" placeholder="Year" required>
          </div>';
}

?>