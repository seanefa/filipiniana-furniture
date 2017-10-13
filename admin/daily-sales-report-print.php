<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf-master");
require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;
ob_start();

$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];

function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

$dayWithSuffix = ordinal_suffix($day);

if($month == 1){
  $month = 'January';
}
if($month == 2){
  $month = 'February';
}
if($month == 3){
  $month = 'March';
}
if($month == 4){
  $month = 'April';
}
if($month == 5){
  $month = 'May';
}
if($month == 6){
  $month = 'June';
}
if($month == 7){
  $month = 'July';
}
if($month == 8){
  $month = 'August';
}
if($month == 9){
  $month = 'September';
}
if($month == 10){
  $month = 'October';
}
if($month == 11){
  $month = 'November';
}
if($month == 12){
  $month = 'December';
}

$dates =  $day . $dayWithSuffix . $month . $year;

?>
<!DOCTYPE html>
<head>
  <title><?php echo $orderID = $dates?></title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php

$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];

if($month == 1){
  $month = 'January';
}
if($month == 2){
  $month = 'February';
}
if($month == 3){
  $month = 'March';
}
if($month == 4){
  $month = 'April';
}
if($month == 5){
  $month = 'May';
}
if($month == 6){
  $month = 'June';
}
if($month == 7){
  $month = 'July';
}
if($month == 8){
  $month = 'August';
}
if($month == 9){
  $month = 'September';
}
if($month == 10){
  $month = 'October';
}
if($month == 11){
  $month = 'November';
}
if($month == 12){
  $month = 'December';
}

include "dbconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
?>
<body>
  <div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <img height="55px" src="plugins/images/<?php echo $row['comp_logo'];?>"/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <p style='font-family:inherit; font-size:28px;'><?php echo $row['comp_name'];?></p>
          <h5><?php echo $row['comp_address'];?></h5>
          <h5>Phone: <?php echo $row['comp_num'];?></h5>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- MONTHLY SALES REPORT -</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <?php
          include "dbconnect.php";
          $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$month'";
          $res = mysqli_query($conn,$sql);
          $custRow = mysqli_fetch_assoc($res);
          ?>
          <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;"><?php $orderID = $dates; echo $orderID;
          $salesReportID = "DailySalesReport". $orderID;?></span>
        </div>
      </div>
    </div>

    <br>
    <?php
      $date = $dates;
  $newDate = new DateTime($date);
  $resultDate = $newDate->format('Y-m-d');
  $explodeDate = explode('-',$resultDate);

  $y = "";
  $m = "";
  $d = "";

  $y = $explodeDate[0];
  $m = $explodeDate[1];
  $d = $explodeDate[2];

  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;

  $sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and c.dateOfReceived = '$resultDate' GROUP BY b.orderProductID order by quan DESC;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
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
      <td style="text-align:right">Php '.number_format($row['productPrice'],2).'</td>
      <td style="text-align:right">'.$row['quan'].' pcs</td>
      <td style="text-align:right">Php '.number_format($total,2).'</td>
      </tr>'); 
  $ctr++;
  }
  
    echo '
  </tbody>
  <tfoot style="text-align:right;">
  <td></td>
  <td colspan="3" style="text-align:right;"><b> GRAND TOTAL:</b></td>
  <td id="totalQ" style="text-align:right;"><b> '. $tQuan.' pcs</b></td>
  <td id="totalPrice" style="text-align:right;"><b>'. "Php ". number_format($tPrice,2).'</b></td>
  <input type="hidden" value="'.$tPrice.'" id="totalPrice"/>
  </tfoot>
  </table>
  </div>
  <script>
  $(document).ready(function () {
    var table = $(".reportsDataTable").DataTable({
      "order": [],
      "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      "aoColumnDefs" : [
      {
       "bSortable" : false,
       "aTargets" : [ "removeSort" ]
     }]
   });
  });
  </script>';
  
    ?>
    <br>

    <?php
    $down = 0;
    $bal = 0;
    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$month'";
    $res = mysqli_query($conn,$sql);
    $tpay = 0;
    while($trow = mysqli_fetch_assoc($res)){
      $tpay = $tpay + $trow['amountPaid'];
    }
    $down = $tpay;
    $bal = $tPrice - $down;
    ?>

    <div class="row">
      <div class="col-md-6">
        <p><?php 
        session_start();
        include "dbconnect.php"; 
        $datepr = date("Y-m-d");
        $sql5 = "SELECT * FROM tblemployee a inner join tbluser b where a.empID = b.userEmpID and userID='" . $_SESSION["userID"] . "'";
        $result5 = mysqli_query($conn, $sql5);
        while ($row5 = mysqli_fetch_assoc($result5))
        { 
          if($row5['userStatus']=="Active" && $row5['userType']=="admin")
          {
            echo('Printed By: '.$row5['empFirstName'].' '.$row5['empMidName'].' '.$row5['empLastName'].'     ['.$datepr.']');
          }
        }  ?></p>
      </div>
    </div>

  </body> 
  </html>

  <?php
  $html = ob_get_clean();
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->render();
  $dompdf->stream($salesReportID, array("Attachment" => 0));
  ?>